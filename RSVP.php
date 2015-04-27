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
$sql1 ="insert into Post_Action(Post_User_Login,Post_Type) values('".$_POST["Post_User_Login"]."', 2)";
$sql2="select post_id from post_action where post_user_login='".$_POST["Post_User_Login"]."' and Post_Type = 2 "
    ."and Post_Timestamp >= ALL(select Post_Timestamp from post_action where post_user_login='"
    .$_POST["Post_User_Login"]."' and Post_Type = 2 )";
//echo $sql;
$stmt=$mysqli->prepare($sql1);
$stmt->execute();
$stmt=$mysqli->prepare($sql2);
if (!$stmt->execute()) {
    echo "Execute failed2: (" . $stmt->errorCode() . ") ";
}
$result=$stmt->fetch();
//echo $result["post_id"];
$sql3 ="insert into Ratings(Post_rating_Id,Concert_Type,User_status) values('"
    .$result["post_id"]."','".$_POST["Concert_Type"]."',1)";

$stmt=$mysqli->prepare($sql3);
if (!$stmt->execute()) {
    echo "Execute failed3: (" . $stmt->errorCode() . ") ";
}
$sql6="update users set User_TrustScore=(User_TrustScore+1) where User_id=".$_COOKIE["user_id"];
//echo $sql6;
$stmt=$mysqli->prepare($sql6);
if (!$stmt->execute()) {
    echo "Execute failed6: (" . $stmt->errorCode() . ") ";
}
?>