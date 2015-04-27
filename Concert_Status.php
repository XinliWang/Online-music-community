<?php
/**
 * Created by PhpStorm.
 * User: Xuer
 * Date: 12/6/14
 * Time: 14:35
 */
date_default_timezone_set("America/New_York");
session_start();
$HOST="http://localhost:8888/MAMP/CS6083_project/";
$_SESSION["Concert_Type"]=$_GET["Concert_Type"];
if(isset($_COOKIE["user_id"]))
{
    //1.链接数据库
    $mysqli = new PDO("mysql:host=localhost;dbname=CS6083_Project", "root", "root");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    $sql1="select User_Status from Post_Action,Ratings where Post_User_login='"
        .$_COOKIE["user_id"]."' and Concert_Type='" .$_SESSION["Concert_Type"]."' and "
        ."Ratings.Post_Rating_id = Post_Action.post_id";
    $stmt=$mysqli->prepare($sql1);
    $stmt->execute();
    $result1 = $stmt->fetch();
    if($result1["User_Status"]==""||$result1["User_Status"]==null)
    {
        $result1["User_Status"]=0;
    }
}
else{
    $result1["User_Status"]=-1;
}

$Url="Location: ".$HOST."Concert.php?User_Status=".$result1["User_Status"]."&Concert_Type=".$_SESSION["Concert_Type"];
// echo $Url;
header($Url);
exit;

