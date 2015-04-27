<?php
/**
 * Created by PhpStorm.
 * User: Xuer
 * Date: 12/8/14
 * Time: 01:21
 */

date_default_timezone_set("America/New_York");
session_start();
$HOST="http://localhost:8888/MAMP/CS6083_project/";
$Login_Successful_Url="Index.php";
$Login_Fail_Url="Login.html";
//1.链接数据库
$mysqli = new PDO("mysql:host=localhost;dbname=CS6083_Project", "root", "root");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$sql="update users set user_lastlogintime=current_timestamp() where user_id=".$_COOKIE[user_id];
$stmt=$mysqli->prepare($sql);
$stmt->execute();

$cookie_name = "user_id";
$cookie_value = "";
//echo "$cookie_value =".$cookie_value;
setcookie($cookie_name, $cookie_value, time() - (86400 * 30),'/MAMP/CS6083_project/'); // 86400 = 1 day
$_COOKIE[$cookie_name]=$cookie_value;
$_COOKIE[$cookie_name]=$cookie_value;
//if(isset($_COOKIE["user_type"]))
//    setcookie("user_type", "", time()-3600);
$cookie_name = "user_type";
$cookie_value = "";
//echo "$cookie_value =".$cookie_value;
setcookie($cookie_name, $cookie_value, time() - (86400 * 30),'/MAMP/CS6083_project/'); // 86400 = 1 day
$_COOKIE[$cookie_name]=$cookie_value;
$_COOKIE[$cookie_name]=$cookie_value;
//echo $_COOKIE[$cookie_name];
// if(isset($_COOKIE["user_name"]))
//     setcookie("user_name", "", time()-3600);
$cookie_name = "user_name";
$cookie_value = "";
//echo "$cookie_value =".$cookie_value;
setcookie($cookie_name, $cookie_value, time() - (86400 * 30),'/MAMP/CS6083_project/'); // 86400 = 1 day
$_COOKIE[$cookie_name]=$cookie_value;
$_COOKIE[$cookie_name]=$cookie_value;
//echo $_COOKIE[$cookie_name];
//if(isset($_COOKIE["user_pwd"]))
//    setcookie("user_pwd", "", time()-3600);
$cookie_name = "user_pwd";
$cookie_value = "";
//echo "$cookie_value =".$cookie_value;
setcookie($cookie_name, $cookie_value, time() - (86400 * 30),'/MAMP/CS6083_project/'); // 86400 = 1 day
$_COOKIE[$cookie_name]=$cookie_value;
$_COOKIE[$cookie_name]=$cookie_value;

$Url="Location: ".$HOST.$Login_Successful_Url;
// echo $Url;
header($Url);
exit;

?>