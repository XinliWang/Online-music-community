<?php
/**
 * Created by PhpStorm.
 * User: Xuer
 * Date: 12/6/14
 * Time: 01:32
 */
date_default_timezone_set("America/New_York");
session_start();
//1.链接数据库
$mysqli = new PDO("mysql:host=localhost;dbname=CS6083_Project", "root", "root");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
//2.
$sql ="delete from  Artist_Fans where Musician_Fan_Id='".$_POST["Musician_Fan_Id"]."' and Followed_Artist_Id= '".$_POST["Followed_Artist_Id"]."'";
$stmt=$mysqli->prepare($sql);
$stmt->execute();

$sql6="update users set User_TrustScore=(User_TrustScore-1) where User_id=".$_COOKIE["user_id"];
$stmt=$mysqli->prepare($sql6);
if (!$stmt->execute()) {
    echo "Execute failed6: (" . $stmt->errorCode() . ") ";
}
?>