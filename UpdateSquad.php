<?php
// Error Codes
// 1 - Database connection error
// 2 - Squad selection query ran into an error
// 3 - No squad found by query
// 4 - Squad Update query failed

$con = mysqli_connect('localhost', 'root', 'root', 'clockwork_arena');


if(mysqli_connect_errno())
{
    exit("1");
}

// ------------------ Unity Form ------------------
$appKey = $_POST["appPassword"];
$owner = $_POST["owner"];
$squad = $_POST["squad"];


// ------------------ Check if Form comes from App ------------------
if($appKey != "5#@eK1GF9r*t")
{
   exit();
}

$squadSelectQuery = "SELECT owner, characters FROM squads WHERE owner  = '". $owner ."';";

$squadQueryResult = mysqli_query($con,$squadSelectQuery) or die("2");

if(mysqli_num_rows($squadQueryResult) == 0)
{
    exit("3");
}

$updateSquadQuery = "UPDATE squads SET characters = '". $squad ."' WHERE owner = '". $owner ."'; ";

mysqli_query($con, $updateSquadQuery) or die("4");

echo("0");
$con->close();
?>