<?php

// Error Codes
// 1 - Database connection error
// 2 - No Squad found for owner

$con = mysqli_connect("localhost", "root", "root", "clockwork_arena");

if(mysqli_connect_errno())
{
    exit("1");
}

// ------------------ Unity Form ------------------
$appKey = $_POST["appPassword"];
$owner = $_POST["owner"];

// ------------------ Check if Form comes from App ------------------
if($appKey != "5#@eK1GF9r*t")
{
   exit();
}

$squadQuery = "SELECT characters FROM squads WHERE owner = '". $owner ."';";

$squadQueryResult = mysqli_query($con, $squadQuery) or die("4");

$row = mysqli_fetch_assoc($squadQueryResult);

echo($row["characters"]);

$con->close();

?>