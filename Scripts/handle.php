<?php
// start session and call in required files and folders and connect to database
require "config.php";
session_start();

$DB = mysqli_connect($HOST, $DB_USER, $DB_PASS, $DB, $PORT);

// check databse connection
if (!$DB) {
    echo ("failed");
} else {
    echo ("connected");
}

// define functions

//generate ref 
function gen_ref()
{
    $r_num = rand(00000, 99999);
    $ref = "EUP{$r_num}";
    return $ref;
}

// verify payment
function verify_pay($reference)
{
    global $SECRET_KEY;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/{$reference}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Accept: application/json',
            "Authorization: Bearer {$SECRET_KEY}",
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

// generate payment link
function gen_pay($email, $amount, $currency, $reference, $callback_url)
{
    global $SECRET_KEY;


    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.paystack.co/transaction/initialize',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => "email={$email}&amount={$amount}&currency={$currency}&reference={$reference}&callback_url={$callback_url}",
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json',
            "Authorization: Bearer {$SECRET_KEY}",
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

//collect info from user from and push to paystack api 
if (isset($_POST['buy'])) {

    echo"passed";

    $_SESSION['name'] = $_POST['name'];
    $amount = $AMOUNT * 100;
    $email = $_POST["email"];
    $currency = "NGN";
    $_SESSION['ref'] = gen_ref();
    $url = "{$URL}/Scripts/handle.php?ref={$_SESSION['ref']}";
    //make ref session id 
    $pay = json_decode(gen_pay($email, $amount, $currency, $_SESSION['ref'], $url), true);

    header("location: {$pay['data']['authorization_url']}");
}

//if transcation is completed call back url to check if transaction was successfull and generate qr code
if (isset($_GET['ref'])) {
    // return from api
    $pay = json_decode(verify_pay($_GET['ref']), true);
    $_ref = $pay["data"]['reference'];
    $_status = $pay["data"]['status'];

    // add ticket details to database
    $_name = mysqli_real_escape_string($DB, $_SESSION['name']);
    $_ticket_id = mysqli_real_escape_string($DB, $_ref);
    $query = "INSERT INTO e_users (Name, TIcket_ID) VALUES ('$_name','$_ticket_id')";
    if (mysqli_query($DB, $query)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($DB);
    }

    // generate qr code and display
    if ($_status == "success" && $_ref == $_GET['ref']) {
        // generate qrcode for ticket url
        $ticket_url = "{$URL}/Scripts/handle.php?scan={$_GET['ref']}";
        $_SESSION["qr"] = "https://api.qrserver.com/v1/create-qr-code/?data={$ticket_url}&size=300x300";
        header("location: ../display.php?ref={$_GET['ref']}");
    }
}

//scan ticket
if(isset($_GET['scan'])){
    $ref=$_GET['scan'];
    //search for info and return details
    $query="SELECT * FROM e_users WHERE TIcket_ID = '$ref'";
    $result=mysqli_query($DB,$query);
    if(mysqli_num_rows($result)>0){
        $_SESSION['scan_info']=mysqli_fetch_assoc($result);
        header("location: ../verify.php?found=yes");
    }
    else{
        header("location: ../verify.php?found=no");
    }
}