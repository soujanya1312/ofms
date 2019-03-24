<?php
require('admin/connect.php');
$id=$_GET['id'];
date_default_timezone_set('Asia/Kolkata');
$getpidquery="SELECT * from fests WHERE fid='$id'";
$getpidres=mysqli_query($connection, $getpidquery);
$row = mysqli_fetch_assoc($getpidres);

$date=date("Y-m-d");
if($row['fdate']<$date)
{
	echo'<script> window.location="admin/403.php";</script>';
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
<link rel="stylesheet" type="text/css" href="lp-plugins/css/style-darkblue.css">
<link rel="stylesheet" type="text/css" href="lp-plugins/css/custom.css">
</head>

<body>

<div id="header-holder" class="inner-header hosting-page">
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
                                <li><a href="index.php#services">Services</a></li>
                                <li><a href="index.php#fests">Fests</a></li>
                                <li><a href="index.php#about">About Us</a></li>
                                 <li><a href="feedback.php">Feedback</a></li>
                                <li class="support-button-holder support-dropdown">
                                    <a class="support-button" href="login/index.php">Login</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div id="page-head" class="container-fluid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="page-title"><h2><?php echo $row['fname'] ?></h2></div>
                    <div id="page-icon">
                        <div class="pricing-icon">
                            <img src="lp-plugins/images/service-icon1.svg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="h-info" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="info-text grey-text"><?php echo $row['fdesc'] ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="more-features" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-title"></div>
                <div class="row-subtitle"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <i class="fa fa-trophy"a></i>
                    </div>
					<div class="mfeature-title">Catagory<p class="mfeature-title" style="padding-top: 10px"><?php echo $row['ftype'] ?></p></div>
                    <div class="mfeature-details"></div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <i class="fa fa-calendar-check"></i>
                    </div>
                    <div class="mfeature-title">Date <p class="mfeature-title" style="padding-top: 10px"><?php $dateb=$row['fdate'];
					$myDateTime = DateTime::createFromFormat('Y-m-d', $dateb);
					$dobc = $myDateTime->format('d-m-Y');  echo $dobc; if($row['fnodays']>=2){ echo ' to '.$row['ftodate']; } ?></p></div>
                    <div class="mfeature-details"></div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="mfeature-box">
                    <div class="mfeature-icon">
                        <i class="fa fa-map"></i>
                    </div>
                    <div class="mfeature-title">College <p class="mfeature-title" style="padding-top: 10px"><?php echo $row['cname'] ?></p></div>
                    <div class="mfeature-details"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="pricing" class="container-fluid" style="padding-top: 1px;">
    <div class="container">
        <h2>Exciting Events</h2>
        <div class="row">
            <?php $query = "SELECT * FROM events WHERE fid='$id'";
				$result = mysqli_query($connection, $query);
				foreach($result as $key=>$result)
				{  ?>
            <div class="col-sm-6 col-md-4">
                <div class="pricing-box pricing-box-simple pricing-color1">
                    <div class="pricing-content" style="background-color: #E8E8E8">
                        <div class="pricing-head">
                            <div class="pricing-title"><?php echo $result['ename'] ?></div>
                            <div class="pricing-features">
<!--
                                <ul>
                                    <li>Great for Starting Website</li>
                                    <li>Small Websites</li>
                                    <li>Startups</li>
                                </ul>
-->
                            </div>
                            <div class="pricing-options">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#monthly<?php echo $key ?>">Description</a></li>
                                    <li><a data-toggle="tab" href="#annualy<?php echo $key ?>">Contact</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="monthly<?php echo $key ?>" class="tab-pane fade in active">
                                        <div class="pricing-price"><?php echo $result['edesc'] ?></div>
<!--                                        <div class="billing-cycle">per month</div>-->
                                    </div>
                                    <div id="annualy<?php echo $key ?>" class="tab-pane fade">
                                        <div class="pricing-price"><?php echo $result['hname'].$result['addname']; ?></div>
                                        <div class="billing-cycle"><?php echo $result['hmob'] ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pricing-details">
                            <ul>
                                <li>Rounds: <?php echo $result['erounds'] ?></li>
                                <li>Participants: <?php echo $result['participants'] ?></li>
                            </ul>
                        </div>
<!--
                        <div class="pricing-link">
                            <a class="ybtn" href="#">Create New Account</a>
                        </div>
-->
                    </div>
                </div>
            </div>
            <?php } ?>
            <!-- <div class="col-sm-6 col-md-4">
                <div class="pricing-box pricing-box-simple pricing-color2 bestbuy">
                    <div class="pricing-content">
                        <div class="pricing-head">
                            <div class="pricing-title">Business Plan</div>
                            <div class="pricing-features">
                                <ul>
                                    <li>Great for Starting Website</li>
                                    <li>Small Websites</li>
                                    <li>Startups</li>
                                </ul>
                            </div>
                            <div class="pricing-options">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#monthly2">Monthly</a></li>
                                    <li><a data-toggle="tab" href="#annualy2">Annualy</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="monthly2" class="tab-pane fade in active">
                                        <div class="pricing-price">$10.8</div>
                                        <div class="billing-cycle">per month</div>
                                    </div>
                                    <div id="annualy2" class="tab-pane fade">
                                        <div class="pricing-price">$110.8</div>
                                        <div class="billing-cycle">per year</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pricing-details">
                            <ul>
                                <li>Unlimited Storage</li>
                                <li>500 Protected Files</li>
                                <li>All Sharing Features</li>
                                <li>Realtime Revoke</li>
                                <li>Access to Party Integrations</li>
                                <li>Free Native Apps</li>
                                <li>QNote Editor</li>
                                <li>Offline File Access</li>
                                <li>Single Sign on</li>
                                <li>Unlimited Email accounts</li>
                                <li class="not-included">Support 24/7</li>
                                <li class="not-included">Linux server</li>
                            </ul>
                        </div>
                        <div class="pricing-link">
                            <a class="ybtn" href="#">Create New Account</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-4">
                <div class="pricing-box pricing-box-simple pricing-color3">
                    <div class="pricing-content">
                        <div class="pricing-head">
                            <div class="pricing-title">Premium Plan</div>
                            <div class="pricing-features">
                                <ul>
                                    <li>Great for Starting Website</li>
                                    <li>Small Websites</li>
                                    <li>Startups</li>
                                </ul>
                            </div>
                            <div class="pricing-options">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#monthly3">Monthly</a></li>
                                    <li><a data-toggle="tab" href="#annualy3">Annualy</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="monthly3" class="tab-pane fade in active">
                                        <div class="pricing-price">$18.8</div>
                                        <div class="billing-cycle">per month</div>
                                    </div>
                                    <div id="annualy3" class="tab-pane fade">
                                        <div class="pricing-price">$200.8</div>
                                        <div class="billing-cycle">per year</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pricing-details">
                            <ul>
                                <li>Unlimited Storage</li>
                                <li>500 Protected Files</li>
                                <li>All Sharing Features</li>
                                <li>Realtime Revoke</li>
                                <li>Access to Party Integrations</li>
                                <li>Free Native Apps</li>
                                <li>QNote Editor</li>
                                <li>Offline File Access</li>
                                <li>Single Sign on</li>
                                <li>Unlimited Email accounts</li>
                                <li>Support 24/7</li>
                                <li>Linux server</li>
                            </ul>
                        </div>
                        <div class="pricing-link">
                            <a class="ybtn" href="#">Create New Account</a>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
 <?php if(isset($row['rules'])) { ?>
<div id="apps" class="container-fluid" style="margin-bottom: 0px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-icon"><img src="lp-plugins/images/click-icon.png"></div>
                <div class="row-title">Rules </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="apps-holder" style="color: azure; font-family: Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', 'serif'; font-size: 20px; text-align: left; margin-left: 20px">
                    <?php echo $row['rules'] ?>                 
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<div id="message1" class="container-fluid message-area normal-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="text-other-color1">Are you ready?</div>
                <div class="text-other-color2">create an account to participate for <?php echo $row['fname'] ?>.</div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="buttons-holder">
                    <a href="login/add-participants.php?id=<?php echo $row['fid'] ?>" class="ybtn ybtn-accent-color">Register Now!</a>
                    <?php if(isset($row['regfees']) && $row['regfees']!=0.00 ) { ?>
                    <a href="javascript:void(0)" class="ybtn ybtn-white ybtn-shadow">Reg Fees: <i class="fa fa-rupee-sign"></i><?php echo $row['regfees'] ?></a> <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="footer" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-4 col-md-3">
                <div class="address-holder">
                    <div class="phone"><i class="fas fa-phone"></i> 00 285 900 38502</div>
                    <div class="email"><i class="fas fa-envelope"></i> hello@hostify.com</div>
                    <div class="address">
                        <i class="fas fa-map-marker"></i> 
                        <div>City Avenue, Office 64,<br>
                            Floor 6,  Milbourne,<br>
                            Australia.</div>
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
<script src="lp-plugins/js/jquery.min.js"></script>
<script src="lp-plugins/js/bootstrap.min.js"></script>
<script src="lp-plugins/js/bootstrap-slider.min.js"></script>
<script src="lp-plugins/js/slick.min.js"></script>
<script src="lp-plugins/js/main.js"></script>
</body>
</html>
