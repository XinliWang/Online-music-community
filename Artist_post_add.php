<?php
session_start();
$concertName = $_POST[concertName];
$concertTime = $_POST[concertTime];
$location = $_POST[location];
$ticketHyperlink = $_POST[ticketHyperlink];
$price = $_POST[price];
$quantity = $_POST[quantity];
$description = $_POST[description];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <title>update profile</title>
    <meta http-equiv="refresh" content="1; url = Artist_post.php?">
</head>



<body>
Post Successfully!

<?php

$servername = "localhost";
$username = "root";
$keyword = "root";
$dbname = "CS6083_Project";




try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $keyword);
    $stmt = $conn->prepare("Insert into Post_Action(Post_Id,Post_User_login,Post_Timestamp,Post_Type)
     values('',?, now() ,1)");
    $stmt ->bindParam(1,$_COOKIE["user_id"]);
    $stmt->execute();



    $sql2="select Post_Id from post_action where post_user_login='".$_COOKIE["user_id"]."' and Post_Type = 1 "
        ."and Post_Timestamp >= ALL(select Post_Timestamp from post_action where post_user_login='"
        .$_COOKIE["user_id"]."' and Post_Type = 1 )";
    $stmt=$conn -> prepare($sql2);
    if (!$stmt->execute()) {
        echo "Execute failed2: (" . $stmt->errorCode() . ") " . $stmt->error;
    }
    $result=$stmt->fetch();




    $stmt = $conn->prepare("Insert into Concerts(Concert_Id,Venue_Id,Concert_Status,Concert_Name,Concert_Timestamp,Concert_Link,Concert_Intro,Concert_Price,Concert_Availability,Concert_Poster)
values(?,?,0,?,?,?,?,?,?,?)");
    $stmt -> bindParam(1,$result[Post_Id]);
    $stmt -> bindParam(2,$location);
    $stmt -> bindParam(3,$concertName);
    $stmt -> bindParam(4,$concertTime);
    $stmt -> bindParam(5,$ticketHyperlink);
    $stmt -> bindParam(6,$description);
    $stmt -> bindParam(7,$price);
    $stmt -> bindParam(8,$quantity);
    $stmt -> bindParam(9,$_COOKIE["user_id"]);
    $stmt -> execute();






} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>

</body>
</html>