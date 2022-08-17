<?php

// Error Codes
// 1 - Database connection error
// 2 - Update Query Error

$con = mysqli_connect('localhost', 'root', 'root', 'clockwork_arena');


if(mysqli_connect_errno())
{
    exit("1");
}

// ------------------ Unity Form ------------------
$appKey = $_POST["appPassword"];
$parameter = $_POST["parameter"];
$value = $_POST["value"];
$user = $_POST["user"];

// ------------------ Check if Form comes from App ------------------
if($appKey != "5#@eK1GF9r*t")
{
   exit();
}


if($parameter == "sqlid" || $parameter == "username" || $parameter == "email")
{
    exit();
}

// ------------------ Update the given parameter ------------------
$updateQuery = "UPDATE players SET $parameter = '".$value."' WHERE username = '".$user."';";

mysqli_query($con, $updateQuery);

echo("0");

$con->close();
?>