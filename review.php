<?php
/**
 * Created by PhpStorm.
 * User: Xuer
 * Date: 12/6/14
 * Time: 02:50
 */
date_default_timezone_set("America/New_York");
session_start();
$HOST="http://localhost:8888/MAMP/CS6083_project/";
//1.链接数据库
$mysqli = new PDO("mysql:host=localhost;dbname=CS6083_Project", "root", "root");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
//2.
$sql1 ="insert into Post_Action(Post_User_Login,Post_Type) values('".$_COOKIE["user_id"]."', 3)";
$sql2="select post_id from post_action where post_user_login='".$_COOKIE["user_id"]."' and Post_Type = 3 "
    ."and Post_Timestamp >= ALL(select Post_Timestamp from post_action where post_user_login='"
    .$_COOKIE["user_id"]."' and Post_Type = 3 )";
//echo $sql;
$stmt=$mysqli->prepare($sql1);
$stmt->execute();
$stmt=$mysqli->prepare($sql2);
if (!$stmt->execute()) {
    echo "Execute failed2: (".$stmt->errorCode().") ";
}
$result=$stmt->fetch();
$sql3 ="insert into Comments(Comment_Id,Comment_Concert,Comment_Content) values('"
    .$result["post_id"]."','".$_POST["Concert_id"]."','".$_POST["Review_Content"]."')";
$stmt=$mysqli->prepare($sql3);
if (!$stmt->execute()) {
    echo "Execute failed3: (" . $stmt->errorCode() . ") ";
}

$sql6="update users set User_TrustScore=(User_TrustScore+2) where User_id=".$_COOKIE["user_id"];
$stmt=$mysqli->prepare($sql6);
if (!$stmt->execute()) {
    echo "Execute failed6: (" . $stmt->errorCode() . ") ";
}
?>