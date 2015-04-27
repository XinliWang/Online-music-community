<?php
/**
 * Created by PhpStorm.
 * User: Xuer
 * Date: 12/6/14
 * Time: 02:51
 */
date_default_timezone_set("America/New_York");
session_start();
$HOST="http://localhost:8888/MAMP/CS6083_project/";
$mysqli = new PDO("mysql:host=localhost;dbname=CS6083_Project", "root", "root");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$sql1="select post_id from Post_Action,Ratings where Post_User_login='"
    .$_COOKIE["user_id"]."' and Concert_Type='" .$_POST["Concert_id"]."' and "
    ."Ratings.Post_Rating_id = Post_Action.Post_id";
$stmt=$mysqli->prepare($sql1);
$stmt->execute();
$result1 = $stmt->fetch();
if ($result1[post_id]==""||$result1[post_id]==null)
{
    //插入新数据
    $sql1 ="insert into Post_Action(Post_User_Login,Post_Type) values('".$_COOKIE["user_id"]."', 2)";
    $sql2="select post_id from post_action where post_user_login='".$_COOKIE["user_id"]."' and Post_Type = 2 "
        ."and Post_Timestamp >= ALL(select Post_Timestamp from post_action where post_user_login='"
        .$_COOKIE["user_id"]."' and Post_Type = 2 )";
    $stmt=$mysqli->prepare($sql1);
    if (!$stmt->execute()) {
        echo "Execute failed1: (" . $stmt->errorCode() . ") ";
    }
    $stmt=$mysqli->prepare($sql2);
    if (!$stmt->execute()) {
        echo "Execute failed2: (" . $stmt->errorCode() . ") ";
    }
    $result=$stmt->fetch();
    $sql3 ="insert into Ratings(Post_rating_Id,Concert_Type,User_status,Rating_Score) values('"
        .$result["post_id"]."','".$_POST["Concert_id"]."',2,'".$_POST["Rating_Score"]."')";

    $stmt=$mysqli->prepare($sql3);
    if (!$stmt->execute()) {
        echo "Execute failed3: (" . $stmt->errorCode() . ") ";
    }
}
else{
   /* $sql4="select post_id from post_action where post_user_login='".$_COOKIE["user_id"]."' and Post_Type = 2 "
        ."and Post_Timestamp >= ALL(select Post_Timestamp from post_action where post_user_login='"
        .$_COOKIE["user_id"]."' and Post_Type = 2 )";
    $stmt=$mysqli->prepare($sql4);
    if (!$stmt->execute()) {
        echo "Execute failed4: (" . $stmt->errorCode() . ") ";
    }
    $result4 = $stmt->fetch();*/
    $sql5="update ratings set Rating_Score='".$_POST["Rating_Score"]."',User_Status='2' where post_rating_id='".$result1[post_id]."'";
    $stmt=$mysqli->prepare($sql5);
    if (!$stmt->execute()) {
        echo "Execute failed5: (" . $stmt->errorCode() . ") ";
    }

    $sql6="update users set User_TrustScore=(User_TrustScore+1) where User_id=".$_COOKIE["user_id"];
    $stmt=$mysqli->prepare($sql6);
    if (!$stmt->execute()) {
        echo "Execute failed6: (" . $stmt->errorCode() . ") ";
    }

}
?>