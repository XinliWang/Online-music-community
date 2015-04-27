<?php
session_start();
$Category_id = $_POST[category];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <title>update profile</title>
    <meta http-equiv="refresh" content="1; url = Category.php">
</head>



<body>
Add Successfully!

<?php

$servername = "localhost";
$username = "root";
$keyword = "root";
$dbname = "CS6083_Project";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $keyword);
    $stmt = $conn->prepare("Insert into User_Taste(User_Id_1,Taste_Id) values(?, ?)");
    $stmt ->bindParam(1,$_COOKIE["user_id"]);
    $stmt ->bindParam(2,$Category_id);
    $stmt->execute();


    $conn = null;

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>

</body>
</html>