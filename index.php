<?php
require('admin/connect.php');
date_default_timezone_set('Asia/Kolkata');
$date=date("Y-m-d");
$date2=date("d-m-Y");
$getallfest=mysqli_query($connection, "SELECT * FROM fests");
//$getfestresult=mysqli_fetch_assoc($getallfest);
foreach($getallfest as $key=>$getallfest)
{
	$festdate=$getallfest['fdate'];
	$festid=$getallfest['fid'];
	$getsettings=mysqli_query($connection,"SELECT * FROM admin_settings WHERE fid='$festid'");
	$getsettingsrow=mysqli_fetch_assoc($getsettings);
	if(!$getsettingsrow['stopdate']=='0')
	{
	$enddate=$getsettingsrow['stopdate'];
	if($enddate <= $date2)
	{
		//echo 'yo shit';
		$setupdatequery=mysqli_query($connection,"UPDATE admin_settings SET startreg='2' WHERE fid='$festid'");
	}
	}
	if($festdate <= $date)
	{
		//echo 'fest due bro';
		$setupdatequery=mysqli_query($connection,"UPDATE admin_settings SET startreg='2' WHERE fid='$festid'");
	}
	//echo $getallfest['fid'].' ';
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" type="image/png" sizes="16x16" href="/plugins/images/favicon.png">
<title>AlphaSystems-OFMS</title>
<link rel="stylesheet" type="text/css" href="lp-plugins/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="lp-plugins/css/bootstrap-slider.min.css">
<link rel="stylesheet" type="text/css" href="lp-plugins/css/fontawesome-all.min.css">
<link rel="stylesheet" type="text/css" href="lp-plugins/css/slick.css">
<!--<link rel="stylesheet" type="text/css" href="lp-plugins/css/style.css">-->
 <link rel="stylesheet" type="text/css" href="lp-plugins/css/style-darkblue.css">
<link rel="stylesheet" type="text/css" href="lp-plugins/css/custom.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>                                                                                                                                                                                                               
		$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
</script>
    
</head>

<body>
<div id="header-holder" class="main-header">
    <div class="bg-animation">
        <div class="graphic-show">
            <img class="fix-size" src="lp-plugins/images/graphic1.png" alt="">
            <img class="img img1" src="lp-plugins/images/graphic1.png" alt="">
            <img class="img img2" src="lp-plugins/images/graphic2.png" alt="">
            <img class="img img3" src="lp-plugins/images/graphic3.png" alt="">
        </div>
    </div>
    <nav id="nav" class="navbar navbar-default navbar-full">
        <div class="container-fluid">
            <div class="container container-nav">
                <div class="row">
                    <div class="col-md-12">
                        <div class="navbar-header">
                            <button aria-expanded="false" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="logo-holder" href="index.html">
                                <div class="website-logo hidden-xs">
                                    <a href="index.php">
                                        <div class="logo" style="width:246px;height:68px"></div>
                                    </a>
                                </div>
                                <div class="website-logo visible-xs" style="top: 9px; left: 15px">
                                    <a href="index.php">
                                        <div class="logo" style="width:170px;height:50px"></div>
                                    </a>
                                </div>
                            </a>
                        </div>
                        <div style="height: 1px;" role="main" aria-expanded="false" class="navbar-collapse collapse" id="bs">
                         <ul class="nav navbar-nav navbar-right">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="#services">Services</a></li>
                                <li><a href="#fests">Fests</a></li>
                                <li><a href="#about">About Us</a></li>
                                 <li><a href="feedback.php">Feedback</a></li>
                             
                                 <!--<li class="dropdown unity-menu">
                                    <a href="#pricing">Register <i class="fas fa-caret-down"></i></a>
                                   <ul class="dropdown-menu dropdown-unity">
                                        <li>
                                            <a class="unity-link" href="webhosting.html">
                                                <div class="unity-box">
                                                    <div class="unity-icon">
                                                        <img src="lp-plugins/images/service-icon1.svg" alt="">
                                                    </div>
                                                    <div class="unity-title">
                                                        Web Hosting
                                                    </div>
                                                    <div class="unity-details">
                                                        Flexible shared-hosting
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="unity-link" href="resellershosting.html">
                                                <div class="unity-box">
                                                    <div class="unity-icon">
                                                        <img src="lp-plugins/images/service-icon2.svg" alt="">
                                                    </div>
                                                    <div class="unity-title">
                                                        Resellers
                                                    </div>
                                                    <div class="unity-details">
                                                        Money on the side!
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="unity-link" href="cloudhosting.html">
                                                <div class="unity-box">
                                                    <div class="unity-icon">
                                                        <img src="lp-plugins/images/service-icon3.svg" alt="">
                                                    </div>
                                                    <div class="unity-title">
                                                        Cloud Hosting
                                                    </div>
                                                    <div class="unity-details">
                                                        Fast as rocket
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="unity-link" href="vpshosting.html">
                                                <div class="unity-box">
                                                    <div class="unity-icon">
                                                        <img src="lp-plugins/images/service-icon4.svg" alt="">
                                                    </div>
                                                    <div class="unity-title">
                                                        VPS Servers
                                                    </div>
                                                    <div class="unity-details">
                                                        Scalable hosting
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul
                                </li>>-->
<!--
                                <li class="dropdown">
                                    <a href="#">Feedback<i class="fas fa-caret-down"></i></a>
                                    <ul class="dropdown-menu">
                                      <li><a href="./login/feedback.php">ADD Feedback</a></li>
                                      </li>
                                    </ul>
                                </li>
-->
                               <!-- <li><a href="../../whmcs/index.php?systpl=hostify">WHMCS</a></li>
                                <li><a href="contact.html">Contact us</a></li>
                               <!-- <li><a class="login-button" href="signin.html">Login</a></li>-->
                                <li class="support-button-holder support-dropdown">
                                    <a class="support-button" href="login/index.php">Login</a>
                                   <!-- <ul class="dropdown-menu">
                                      <li><a href="#"><i class="fas fa-phone"></i>Toll-Free  08-197-435-01</a></li>
                                      <li><a href="#"><i class="fas fa-comments"></i>Start a Live Chat</a></li>
                                      <li><a href="#"><i class="fas fa-ticket-alt"></i>Open a ticket</a></li>
                                      <li><a href="#"><i class="fas fa-book"></i>Knowledge base</a></li>
                                    </ul>-->
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!--header ends -->
    
    <div id="top-content" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div id="main-slider">
                        <div class="slide">
                           <!-- <div class="noti-holder">
                                <a href="#">
                                 <span class="badge">New</span><span class="text">Added new packages in cloud hosting.</span>
                                    </div>
                                </a>
                            </div>-->
                            <div class="spacer"></div>
                            <div class="big-title">Get a new interface for the <span>fest </span><br>you host.</div>
                            <p>Your very own system,anywhere anytime. </p>
                            <div class="btn-holder">
                                <a href="./login/register-user.php" class="ybtn ybtn-header-color">Host A Fest!</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <img class="header-graphic" src="lp-plugins/images/graphic1.png" alt="" />
                </div>
            </div>
        </div>
    </div>
</div>
<div id="services" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-title">Our Services</div>
                <div class="row-subtitle">Designed to satisfy your creative needs.</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="service-box">
                    <div class="service-icon">
                        <img src="lp-plugins/images/service-icon1.svg" alt="">
                    </div>
                    <div class="service-title">Easy Interface</div>
                    <div class="service-details">
                        <p> A user-friendly interface that  provides quick access to  features or commands.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="service-box">
                    <div class="service-icon">
                        <img src="lp-plugins/images/service-icon2.svg" alt="">
                    </div>
                    <div class="service-title">Customise</div>
                    <div class="service-details">
                        <p>Design the fest the way you want,according to ur taste.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="service-box">
                    <div class="service-icon">
                        <img src="lp-plugins/images/service-icon3.svg" alt="">
                    </div>
                    <div class="service-title">Complete Control</div>
                    <div class="service-details">
                        <p>We assure you with complete control to your Fest settings.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="service-box">
                    <div class="service-icon">
                        <img src="lp-plugins/images/service-icon4.svg" alt="">
                    </div>
                    <div class="service-title">Trusted 100%</div>
                    <div class="service-details">
                        <p>The technology that you can trust without any questions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--till image animation -->



<!--upcomining fest begins-->
   
<div id="domain-quick-pricing" class="container-fluid">
    <div class="bg-color"></div>
    
    <div class="container" id="fests">
        <div class="row">
            <div class="col-md-12">
                <div class="row-title"> Upcoming Fests</div>
                <div class="row-subtitle">Enroll For Exciting Fests.</div>
            </div>
        </div>
        <br>
        <div class="row">
            <?php 
            require("admin/connect.php");
            $getfestquery="SELECT * FROM fests WHERE fdate>='$date' OR ftodate='$date2' ORDER BY fdate";
            $getfestresult=mysqli_query($connection,$getfestquery); while($getfests=mysqli_fetch_assoc($getfestresult))
			{  
				$fid=$getfests['fid'];
				$getsettingsquery="SELECT * FROM admin_settings WHERE fid='$fid'";
				$getsettings=mysqli_query( $connection, $getsettingsquery );
				$getsetrow = mysqli_fetch_assoc( $getsettings );
				if($getsetrow['viewfest']==1){
            ?>
            <div class="col-sm-6 col-md-4" style="height: 390px; max-height: 390px; display: inline-block;">
                <div class="domain-box d-color1">
                    <div class="title" style="font-size: -3;">FEST<!--<img src="lp-plugins/images/service-icon1.svg" alt="">--></div>
                    <div class="pricing-title"><?php echo $getfests['fname'] ?></div>
                    <div class="price" style="padding-top: 5px"><?php echo $getfests['cname'] ?></div>
					<div class="details"><?php echo $getfests['fdesc'] ?> <p style="padding-top: 10px"><i class="fa fa-calendar-alt"></i><?php $dateb=$getfests['fdate'];
					$myDateTime = DateTime::createFromFormat('Y-m-d', $dateb);
					$dobc = $myDateTime->format('d-m-Y');  echo ' '.$dobc; if($getfests['fnodays']>=2){ echo ' to '.$getfests['ftodate']; } ?></p></div>
                  
                    <div class="link"><a class="register-button" href="fest-details.php?id=<?php echo $getfests['fid'] ?>">View Details</a></div>
                </div>
            </div>
            <?php } } ?>
<!--
            <div class="col-sm-6 col-md-4">
                <div class="domain-box d-color2">
                    <div class="title"></div>
                    <div class="price">Festname 2</div>
                    <div class="details">fest description</div>
                    <div class="link"><a class="register-button" href="./admin/add-participants.php">Register</a></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="domain-box d-color3">
                    <div class="title"></div>
                    <div class="price">Festname 3</div>
                    <div class="details">fest description</div>
                    <div class="link"><a class="register-button" href="./admin/add-participants.php">Register</a></div>
                </div>
            </div>
-->
        </div>
    </div>
</div>
       
<!--upcoming fests ends-->
	<div id="about"></div>
<!--About alphatech begins  -->
<div id="header-holder" class="inner-header about-header">
 <div id="page-head" class="container-fluid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="icons-animation-holder">
                        <div class="aicon aicon1"><img src="lp-plugins/images/aicon1.png" alt=""></div>
                        <div class="aicon aicon2"><img src="lp-plugins/images/aicon2.png" alt=""></div>
                        <div class="aicon aicon3"><img src="lp-plugins/images/aicon3.png" alt=""></div>
                        <div class="aicon aicon4"><img src="lp-plugins/images/aicon4.png" alt=""></div>
                        <div class="aicon aicon-main">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 134 38" width="124px" height="35px" class="logo">
                                <text kerning="auto" font-family="Rubik" align="center" fill="rgb(255, 255, 255)" transform="matrix( 11.051445195489, 0, 0, 11.0388026563729,0.08427829227281, 28.538802656373)" font-size="3.79px">OFMS</text>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 company-info-holder">
                    <h4>About AlphaSystems</h4>
                    <div class="info-slider">
                        <div>
                            <div class="details-holder">
                                <p>AlphaSystems is the one stop<br>
                                    place to check out all the<br>
                                   events that is occuring around<br>
                                    your place.<br>
                                    
                                   </p>
                            </div>
                        </div>
                        <div>
                            <div class="details-holder">
                                <p>A best place to host <br>
                                   your fest and make use of the<br> 
                                    latest technology <br>
                                      for the ease <br>
                                    of your work.<br>
                                    </p>
                            </div>
                        </div>
                        <div>
                            <div class="details-holder">
                                <p>Display your fest <br>
                                    between the legends<br> 
                                   who you know and <br>
                                    Show your new way of Questing.<br>
                                   </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
<!--About alphatech ends  -->

<!--makes us special begins  -->

<!--special ends  -->

	
<!-- our servers begins -->

<!-- <div id="header-holder" class="inner-header serverspage-header">
 <div id="page-head" class="container-fluid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="servers-icon">
                        <img src="lp-plugins/images/servers.png" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="head-content">
                        <h4>Our Servers</h4>
                        <p>ALPHASYSTEMS servers are secure, reliable
                            and amazing at performance.</p>

                        <p>Enjoy maximum customization,
                        and overall flexibility.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->




<div id="ifeatures" class="container-fluid sfeatures">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-title">Additional Features</div>
                <div class="row-subtitle"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="feature-box">
                    <div class="feature-icon">
                        <img src="lp-plugins/images/sfeature1.png" alt="">
                    </div>
                    <div class="feature-title">Secure Data</div>
<!--
                    <div class="feature-details">Lorem ipsum dolor sit amir anim
amoe yosner dolner </div>
-->
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="feature-box">
                    <div class="feature-icon">
                        <img src="lp-plugins/images/sfeature2.png" alt="">
                    </div>
                    <div class="feature-title">Fest Settings</div>
<!--
                    <div class="feature-details">Lorem ipsum dolor sit amir anim
amoe yosner dolner </div>
-->
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="feature-box">
                    <div class="feature-icon">
                        <img src="lp-plugins/images/sfeature3.png" alt="">
                    </div>
                    <div class="feature-title">Reachout Colleges</div>
<!--
                    <div class="feature-details">Lorem ipsum dolor sit amir anim
amoe yosner dolner </div>
-->
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="feature-box">
                    <div class="feature-icon">
                        <img src="lp-plugins/images/sfeature4.png" alt="">
                    </div>
                    <div class="feature-title">100% Satisfying</div>
<!--
                    <div class="feature-details">Lorem ipsum dolor sit amir anim
amoe yosner dolner </div>
-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--our servers ends   -->


<!-- our services begins(requiered)
<div id="services" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-title">Our Services</div>
                <div class="row-subtitle">Designed to satisfy your creative needs.</div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="service-box">
                    <div class="service-icon">
                        <img src="lp-plugins/images/service-icon1.svg" alt="">
                    </div>
                    <div class="service-title"><a href="webhosting.html">Web Hosting</a></div>
                    <div class="service-details">
                        <p>At vero eos et accusamus et iusto odio dignissimos
ducimus qui blanditiis praesentium voluptatum div
atque corrupti quos dolores et quas molestias.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="service-box">
                    <div class="service-icon">
                        <img src="lp-plugins/images/service-icon2.svg" alt="">
                    </div>
                    <div class="service-title"><a href="#">Resellers</a></div>
                    <div class="service-details">
                        <p>At vero eos et accusamus et iusto odio dignissimos
ducimus qui blanditiis praesentium voluptatum div
atque corrupti quos dolores et quas molestias.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="service-box">
                    <div class="service-icon">
                        <img src="lp-plugins/images/service-icon3.svg" alt="">
                    </div>
                    <div class="service-title"><a href="vpshosting.html">VPS Hosting</a></div>
                    <div class="service-details">
                        <p>At vero eos et accusamus et iusto odio dignissimos
ducimus qui blanditiis praesentium voluptatum div
atque corrupti quos dolores et quas molestias.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="service-box">
                    <div class="service-icon">
                        <img src="lp-plugins/images/service-icon4.svg" alt="">
                    </div>
                    <div class="service-title"><a href="cloudhosting.html">Cloud Hosting</a></div>
                    <div class="service-details">
                        <p>At vero eos et accusamus et iusto odio dignissimos
ducimus qui blanditiis praesentium voluptatum div
atque corrupti quos dolores et quas molestias.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- our services ends -->

<!--footer begins-->
<div id="footer" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-4 col-md-3">
                <div class="address-holder">
                    <div class="phone"><i class="fas fa-phone"></i> 00 285 900 38502</div>
                    <div class="email"><i class="fas fa-envelope"></i>alphasystems@1312gmail.com</div>
                    <div class="address">
                        <i class="fas fa-map-marker"></i> 
                        <div>SDM COLLEGE OF BUSINESS MANAGEMENT
                              ballalbagh ,Mangalore
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-2">
                <div class="footer-menu-holder">
                    <h4>Company</h4>
                    <ul class="footer-menu">
                        <li><a href="about.html">About us</a></li>
                        <li><a href="blog.html">News</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="contact.html">Contact us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-6 col-sm-2 col-md-3">
                <div class="footer-menu-holder">
                    <h4>Services</h4>
                    <ul class="footer-menu">
                        <li><a href="webhosting.html">Web Hosting</a></li>
                        <li><a href="cloudhosting.html">Cloud Hosting</a></li>
                        <li><a href="vpshosting.html">VPS Servers</a></li>
                        <li><a href="domains.html">Domain Names</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-6 col-sm-3 col-md-3">
                <div class="footer-menu-holder">
                    <h4>Others</h4>
                    <ul class="footer-menu">
                        <li><a href="#">Transfer domains</a></li>
                        <li><a href="portal.html">Customer Portal</a></li>
                        <li><a href="#">Support Portal</a></li>
                        <li><a href="#">Video Tutorials</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-1 col-md-1">
                <div class="social-menu-holder">
                    <ul class="social-menu">
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--footer ends-->
<script src="lp-plugins/js/jquery.min.js"></script>
<script src="lp-plugins/js/bootstrap.min.js"></script>
<script src="lp-plugins/js/bootstrap-slider.min.js"></script>
<script src="lp-plugins/js/slick.min.js"></script>
<script src="lp-plugins/js/main.js"></script>
</body>
</html>
