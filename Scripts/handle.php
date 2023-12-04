<?php
// start session and call in required files and folders and connect to database
require "config.php";
session_start();

$DB = new mysqli($HOST, $DB_USER, $DB_PASS, $DB, $PORT);

// check databse connection
if (!$DB) {
    echo ("failed");
} else {
    echo ("connected");
}

// define functions


function gen_ref()
{
    $r_num = rand(00000, 99999);
    $ref = "EUP{$r_num}";
    return $ref;
}

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
    $_SESSION['name'] = $_POST['name'];
    $amount = $_POST['amount'] * 100;
    $email = $_POST["email"];
    $currency = "NGN";
    $_SESSION['ref'] = gen_ref();
    $url = "{$URL}/Scripts/handle.php?ref={$_SESSION['ref']}";
    //make ref session id 
    $pay = json_decode(gen_pay($email, $amount, $currency, $_SESSION['ref'], $url), true);

    header("location: {$pay['data']['authorization_url']}");
}

//if transcation is completed call back url to check if transaction was successfull
if (isset($_GET['ref'])) {
    $pay = json_decode(verify_pay($_GET['ref']), true);
    $_ref = $pay["data"]['reference'];
    $_status = $pay["data"]['status'];
    if ($_status == "success" && $_ref == $_GET['ref']):{
        pass;
    }
}
