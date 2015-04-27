<?php
session_start();
$Recommendlist_Name = $_POST["Recommendlist_Name"];


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <title>update profile</title>
    <meta http-equiv="refresh" content="1; url = Recommendationlists.php">
</head>



<body>
Create Successfully!

<?php

$servername = "localhost";
$username = "root";
$keyword = "root";
$dbname = "CS6083_Project";




try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $keyword);
    $stmt = $conn->prepare("Insert into Recommendationlists(Recommendlist_Id,Recommend_User_Id,Recommend_Timestamp,Recommendlist_Name)
     values('',?, now() ,?)");
    $stmt ->bindParam(1,$_COOKIE["user_id"]);
    $stmt ->bindParam(2,$Recommendlist_Name);
    $stmt->execute();









} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>

</body>
</html>