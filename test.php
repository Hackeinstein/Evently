<?php

require "./Scripts/config.php";
$DB = mysqli_connect($HOST, $DB_USER, $DB_PASS, $DB, $PORT);

$_name=mysqli_real_escape_string($DB, "stein30");
$_ticket_id=mysqli_real_escape_string($DB, "tinko");
$query="INSERT INTO e_users (Name, TIcket_ID) VALUES ('$_name','$_ticket_id')";

if (mysqli_query($DB, $query)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($DB);
  }