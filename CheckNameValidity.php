<?php
//Error Codes
// 1 - Database connection error
// 2 - Username is invalid

// ------------------ Connect to Database ------------------
$con = mysqli_connect('localhost', 'root', 'root', 'clockwork_arena');

if(mysqli_connect_errno())
{
    exit("1");
}

// ------------------ Unity Form ------------------
$appKey = $_POST["appPassword"];
$userName = $_POST["userName"];

// ------------------ Check if Form comes from App ------------------
if($appKey != "5#@eK1GF9r*t")
{
   exit();
}
 // ------------------ Check if Username is Valid ------------------

 $userNameLower = strtolower($userName);

 $nameCheckQuery = "SELECT name FROM forbiddennames";
 
 $nameQueryResult = mysqli_query($con, $nameCheckQuery);

 while ($row = $nameQueryResult->fetch_row()) 
 {
    if(str_contains($userNameLower, $row[0]))
    {
        exit("2");
    }
 }
  
 echo("0");
 $con->close();

?>