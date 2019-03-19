<?php
include '../login/accesscontrolhead.php';
require('connect.php');
if(isset($_SESSION['husername']))
{
	$ausername=$_SESSION['husername'];
}
elseif(isset($_SESSION['admin']))
{
	$ausername=$_SESSION['admin'];
}
$getfestidq="SELECT fid,erounds FROM events WHERE husername='$ausername'";
$getfestidr=mysqli_query($connection, $getfestidq);
$getfestid = mysqli_fetch_assoc($getfestidr);
$fid=$getfestid['fid'];
$erounds=$getfestid['erounds'];

$query = "SELECT eid FROM events WHERE husername='$ausername'";
$result = mysqli_query($connection, $query);
$row1 = mysqli_fetch_assoc($result);
$eid= $row1["eid"];
				
$getpidquery="SELECT pid from participants WHERE fid='$fid'";
$getpidres=mysqli_query($connection, $getpidquery);
$row2 = mysqli_fetch_assoc($getpidres);
$pid= $row2["pid"];

//$redirectquery="SELECT * FROM eventparticipants WHERE eid='$eid' and pid='$pid'";	$exeredirect=mysqli_query($connection, $redirectquery);
//$redirect=mysqli_num_rows($exeredirect);

$getcollegecount=mysqli_query($connection,"SELECT * FROM results WHERE eid='$eid' AND pid='$pid'");
$pcount=mysqli_num_rows($getcollegecount);

$getdoccount=mysqli_query($connection,"SELECT * FROM event_time WHERE eventid='$eid'");
$dcount=mysqli_num_rows($getdoccount);

//$getstaffcount=mysqli_query($connection,"SELECT * FROM feedback WHERE fid='$fid'");
//$scount=mysqli_num_rows($getstaffcount);

$getwardcount=mysqli_query($connection,"SELECT * FROM events WHERE fid='$fid' ");
$wcount=mysqli_num_rows($getwardcount);
?>

<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Online Fest Management System">
    <meta name="author" content="Soujanya M">
    <!--csslink.php includes fevicon and title-->
    <?php include 'assets/csslink.php'; ?>
	<link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">
	<link href="../plugins/css/hover.css" rel="stylesheet" media="all">
</head>

<body class="fix-sidebar">
   <!--header.php includes preloader, top navigarion, logo, user dropdown-->
    <!--div id wrapper in header.php-->
    <!--left-sidebar.php includes mobile search bar, user profile, menu-->
    <?php include 'assets/header.php';
	include 'assets/left-sidebar.php';
	include 'assets/breadcrumbs.php';
	?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid p-b-0">
                <div class="row bg-title">
					<!--add this line to include bg image to title: style="background:url(../plugins/images/heading-title-bg.jpg) no-repeat center center /cover;" -->
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12" >
                        <h4 class="page-title">EventHead Dashboard</h4>
                    </div>
                    <!-- /.page title -->
                    <!-- .breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="../index.php" target="_blank" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Home</a>
                        <?php echo breadcrumbs(); ?>
                    </div>
                    <!-- /.breadcrumb -->
                </div>
                <!--DNS added Dashboard content-->
                <!--row -->
				
				<div class="row p-b-10">
					<div class="col-md-12 col-sm-10 hvr-wobble-horizontal">
						<div class="card card-inverse">
							<img id="theImgId" class="card-img" src="../plugins/images/cards/bg.png" height="120" alt="Card image">
							<div class="card-img-overlay" style="padding-top: 5px">
								<h4 class="card-title text-uppercase">Event Name: <?php echo $ausername; ?></h4>
                                
								<p class="card-text" id="cText">You are logged-in to Event Head control panel, here are some of the basic information about fest and some basic functions to perform. </p>
							<!--<p id="wText" class="card-text text-warning"><i class="fa fa-info-circle"></i><b> THERE ARE <?php echo mysqli_num_rows($resultcountmsg); ?> UNREAD MESSAGES AND  <?php echo $acount; ?> UNSCHEDULED APPOINTMENTS. </b></p>-->
								<!--<p class="card-text"><small class="text-white">~AlphaCare</small></p>-->
							</div>
						</div>
					</div>
				</div>
	
				
                <div class="row">
                  
                    <div class="col-md-3 col-sm-6 hvr-float-shadow" onClick="window.location='view-results.php'">
                        <div class="white-box">
							<h3 class="box-title"><b>No of Rounds</b></h3>
							<ul class="list-inline two-part">
								<li><i class="fa fa-id-badge text-info"></i></li>
								<li class="text-right"><span class="counter"><?php echo $erounds ?></span></li>
							</ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 hvr-float-shadow" onClick="window.location='view-eventtime.php'">
                        <div class="white-box">
							<h3 class="box-title"><b>Rounds Schedule</b></h3>
							<ul class="list-inline two-part">
								<li><i class="fa fa-id-badge text-info"></i></li>
								<li class="text-right"><span class="counter"><?php echo $dcount ?></span></li>
							</ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 hvr-float-shadow" onClick="window.location='view-feedback.php'">
                        <div class="white-box">
							<h3 class="box-title"><b>No of Feedback</b></h3>
							<ul class="list-inline two-part">
								<li><i class="fa fa-id-badge text-info"></i></li>
								<li class="text-right"><span class="counter"><?php echo $scount ?></span></li>
							</ul>
                        </div>
                    </div>
                     
                 <div class="col-md-3 col-sm-6 hvr-float-shadow" onClick="window.location=''">
                        <div class="white-box">
							<h3 class="box-title"><b>No of Participants</b></h3>
							<ul class="list-inline two-part">
								<li><i class="fa fa-id-badge text-info"></i></li>
								<li class="text-right"><span class="counter"><?php echo $wcount ?></span></li>
							</ul>
                        </div>
                    </div>
                    
                     <div class="col-md-3 col-sm-6 Hoveranimates hvr-float" data-toggle="tooltip" data-original-title="Add Results" onClick="window.location='result.php'">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="ti-id-badge bg-black Hoveranimatestaff"></i>
                                <div class="bodystate p-t-10">
									<h4><b>Add Event Results</b></h4>
                                    <span class="text-muted" style="font-size: 80%"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6 Hoveranimates hvr-float" data-toggle="tooltip" data-original-title="Add Event Time" onClick="window.location='add-eventtime.php'">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="ti-id-badge bg-black Hoveranimatestaff"></i>
                                <div class="bodystate p-t-10">
									<h4><b>Add Schedule</b></h4>
                                    <span class="text-muted" style="font-size: 80%"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                     
                </div>
                <!--/row -->
                
                <!--DNS End-->
     
                <!-- .right-sidebar -->
                 <!-- Removed Service Panel DNS-->
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
            <!--footer.php contains footer-->
            <?php include'assets/footer.php'; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!--jslink has all the JQuery links-->
    <?php include'assets/jslink.php'; ?>
    <!--Counter js -->
    <script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../plugins/js/dashboard3.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){  
			$('.Hoveranimated').hover(function(){
				$(".Hoveranimatedoc").removeClass("bg-black").addClass("bg-success");
				$(".Hoveranimatedoc").removeClass("fa-calendar-alt").addClass("fa-eye");
			},
			function(){
				$(".Hoveranimatedoc").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatedoc").removeClass("fa-eye").addClass("fa-calendar-alt");
			}
									
			)
			
			$('.Hoveranimatep').hover(function(){
				$(".Hoveranimatepat").removeClass("bg-black").addClass("bg-success");
				$(".Hoveranimatepat").removeClass("fa-wheelchair").addClass("fa-plus");
			},
			function(){
				$(".Hoveranimatepat").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatepat").removeClass("fa-plus").addClass("fa-wheelchair");
			}
									
			)
				 
			$('.Hoveranimates').hover(function(){
				$(".Hoveranimatestaff").removeClass("bg-black").addClass("bg-success");
				$(".Hoveranimatestaff").removeClass("far fa-envelope").addClass("fa fa-eye");
			},
			function(){
				$(".Hoveranimatestaff").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatestaff").removeClass("fa fa-eye").addClass("far fa-envelope");
			}
									
			)
					
			$('.Hoveranimatew').hover(function(){
				$(".Hoveranimatewrd").removeClass("bg-black").addClass("bg-success");
				$(".Hoveranimatewrd").removeClass("far fa-file-alt").addClass("fa fa-eye");
			},
			function(){
				$(".Hoveranimatewrd").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatewrd").removeClass("fa fa-eye").addClass("far fa-file-alt");
			}
									
			)
			
//          $('.Hoveranimatevp').hover(function(){
//				$(".Hoveranimatevpt").removeClass("fa-wheelchair").addClass("fa-eye");
//			},
//			function(){
//				$(".Hoveranimatevpt").removeClass("fa-eye").addClass("fa-wheelchair");
//			}
//									
//			)
			
		})
	</script>
	
	<script>
		function openlink(url){
			
			var win=window.open(url, '_blank');
			win.focus();
			
		}
	</script>
    <script>
		$(window).load(function() {

			var viewportWidth = $(window).width();
			if (viewportWidth < 750) {
					var theImg = document.getElementById('theImgId');
		theImg.height = 180;
				document.getElementById('cText').style.fontSize = "80%";
				document.getElementById('wText').style.fontSize = "86%";
			}

			$(window).resize(function () {

				if (viewportWidth < 750) {
					var theImg = document.getElementById('theImgId');
		theImg.height = 180;
				document.getElementById('cText').style.fontSize = "80%";
				document.getElementById('wText').style.fontSize = "86%";
				}
			});
		});
	</script>  
</body>

</html>
