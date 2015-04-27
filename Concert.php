<?php
date_default_timezone_set("America/New_York");
session_start();
$HOST="http://localhost:8888/MAMP/CS6083_project/";
//1.链接数据库
$mysqli = new PDO("mysql:host=localhost;dbname=CS6083_Project", "root", "root");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$_SESSION["user_id"]=$_GET["user_id"];
$_SESSION["Concert_Type"]=$_GET["Concert_Type"] ;
$sql="select * from Concerts where Concert_Id =".$_GET["Concert_Type"];
$stmt=$mysqli->prepare($sql);
if (!$stmt->execute()) {
    echo "Execute failed1: (" . $stmt->errno . ") " . $stmt->error;
}
$result1 = $stmt->fetch();


$sql3="select Venue_Name from Venue where Venue_Id =".$result1["Venue_Id"];
$stmt=$mysqli->prepare($sql3);
if (!$stmt->execute()) {
    echo "Execute failed3: (" . $stmt->errno . ") " . $stmt->error;
}
$result3 = $stmt->fetch();
$_SESSION["Concert_Name"]=$result1["Concert_Name"];
$_SESSION["Concert_Timestamp"]=$result1["Concert_Timestamp"];
$_SESSION["Concert_Link"]=$result1["Concert_Link"];
$_SESSION["Concert_Intro"]=$result1["Concert_Intro"];
$_SESSION["Concert_Price"]=$result1["Concert_Price"];
$_SESSION["Concert_Availability"]=$result1["Concert_Availability"];
$_SESSION["Venue_Name"]=$result3["Venue_Name"];
?>
<?php
$sql="select CURRENT_TIMESTAMP()";
$stmt=$mysqli->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();
$sql1="select * from Concerts where  Concert_Id='" .$_GET["Concert_Type"]."'";
$stmt=$mysqli->prepare($sql1);
$stmt->execute();
$result1 = $stmt->fetch();
$_SESSION["Concert_Id"]=$_GET["Concert_Type"];
//echo $result1["Concert_Timestamp"];
//echo $result["CURRENT_TIMESTAMP()"];

?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html dir="ltr" lang="en-US" class="ie6"> <![endif]-->
<!--[if IE 7]>    <html dir="ltr" lang="en-US" class="ie7"> <![endif]-->
<!--[if IE 8]>    <html dir="ltr" lang="en-US" class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html dir="ltr" lang="en-US"> <!--<![endif]-->

<!-- BEGIN head -->
<head>

    <!--Meta Tags-->
    <meta name="viewport" content="width=device-width; initial-scale=1.0" />


    <!--Title-->
    <title>Organic Shop - A Premium HTML Template for Ecommerce Websites</title>

    <!--Stylesheets-->
    <link rel="stylesheet" href="css/superfish.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="all" />
    <link type="text/css" href="css/jqueryui/jquery.ui.datepicker.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/responsive.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/flexslider.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/colours/green.css" type="text/css" media="all" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css' />
    <link href='http://fonts.googleapis.com/css?family=Cardo:400,400italic,700' rel='stylesheet' type='text/css' />

    <!--Favicon-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

    <!--JavaScript-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js'></script>
    <script type='text/javascript' src='js/jquery.prettyPhoto.js'></script>
    <script type="text/javascript" src="js/superfish.js"></script>
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>

    <!--[if (gte IE 6)&(lte IE 8)]>
    <script type="text/javascript" src="js/selectivizr-min.js"></script>
    <![endif]-->


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<!-- END head -->
<!-- BEGIN body -->
<body>

<!-- BEGIN .wrapper -->
<div class="wrapper">

<!-- BEGIN .topbar -->
<div class="topbar clearfix">

    <!-- BEGIN .social-icons -->
    <ul class="social-icons">
        <li><a href="#"><span id="twitter_icon"></span></a></li>
        <li><a href="#"><span id="facebook_icon"></span></a></li>
        <li><a href="#"><span id="googleplus_icon"></span></a></li>
        <li><a href="#"><span id="skype_icon"></span></a></li>
        <li><a href="#"><span id="flickr_icon"></span></a></li>
        <li><a href="#"><span id="linkedin_icon"></span></a></li>
        <li><a href="#"><span id="vimeo_icon"></span></a></li>
        <li><a href="#"><span id="youtube_icon"></span></a></li>
        <li><a href="#"><span id="rss_icon"></span></a></li>
        <!-- END .social-icons -->
    </ul>
    <?php
    if(!isset($_COOKIE["user_id"])) {
        // 用户的登录操作过期
        echo "<!-- BEGIN .topbar-right -->
    <div class=\"topbar-right clearfix\">

        <ul class=\"clearfix\">
            <li class=\"checkout-icon\"><a href=\"Login.html\">Login in</a></li>
            <li class=\"myaccount-icon\"><a href=\"Registerpage.php\">Sign up</a></li>
        </ul>

        <!-- END .topbar-right -->
    </div>";
    }else{
        if($_COOKIE["user_type"]==0)
        {
            echo "<!-- BEGIN .topbar-right -->
    <div class=\"topbar-right clearfix\">

        <ul class=\"clearfix\">
            <li>Welcome,".$_COOKIE["user_name"]."</li>
            <li class=\"myaccount-icon\"><a href=\"Artists_personal.php?artist_id=".$_COOKIE["user_id"]."\"> My account </a></li>
            <li class=\"myaccount-icon\"><a href= \"logoff.php\"> Logoff</a ></li>
        </ul>

        <!-- END .topbar-right -->
    </div>";
        }
        else
        {
            echo "<!-- BEGIN .topbar-right -->
    <div class=\"topbar-right clearfix\">

        <ul class=\"clearfix\">
            <li class=\"myaccount-icon\">welcome,<a href=\"Users.php?user_id=".$_COOKIE["user_id"]."\">".$_COOKIE["user_name"]."</a></li>
             <li class=\"myaccount-icon\"><a href= \"logoff.php\"> Logoff</a ></li>
        </ul>
        <!-- END .topbar-right -->
    </div>";
        }

    }
    ?>
</div>
<!-- END .topbar -->
<!-- BEGIN #site-title -->
<div id="site-title">
    <a href="Index.php">
        <h1>Music <span>playing</span></h1>
    </a>
</div>
<!-- END #site-title -->
<?php

if($_COOKIE["user_type"]==0)
{//Artists
    echo "<!-- BEGIN .main-menu-wrapper -->
<div id=\"main-menu-wrapper\" class=\"clearfix\">

    <ul id=\"main-menu\" class=\"fl\">
        <li class=\"current_page_item\"><a href=\"Index.php\">Home</a></li>
        <li><a href=\"Concert_list.php\">Concert</a></li>
        <li><a href=\"Artists_personal.php?user_id=".$_COOKIE["user_id"]."\">Artists</a></li>
    </ul>
</div>
<!-- END .main-menu-wrapper -->";
}
else
{//Users
    echo "<!-- BEGIN .main-menu-wrapper -->
<div id=\"main-menu-wrapper\" class=\"clearfix\">
    <ul id=\"main-menu\" class=\"fl\">
        <li class=\"current_page_item\"><a href=\"Index.php\">Home</a></li>
        <li><a href=\"Concert_list.php\">Concert</a></li>
        <li><a href=\"User_list.php\">User</a></li>
        <li><a href=\"Artist_list.php\">Artist</a></li>
        <li><a href=\"Category.php\">Category</a></li>";
    echo"<ul>";

    echo"</ul>";

    echo " <li><a href=\"Search.php?\">Search</a></li>
       <!-- <li><a href=\"Search.php\">Search</a></li>-->
    </ul>

</div>
<!-- END .main-menu-wrapper -->";
}
?>

<!-- BEGIN .slider -->
<div class="slider slide-loader clearfix">
    <ul class="slides">
        <li>
            <a href="# " title="Slide 1" target="_blank"><img src="images/slide3.jpg" alt="" /></a >
            <div class="flex-caption">
                <p>Endless summer parties</p >
                <div class="clearboth"></div>
                <p>Don't miss out!</p >
            </div>
        </li>

        <li>
            <a href="#" title="Slide 2" target="_blank"><img src="images/slide2.jpg" alt="" /></a >
            <div class="flex-caption">
                <p>Only the finest musics</p >
                <div class="clearboth"></div>
                <p>are showed in our life</p >
            </div>
        </li>

        <li>
            <a href="#" title="Slide 3" target="_blank"><img src="images/slide1.jpg" alt="" /></a >
            <div class="flex-caption">
                <p>We believe in a fantastic concert</p >
                <div class="clearboth"></div>
                <p>we can have an awesome experience</p >
            </div>
        </li>
    </ul>
    <!— END .slider —>
</div>






<?php
/*$_SESSION["User_Login_Name"]=$result2["User_Login_Name"];
$_SESSION["User_DoB"]=$result2["User_DoB"];
$_SESSION["City_Name"]=$result3["City_Name"];
$_SESSION["User_Email"]=$result2["User_Email"];
$_SESSION["User_Profile"]=$result2["User_Profile"];*/
?>








<!-- BEGIN .section -->
<div class="section page-content clearfix">

    <?php
    if($_SESSION["user_id"]==$_COOKIE[user_id])
        echo "<p>Hello, ".$_SESSION["User_Login_Name"].". Welcome to your account area where you can view recent orders, modify your billing details and delivery addresses. If you would like to return a product please see our <a href=\"#\">returns page</a> and then <a href=\"#\">contact us</a></p>";
    ?>
    <ul class="columns-2 checkout-form clearfix" id="form1">
        <li class="col2 clearfix">
            <div class="tag-title-wrap clearfix"><h4 class="tag-title">Profile</h4></div>
            <table>
                <tr>
                    <th >Concert Name</th><td><?php echo $_SESSION["Concert_Name"];?></td>
                </tr>
                <tr>
                    <th >Time</th><td><?php echo $_SESSION["Concert_Timestamp"];?></td>
                </tr>
                <tr>
                    <th >Link</th><td><?php echo $_SESSION["Concert_Link"];?></td>
                </tr>
                <tr>
                    <th >Introduction</th><td ><?php echo $_SESSION["Concert_Intro"];?></td>
                </tr>
                <tr>
                    <th >Price</th><td ><?php echo $_SESSION["Concert_Price"];?></td>
                </tr>
                <tr>
                    <th >Availability</th><td ><?php echo $_SESSION["Concert_Availability"];?></td>
                </tr>
                <tr>
                    <th >Venue</th><td ><?php echo $_SESSION["Venue_Name"];?></td>
                </tr>
  <?php
      ?>
           <?php



  $sql="select User_Type from User_Login where user_Login_Id =".$_COOKIE["user_id"];
  $stmt=$mysqli->prepare($sql);
  $stmt->execute();
  $type=$stmt->fetch();
  if($type["User_Type"]==1)
  {

      if($result1["Concert_Timestamp"]>$result["CURRENT_TIMESTAMP()"]) {
          if ($_GET["User_Status"] == 0) {
              //音乐会没有开始且用户没有预约
              echo "<tr><td colspan='2'> <input class=\"button2 fr\" type=\"button\" value=\"RSVP &raquo;\" id=\"rsvp\" name=\"submit\" /></td></tr>
                <tr><td colspan='2'> <input class=\"button2 fr\" hidden=\"hidden\" type=\"button\"  value=\"CANCEL RSVP &raquo;\" id=\"cancel_rsvp\" name=\"submit\" /></td></tr></table>";
          }
          if ($_GET["User_Status"] == 1) {
              //音乐会没有开始且用户有预约
              echo "<tr><td colspan='2'> <input class=\"button2 fr\" hidden=\"hidden\" type=\"button\" value=\"RSVP &raquo;\" id=\"rsvp\" name=\"submit\" /></td></tr>
                <tr><td colspan='2'> <input class=\"button2 fr\"  type=\"button\"  value=\"CANCEL RSVP &raquo;\" id=\"cancel_rsvp\" name=\"submit\" /></td></tr>";
          }
      }
      if($result1["Concert_Timestamp"]<=$result["CURRENT_TIMESTAMP()"]) {
          if ($_GET["User_Status"] == 2) {
              //音乐会结束且用户有评分
              $sql1 = "select Rating_Score from Ratings,Post_Action where Concert_Type='"
                  . $_GET["Concert_Type"] . "' and Post_User_login='" . $_COOKIE[user_id] . "' and  Ratings.Post_Rating_id = Post_Action.post_id";
              $stmt = $mysqli->prepare($sql1);
              $stmt->execute();
              $result1 = $stmt->fetch();
              echo "<tr><td colspan='2'> Your Rating Score :" . $result1[Rating_Score] . "</td></tr>";
              echo "
        <tr> <td colspan='2'><textarea id=\"review_content\"></textarea></td></tr>
        <tr><td colspan='2'> <input class=\"button2 fr\" type=\"button\" value=\"REVIEW &raquo;\"
        id=\"review\" name=\"submit\" /></td></tr>";
          } else {
              //echo 2;
              //音乐会结束且用户没有评分
              echo "<tr><td colspan='2'> <input class=\"button2 fr\" type=\"button\" value=\"RATING &raquo;\" id=\"rating\" name=\"submit\" /></td></tr>";
              echo "<tr> <td colspan='2'><input hidden=\"hidden\" type=\"text\" id=\"Rating_Score\"/></td></tr>
        <tr><td colspan='2'> <input id=\"Rating_Submit\" hidden=\"hidden\" class=\"button2 fr\" type=\"button\" value=\"RATING &raquo;\" name=\"submit\" /></td></tr>";

              echo "<tr><td colspan='2'> <textarea id=\"review_content\"></textarea></td></tr>
        <tr><td colspan='2'> <input class=\"button2 fr\" type=\"button\" value=\"REVIEW &raquo;\"
        id=\"review\" name=\"submit\" /></td></tr>";
          }
          ?>
                  </table>
              </li>
          </ul>
    <?php
    if($result1["Concert_Timestamp"]<=$result["CURRENT_TIMESTAMP()"])
    {
        ?>
    <ul class="columns-2 checkout-form clearfix" id="form1">
    <li class="col2 clearfix">
    <div class="tag-title-wrap clearfix"><h4 class="tag-title">Comments</h4></div>

    <table>
    <?php
    //评论列表
    $sql="select * from comments,post_action where comments.comment_id = post_action.post_id and comment_concert =".$_GET["Concert_Type"]." order by Post_Timestamp desc";
    $stmt1 = $mysqli->prepare($sql);
    if (!$stmt1->execute()) {
        echo "Execute failed1: (" . $stmt1->errorCode() . ") " . $stmt1->error;
    }
    while($result1 = $stmt1->fetch())
    {
        $sql2="select User_Login_Name from User_login where user_login_id =".$result1["Post_User_login"];
        $stmt2 = $mysqli->prepare($sql2);

        if (!$stmt2->execute()) {
            echo "Execute failed2: (" . $stmt2->errorCode() . ") " . $stmt2->error;
        }
        $result2=$stmt2->fetch();
        echo "<tr><th >";
        echo $result2[User_Login_Name];
        echo "</th><td >";
        echo $result1["Comment_Content"];
        echo "</td><td>";
        echo $result1["Post_Timestamp"];
        echo "</td></tr>";
    }
      }
  }
  ?>
    </table>

            </li>
        </ul>
    <?php
    }
    ?>


<!-- END .section -->
  <?php
  $sql="select User_Type from User_Login where user_Login_Id =".$_COOKIE["user_id"];
  $stmt=$mysqli->prepare($sql);
  $stmt->execute();
  $tyoe=$stmt->fetch();
  if($type["User_Type"]==1)
  {

  ?>
    <form method="post" enctype="multipart/form-data" action="Recommend_Add.php?concert_id=<?php echo $_SESSION["Concert_Type"] ?>" >
        <tr>
            <td> Recommendationlist</td>
            <td>
                <select name="Recommendationlist">
                    <?php
                    $stmt3 = $mysqli ->prepare("Select * from Recommendationlists");
                    $stmt3->execute();
                    while($row2 = $stmt3->fetch()) {
                        ?>
                        <option value="<?= $row2["Recommendlist_Id"] ?>"> <?= $row2["Recommendlist_Name"] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </td>

        </tr>
        <tr>
            <td colspan="3">
                <input type="submit" value="Add" class="button2"/>
            </td>
        </tr>

    </form>
    <?php }?>




<!-- END .wrapper -->
</div>

<!-- END body -->
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js'></script>

<script type="text/javascript">
    $("#rsvp").click(function(){
        $.post("RSVP.php",
            {
                Concert_Type:<?php echo $_SESSION["Concert_Id"];?>,
                Post_User_Login:<?php echo $_COOKIE["user_id"];?>
            },
            function(data,status){
                 alert("Data: " + data + "\nStatus: " + status);
            });
        $("#rsvp").hide();
        $("#cancel_rsvp").show();
    });

    $("#cancel_rsvp").click(function(){
        $.post("Cancel_RSVP.php",
            {
                //alert(1);
                Concert_Type:<?php echo $_SESSION["Concert_Id"];?>,
                Post_User_Login:<?php echo $_COOKIE["user_id"];?>
            },
            function(data,status){
                //alert("Data: " + data + "\nStatus: " + status);
            });
        $("#cancel_rsvp").hide();
        $("#rsvp").show();
    });

    $("#rating").click(function(){
        $("#rating").hide();
        $("#Rating_Score").show();
        $("#Rating_Submit").show();

    });
    $("#Rating_Submit").click(function(){
        alert("<?php echo $_SESSION["Concert_Id"];?>");
        $.post("Rating.php",
            {
                Rating_Score: $("#Rating_Score").val(),
                Concert_id:<?php echo $_SESSION["Concert_Id"];?>
            },
            function(data,status){
                //alert("Data: " + data + "\nStatus: " + status);
            });

    });

    $("#review").click(function(){
        alert("1");
        $.post("review.php",
            {
                Review_Content:$("#review_content").val(),
                Concert_id:<?php echo $_SESSION["Concert_Id"];?>
            },
            function(data,status){
                //alert("Data: " + data + "\n" +
                "Status: " + status);
            });

    });


</script>

</html>