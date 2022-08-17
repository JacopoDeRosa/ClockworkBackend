<?php

//Error Codes
// 1 - Database connection error
// 2 - User name check query ran into an error
// 3 - User already exist
// 4 - Email check query ran into an error
// 5 - Email already in use
// 6 - Insert user query ran into an error
// 7 - Insert Squad query ran into an error

// ------------------ Connect to Database ------------------
$con = mysqli_connect('localhost', 'root', 'root', 'clockwork_arena');

if(mysqli_connect_errno())
{
    exit("1");
}

// ------------------ Unity Form ------------------
$userName = $_POST["userName"];
$email = $_POST["email"];
$password = $_POST["password"];
$displayName = $_POST["displayName"];
$appKey = $_POST["appPassword"];

// ------------------ Check if Form comes from App ------------------
if($appKey != "5#@eK1GF9r*t")
{
   exit();
}

// ------------------ User name check ------------------
$userNameCheckQuery = "SELECT username FROM players WHERE username ='" . $userName . "'; ";
$userNameCheck = mysqli_query($con, $userNameCheckQuery) or die("2");

if(mysqli_num_rows($userNameCheck) > 0)
{
    exit("3");
}

// ------------------ Email check ------------------
$emailCheckQuery = "SELECT email FROM players WHERE email = '" . $email . "'; ";
$emailCheck = mysqli_query($con, $emailCheckQuery) or die("4");

if(mysqli_num_rows($emailCheck) > 0)
{
    exit("5");
}

// ------------------ Password Hashing ------------------
$passwordHash = password_hash($password, PASSWORD_DEFAULT);


// ------------------ User Insertion ------------------
$insterUserQuery = "INSERT INTO players(username, email, password, displayname) VALUES('". $userName ."', '". $email ."', '". $passwordHash ."', '". $displayName ."');";

mysqli_query($con, $insterUserQuery) or die("6");

// ------------------ Squad Insertion ------------------
$insertNewSquadQuery = "INSERT INTO squads(owner) VALUES ('".$userName."');";

mysqli_query($con,$insertNewSquadQuery) or die("7");

echo("0");
$con->close();

?>