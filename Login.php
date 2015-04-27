<?php
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

    //2.拼接sql语句
    $_SESSION["where"] =" where User_Login_Name='".$_POST["username"]."' and User_pwd='".$_POST["password"]."'";

    $sql="select * from User_Login";
    $sql=$sql.$_SESSION["where"];
//echo $sql;
//3.执行sql并返回结果
    if (!($stmt=$mysqli->prepare($sql))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $result = $stmt->fetch();//$stmt->setFetchMode(PDO::FETCH_ASSOC);
    // echo "User_Login_Id=".$result['User_Login_Id'];
//4.关闭数据库
    if($result['User_Login_Id']==""||$result['User_Login_Id']==null)
    {
        //用户名或密码错误
        $Url="Location: ".$HOST.$Login_Fail_Url;
        // echo $Url;
        header($Url.'?loginid='.$result['User_Login_Id']);
        exit;

    }else{
        //if(isset($_COOKIE["user_id"]))
        //   setcookie("user_id", "", time()-3600);
        /*
         * 在PHP里Cookie的使用是有一些限制的。
    1、使用setcookie必须在<html>标签之前
    2、使用setcookie之前，不可以使用echo输入内容
    3、直到网页被加载完后，cookie才会出现
    4、setcookie必须放到任何资料输出浏览器前，才送出
        */
        $cookie_name = "user_id";
        $cookie_value = $result['User_Login_Id'];
        //echo "$cookie_value =".$cookie_value;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30),'/MAMP/CS6083_project/'); // 86400 = 1 day
        $_COOKIE[$cookie_name]=$cookie_value;
        $_COOKIE[$cookie_name]=$cookie_value;
        //if(isset($_COOKIE["user_type"]))
        //    setcookie("user_type", "", time()-3600);
        $cookie_name = "user_type";
        $cookie_value = $result['User_Type'];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30),'/MAMP/CS6083_project/'); // 86400 = 1 day$_COOKIE[$cookie_name]=$cookie_value;
        $_COOKIE[$cookie_name]=$cookie_value;
        $_COOKIE[$cookie_name]=$cookie_value;
        //echo $_COOKIE[$cookie_name];
        // if(isset($_COOKIE["user_name"]))
        //     setcookie("user_name", "", time()-3600);
        $cookie_name = "user_name";
        $cookie_value = $result['User_Login_Name'];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30),'/MAMP/CS6083_project/'); // 86400 = 1 day
        $_COOKIE[$cookie_name]=$cookie_value;
        $_COOKIE[$cookie_name]=$cookie_value;
        //echo $_COOKIE[$cookie_name];
        //if(isset($_COOKIE["user_pwd"]))
        //    setcookie("user_pwd", "", time()-3600);
        $cookie_name = "user_pwd";
        $cookie_value = $result['User_Pwd'];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30),'/MAMP/CS6083_project/'); // 86400 = 1 day
        $_COOKIE[$cookie_name]=$cookie_value;
        $_COOKIE[$cookie_name]=$cookie_value;

        $Url="Location: ".$HOST.$Login_Successful_Url;
        // echo $Url;
        header($Url.'?loginid='.$_COOKIE["user_id"]);
        exit;
    }
//echo "loginid = ".$_GET["loginid"];
/*if($_GET["loginid"]!=null) {
    //echo "1";
    $sql = "select * from User_Login where User_Login_Id=" . $_GET["loginid"];
    $stmt = $mysqli->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch();

}*/
//6.判断用户类型
/*if($_COOKIE['user_type']==0)
{//Artist
    $sql3="select  from Artists Where Artist_Id='".$result['User_Login_Id']."'";
    if (!($stmt=$mysqli->prepare($sql3))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $result = $stmt->fetch();
}
else if($_COOKIE['user_type']==1)
{//User
    $sql2="select * from Users Where User_Id='".$result['User_Login_Id']."'";
    if (!($stmt=$mysqli->prepare($sql2))) {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    $result = $stmt->fetch();
}*/
//$conn = null;

?>
