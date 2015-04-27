<?php
date_default_timezone_set("America/New_York");
session_start();
$HOST="http://localhost:8888/MAMP/CS6083_project/";
$mysqli = new PDO("mysql:host=localhost;dbname=CS6083_Project", "root", "root");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$sql1="Insert into User_Login(User_Login_Name,User_Pwd,User_Type) values ('".$_POST["user_name"]."','".$_POST["user_pwd"]."',1)";
#echo $sql1;
$sql2="select User_Login_Id from User_Login where User_Login_Name = '".$_POST["user_name"]."'";
#echo $sql2;
$sql3="Insert into Users(User_Id,User_DoB,User_Email,User_City,User_LastloginTime) values (?,'".$_POST["DoB"]."','".$_POST["email-address"]."','".$_POST["city"]."', CURRENT_TIMESTAMP())";
#echo $sql3;
$stmt=$mysqli->prepare($sql1);
$stmt->execute();
$stmt=$mysqli->prepare($sql2);
$stmt->execute();
$result = $stmt->fetch();

$stmt=$mysqli->prepare($sql3);
$stmt->bindParam(1,$result["User_Login_Id"]);
$stmt->execute();
$Url="Location: ".$HOST."Login.php";
// echo $Url;
header($Url);
exit;
?>

