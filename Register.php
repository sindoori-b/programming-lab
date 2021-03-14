<!DOCTYPE HTML>
<html>
<body>
<?php

include("DBConnection.php"); 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

$inFullname = $_POST["fullname"]; 
$inEmail = $_POST["email"];
$inUsername = $_POST["username"];
$inPassword = $_POST["password"];

$encryptPassword = password_hash($inPassword, PASSWORD_DEFAULT);

$stmt = $db->prepare("INSERT INTO REGFORM(FULLNAME, EMAIL, USERNAME,PASSWORD) VALUES(?, ?, ?, ?)"); 
$stmt->bind_param("ssss", $inFullname, $inEmail, $inUsername, $encryptPassword);

$stmt->execute();
$result = $stmt->affected_rows;
$stmt -> close();
$db -> close();

if($result > 0)
{
header("location: RegSuccess.php"); 
}
else
{
echo "Oops. Something went wrong. Please try again";
?>
<a href="RegisterForm.php">Try Login</a>
<?php
}
}
?>
</body> 
</html