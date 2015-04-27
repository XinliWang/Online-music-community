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
$sql="select * from Users where User_Id =".$_SESSION["user_id"];
$stmt=$mysqli->prepare($sql);
if (!$stmt->execute()) {
    echo "Execute failed1: (" . $stmt->errno . ") " . $stmt->error;
}
$result1 = $stmt->fetch();

$sql2="select User_Login_Name from User_Login where User_Login_Id =".$_SESSION["user_id"];
$stmt=$mysqli->prepare($sql2);
if (!$stmt->execute()) {
    echo "Execute failed2: (" . $stmt->errno . ") " . $stmt->error;
}
$result2 = $stmt->fetch();

$sql3="select City_Name from City where City_Id =".$result1["User_City"];
$stmt=$mysqli->prepare($sql3);
if (!$stmt->execute()) {
    echo "Execute failed3: (" . $stmt->errno . ") " . $stmt->error;
}
$result3 = $stmt->fetch();
$_SESSION["User_Login_Name"]=$result2["User_Login_Name"];
$_SESSION["User_DoB"]=$result1["User_DoB"];
$_SESSION["City_Name"]=$result3["City_Name"];
$_SESSION["User_Email"]=$result1["User_Email"];
$_SESSION["User_Profile"]=$result1["User_Profile"];
$_SESSION["User_TrustScore"]=$result1["User_TrustScore"];
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





<!-- BEGIN .section -->
<div class="section page-content clearfix">

    <h2 class="page-title"><?php echo $_SESSION["User_Login_Name"];?></h2>
    <?php
    if($_SESSION["user_id"]==$_COOKIE[user_id])
        echo "<p>Hello, ".$_SESSION["User_Login_Name"].". Welcome to your account area where you can view recent orders, modify your billing details and delivery addresses. If you would like to return a product please see our <a href= \"#\">returns page</a > and then <a href=\"#\">contact us</a ></p >";
    ?>
    <ul class="columns-2 checkout-form clearfix" id="form1">
        <li class="col2 clearfix">
            <div class="tag-title-wrap clearfix"><h4 class="tag-title">Profile</h4></div>
            <table>
                <tr>
                    <th >Name</th><td><?php echo $_SESSION["User_Login_Name"];?></td>
                </tr>
                <tr>
                    <th >Day of Birth</th><td><?php echo $_SESSION["User_DoB"];?></td>
                </tr>
                <tr>
                    <th >City</th><td><?php echo $_SESSION["City_Name"];?></td>
                </tr>
                <tr>
                    <th >E-mail</th><td ><?php echo $_SESSION["User_Email"];?></td>
                </tr>
                <tr>
                    <th >Profile</th><td ><?php echo $_SESSION["User_Profile"];?></td>
                </tr>

                <?php
                if($_SESSION["user_id"]==$_COOKIE[user_id])
                    echo "<tr>
           <td colspan='2'> <input class=\"button2 fr\" type=\"button\" value=\"Create new profile &raquo;\" id=\"new_profile_submit\" name=\"submit\" />

        </td></tr>";
                else{
                    $sql = "select * from Users_Fans where User_Fan_Id=".$_COOKIE["user_id"]." and Followed_User_Id=".$_SESSION["user_id"];
                    $stmt=$mysqli->prepare($sql);
                    if (!$stmt->execute()) {
                        echo "Execute failed2: (" . $stmt->errorCode() . ") " . $stmt->error;
                    }
                    $result=$stmt->fetch();
                    if($_COOKIE["user_id"]!=$_GET["user_id"])
                    {
                        if($result!=null || $result!="")
                        {
                            echo "<tr>
           <td colspan='2'> <input class=\"button2 fr\" hidden=\"hidden\" type=\"button\" value=\"FOLLOW &raquo;\" id=\"follow_other_user\" name=\"submit\" />
        </td></tr>
        <tr>
           <td colspan='2'> <input class=\"button2 fr\" type=\"button\"  value=\"CANCEL FOLLOWED &raquo;\" id=\"cancel_follow_other_user\" name=\"submit\" />
        </td></tr>";
                        }
                        else{
                            echo "<tr>
           <td colspan='2'> <input class=\"button2 fr\" type=\"button\"  value=\"FOLLOW &raquo;\" id=\"follow_other_user\" name=\"submit\" />
        </td></tr>
        <tr>
           <td colspan='2'> <input class=\"button2 fr\" type=\"button\"  hidden=\"hidden\" value=\"CANCEL FOLLOWED &raquo;\" id=\"cancel_follow_other_user\" name=\"submit\" />
        </td></tr>";
                        }
                    }

                }
                ?>
            </table>
        </li>
    <form method="post" action="Update Profile.php" id="profile_form" hidden="hidden">
    <ul class="columns-2 checkout-form clearfix">
        <li class="col2 clearfix">
            <div class="tag-title-wrap clearfix"><h4 class="tag-title">Edit Profile</h4></div>
            <ul class="columns-2 checkout-form clearfix">
                <li class="col2 clearfix">
                    <table>
                        <tr>
                            <td>Day of Birth:</td><td><input  type="text" name="DoB"value="<?php echo $_SESSION["User_DoB"];?>" /></td>
                        </tr>
                        <tr>
                            <td>City:</td><td><input  type="text" name="city" value="<?php echo $_SESSION["City_Name"];?>" /></td>
                        </tr>
                        <tr>
                            <td>E-mail:</td><td><input  type="text" name="email-address" value="<?php echo $_SESSION["User_Email"];?>" /></td>
                        </tr>
                        <tr>
                            <td>Profile:</td><td><input  type="text" name="profile"  value="<?php echo $_SESSION["User_Profile"];?>" /></td>

                        <tr>
                            <input class="button2 fr" type="submit" value="Update Profile &raquo;" id="submit" name="submit" /></tr>
                    </table>
                </li>
            </ul>
</li>
</ul>
</form>




<!-- END .section -->
<ul class="columns-2 checkout-form clearfix" id="form1">
    <li class="col2 clearfix">

<?php
if($_SESSION["User_TrustScore"]>1 && $_SESSION["user_id"]==$_COOKIE[user_id])
{
    echo" <a href = \"User_post.php?user_id= ". $_COOKIE["user_id"]."\" > Post concert </a >  </br>  ";
}
if($_SESSION["user_id"]==$_COOKIE[user_id])
{
?>

        <a href = "Recommendationlists.php?user_id= '<?= $_COOKIE["user_id"]?>'" > Create Recommendationlist </a >
<?php }?>
    </li>

</ul>
<!-- BEGIN #footer -->
<div id="footer">

    <ul class="columns-4 clearfix">
        <li class="col4">

            <!-- BEGIN .widget -->
            <div class="widget">
                <div class="widget-title clearfix">
                    <h6>Customer Services</h6>
                </div>

                <ul>
                    <li class="contact-phone">+44 0123456789</li>
                    <li class="contact-mail">mail [at] website [dot] com</li>
                </ul>

                <!-- END .widget -->
            </div>

        </li>
        <li class="col4">

            <!-- BEGIN .widget -->
            <div class="widget">
                <div class="widget-title clearfix">
                    <h6>Categories</h6>
                </div>

                <ul>
                    <li><a href="#">Skin Care</a ></li>
                    <li><a href="#">Bath &amp; Body Care</a ></li>
                    <li><a href="#">Fragrance</a ></li>
                    <li><a href="#">Make-Up</a ></li>
                    <li><a href="#">Hair</a ></li>
                    <li><a href="#">Moisturisers</a ></li>
                </ul>

                <!-- END .widget -->
            </div>

        </li>
        <li class="col4">

            <!-- BEGIN .widget -->
            <div class="widget">
                <div class="widget-title clearfix">
                    <h6>Tags</h6>
                </div>

                <ul class="wp-tag-cloud clearfix">
                    <li><a href="#">Body Scrubs</a ></li>
                    <li><a href="#">Eye Care</a ></li>
                    <li><a href="#">Eyes</a ></li>
                    <li><a href="#">Lips</a ></li>
                    <li><a href="#">Cheeks</a ></li>
                    <li><a href="#">Candles</a ></li>
                    <li><a href="#">Shampoo</a ></li>
                    <li><a href="#">Conditioner</a ></li>
                    <li><a href="#">Body Wash</a ></li>
                </ul>

                <!-- END .widget -->
            </div>

        </li>
        <li class="col4">

            <!-- BEGIN .widget -->
            <div class="widget">
                <div class="widget-title clearfix">
                    <h6>Flickr</h6>
                </div>

                <div class="flickr_badge_wrapper clearfix">

                    <div style="clear:both;margin:0 0 10px 0;"></div>
                    <p class="button2"><a href="http://sc.chinaz.com/">sc.chinaz.com</a ></p >
                </div>

                <!-- END .widget -->
            </div>

        </li>
    </ul>

    <!-- END #footer -->
</div>

<div id="footer-bottom" class="clearfix">

    <div class="fl">

        <ul>
            <li><a href="index.html">Home</a ></li>
            <li><a href="blog.html">Blog</a ></li>
            <li><a href="contact.html">Contact Us</a ></li>
            <li><a href="Artists.php">Products</a ></li>
        </ul>

        <p>&copy; Copyright 2013</p >

    </div>

    <div class="fr">
        < img src=" images/payment-methods.png" alt="Payment Methods" />
    </div>

</div>

<!— END .wrapper —>
</div>

<!— END body —>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
<script type="text/javascript">
    $("#new_profile_submit").click(function(){
        $("#profile_form").show();
    });
    $("#follow_other_user").click(function(){
        $.post("Follow_other_user.php",
            {
                User_Fan_Id:<?php echo $_COOKIE["user_id"]; ?>,
                Followed_User_Id:<?php echo $_SESSION["user_id"];?>
            },
            function(data,status){
                //alert("Data: " + data + "\nStatus: " + status);
            });
        $("#follow_other_user").hide();
        $("#cancel_follow_other_user").show();
    });

    $("#cancel_follow_other_user").click(function(){
        $.post("Cancel_follow_other_user.php",
            {
                User_Fan_Id:<?php echo $_COOKIE["user_id"]; ?>,
                Followed_User_Id:<?php echo $_SESSION["user_id"];?>
            },
            function(data,status){
                //alert("Data: " + data + "\nStatus: " + status);
            });
        $("#cancel_follow_other_user").hide();
        $("#follow_other_user").show();
    });

</script>
</html>