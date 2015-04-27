<?php
session_start();
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




<table width="300" border="1" >
    <tr>
        <th width="200">Users:  </th>

    </tr>
    <!-- BEGIN .section -->
    <?php
    $servername = "localhost";
    $username = "root";
    $keyword = "root";
    $dbname = "CS6083_Project";

    try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $keyword);

    $stmt = $conn->prepare("SELECT * FROM Users, User_Login  where User_Login_Id = User_Id");

    $stmt->execute();

    while($row = $stmt->fetch()){

    ?>
    <tr>
        <th><a href="Users.php?user_id=<?= $row[User_Id] ?>"><?= $row[User_Login_Name] ?></a></th>

        <?php
        }
        $conn = null;
        }catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }


        ?>
    </tr>
</table>

<!-- END .section -->
<!-- BEGIN .col-sidebar -->



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
                    <li><a href="#">Skin Care</a></li>
                    <li><a href="#">Bath &amp; Body Care</a></li>
                    <li><a href="#">Fragrance</a></li>
                    <li><a href="#">Make-Up</a></li>
                    <li><a href="#">Hair</a></li>
                    <li><a href="#">Moisturisers</a></li>
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
                    <li><a href="#">Body Scrubs</a></li>
                    <li><a href="#">Eye Care</a></li>
                    <li><a href="#">Eyes</a></li>
                    <li><a href="#">Lips</a></li>
                    <li><a href="#">Cheeks</a></li>
                    <li><a href="#">Candles</a></li>
                    <li><a href="#">Shampoo</a></li>
                    <li><a href="#">Conditioner</a></li>
                    <li><a href="#">Body Wash</a></li>
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
                    <p class="button2"><a href="http://sc.chinaz.com/">sc.chinaz.com</a></p>
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
            <li><a href="index.html">Home</a></li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="contact.html">Contact Us</a></li>
            <li><a href="Artists.php">Products</a></li>
        </ul>

        <p>&copy; Copyright 2013</p>

    </div>

    <div class="fr">
        <img src=" images/payment-methods.png" alt="Payment Methods" />
    </div>

</div>

<!-- END .wrapper -->
</div>

<!-- END body -->
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>

</html>