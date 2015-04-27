<?php
date_default_timezone_set("America/New_York");
session_start();
$HOST="http://localhost:8888/MAMP/CS6083_project/";
$mysqli = new PDO("mysql:host=localhost;dbname=CS6083_Project", "root", "root");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$sql1="select city_id from city where city_name='".$_POST["city"]."'";
$stmt=$mysqli->prepare($sql1);
if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
$result=$stmt->fetch();
$sql3="Update Users set User_DoB='".$_POST["DoB"]."',User_Email='".$_POST["email-address"]."',User_City='".$result["city_id"]."',User_Profile='".$_POST["profile"].
    "'where User_Id='".$_COOKIE["user_id"]."'";
//echo $sql3;
$stmt=$mysqli->prepare($sql3);
if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
$Url="Location: ".$HOST."Users.php?user_id=".$_COOKIE["user_id"];
// echo $Url;
header($Url);
exit;
?>