<?php
session_start();
$hyperlink = $_POST[hyperlink];
$description = $_POST[description];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <title>update profile</title>
    <meta http-equiv="refresh" content="1; url = Artists_personal.php?user_id=<?php echo $_COOKIE["user_id"] ?>">
</head>



<body>
Edit Successfully!

<?php

$servername = "localhost";
$username = "root";
$keyword = "root";
$dbname = "CS6083_Project";

try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $keyword);
    $stmt = $conn->prepare("Select * from Artists where Artist_Id = ?");
    $stmt ->bindParam(1,$_COOKIE["user_id"]);
    $stmt->execute();
    $row = $stmt->fetch();
    if($row != null){
        $stmt = $conn->prepare("Update Artists set Artist_Profile = ?, Artist_Hyperlink = ? where Artist_Id = ?");
        $stmt ->bindParam(1,$description);
        $stmt ->bindParam(2,$hyperlink);
        $stmt ->bindParam(3,$_COOKIE["user_id"]);
        $stmt->execute();


    }else{

        $stmt = $conn->prepare("Insert into Artists(Artist_Id,Artist_PermissionStatus,Artist_Profile,Artist_Hyperlink,Artist_Verify) values(?,'',?,?,'')");
        $stmt ->bindParam(1,$_COOKIE["user_id"]);
        $stmt ->bindParam(2,$description);
        $stmt ->bindParam(3,$hyperlink);
        $stmt->execute();
    }
    $conn = null;

    } catch (PDOException $e) {
       print "Error!: " . $e->getMessage() . "<br/>";
      die();
}


?>

</body>
</html>