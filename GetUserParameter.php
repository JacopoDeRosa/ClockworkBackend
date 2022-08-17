<?php
// Error Codes
// 1 - Database connection error
// 2 - Get Query Error

$con = mysqli_connect('localhost', 'root', 'root', 'clockwork_arena');


if(mysqli_connect_errno())
{
    exit("1");
}

// ------------------ Unity Form ------------------
$appKey = $_POST["appPassword"];
$parameter = $_POST["parameter"];
$user = $_POST["user"];

// ------------------ Check if Form comes from App ------------------
if($appKey != "5#@eK1GF9r*t")
{
   exit();
}

$getQuery = "SELECT $parameter FROM players WHERE username = '".$user."';";

$getQueryResult = mysqli_query($con, $getQuery) or die("2");

$row = mysqli_fetch_assoc($getQueryResult);

$finalParameter = $row[$parameter];

echo($finalParameter);

$con->close();


?>