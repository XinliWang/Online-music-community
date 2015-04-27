<?php
session_start();

$Recommendationlist = $_POST[Recommendationlist];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">

<html>
<head>
    <title>update profile</title>
    <meta http-equiv="refresh" content="1; url = Concert_Status.php?Concert_Type=<?php echo $_GET[concert_id] ?>">
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
    $stmt1 = $conn->prepare("Insert into Post_Action(Post_Id,Post_User_login,Post_Timestamp,Post_Type)
     values('',?, now() ,4)");
    $stmt1 ->bindParam(1,$_COOKIE["user_id"]);
    $stmt1 ->execute();



    $sql2="select Post_Id from post_action where post_user_login='".$_COOKIE["user_id"]."' and Post_Type = 4 "
        ."and Post_Timestamp >= ALL(select Post_Timestamp from post_action where post_user_login='"
        .$_COOKIE["user_id"]."' and Post_Type = 4 )";
    $stmt2=$conn -> prepare($sql2);
    if (!$stmt2->execute()) {
        echo "Execute failed2: (" . $stmt2->errorCode() . ") " . $stmt->error;
    }
    $result2=$stmt2->fetch();


     /*

    $stmt3 = $conn->prepare("Select Concert_Id from Concerts where Concert_Name = ?");
    $stmt3 -> bindParam(1,  $_SESSION["Concert_Name"]);
    $stmt3 -> execute();
    $result3=$stmt3->fetch();  */


    $stmt3 = $conn->prepare("Insert into Recommendations(Recommend_List_id,Recommend_Concert_Id,post_recommend_id)
     values(?,?,?)");
    $stmt3 -> bindParam(1,$_POST[Recommendationlist]);
    $stmt3 -> bindParam(2,$_GET[concert_id]);
    $stmt3 -> bindParam(3,$result2[Post_Id]);
    if (!$stmt3->execute()) {
        echo "Execute failed: (" . $stmt3->errorcode() . ") " ;
    }




} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>

</body>
</html>