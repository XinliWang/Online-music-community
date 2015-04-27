<?php
/**
 * Created by PhpStorm.
 * User: Xuer
 * Date: 12/6/14
 * Time: 03:03
 */
date_default_timezone_set("America/New_York");
session_start();
//1.链接数据库
$mysqli = new PDO("mysql:host=localhost;dbname=CS6083_Project", "root", "root");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
//2.
$sql1 ="select Post_Action.post_id from  Ratings,Post_Action  where Ratings.Post_Rating_id = Post_Action.post_id and Concert_Type='".$_POST["Concert_Type"]."' and post_user_login='".$_POST["Post_User_Login"]."'";
$stmt=$mysqli->prepare($sql1);
$stmt->execute();
$result=$stmt->fetch();
$sql2="delete from Ratings where Post_rating_id=".$result["post_id"];
$stmt=$mysqli->prepare($sql2);
if(!$stmt->execute()) {
    echo "Execute failed2: (" . $stmt->errorCode() . ") " . $stmt->error;
}

$sql3="delete from Post_Action where post_id=".$result["post_id"];
$stmt=$mysqli->prepare($sql3);
if (!$stmt->execute()) {
    echo "Execute failed3: (" . $stmt->errorCode() . ") " . $stmt->error;
}

$sql6="update users set User_TrustScore=(User_TrustScore-1) where User_id=".$_POST["Post_User_Login"];
$stmt=$mysqli->prepare($sql6);
if (!$stmt->execute()) {
    echo "Execute failed6: (" . $stmt->errorCode() . ") ";
}
?>