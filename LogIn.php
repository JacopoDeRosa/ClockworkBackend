<?php

// Error Codes
// 1 - Database connection error
// 2 - Username query error
// 3 - Username could not be found
// 4 - Password could not be verified

$con = mysqli_connect('localhost', 'root', 'root', 'clockwork_arena');

if(mysqli_connect_errno())
{
    exit("1");
}

// ------------------ Unity Form ------------------

$username = $_POST["userName"];
$password = $_POST["password"];
$appKey = $_POST["appPassword"];

// ------------------ Check if Form comes from App ------------------
if($appKey != "5#@eK1GF9r*t")
{
   exit();
}


$userNameQuery = "SELECT * FROM players WHERE username = '". $username ."';";

$userNameCheckResult = mysqli_query($con, $userNameQuery) or die("2");

if($userNameCheckResult->num_rows != 1)
{
    exit("3");
}
else
{
    $row = mysqli_fetch_assoc($userNameCheckResult);

    include'UserData.php';

    $userData = new UserData;

    $userData->userName = $row["username"];
    $userData->displayName = $row["displayname"];
    $userData->image = $row["image"];
    $userData->rCoins = $row["rcoins"];
    $userData->aCoins = $row["acoins"];

    $UserDataJson = json_encode($userData);

    $fetchedPassword = $row["password"];
    if(password_verify($password, $fetchedPassword))
    {
       echo($UserDataJson);
    }
    else
    {
       
        echo("4");
    }
}

$con->close();

?>