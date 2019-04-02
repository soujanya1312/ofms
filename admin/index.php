<?php
include '../login/accesscontroladmin.php';
$ausername=$_SESSION['admin'];
require('connect.php');

$getidquery="SELECT fests.fid FROM admin JOIN fests ON admin.aid=fests.aid WHERE ausername='$ausername'";
$getidresult = mysqli_query($connection, $getidquery);
$getidrow = mysqli_fetch_assoc($getidresult);
$fid=$getidrow['fid'];


$getcollegecount=mysqli_query($connection,"SELECT * FROM participants WHERE teamcode IS NOT NULL && fid='$fid'");
$pcount=mysqli_num_rows($getcollegecount);

$getdoccount=mysqli_query($connection,"SELECT * FROM events WHERE fid='$fid'");
$dcount=mysqli_num_rows($getdoccount);

$getstaffcount=mysqli_query($connection,"SELECT * FROM feedback WHERE fid='$fid'");
$scount=mysqli_num_rows($getstaffcount);

$getwardcount=mysqli_query($connection,"SELECT * FROM participants WHERE teamcode is NULL && fid='$fid' ");
$wcount=mysqli_num_rows($getwardcount);

$getsettingsquery="SELECT * FROM admin_settings WHERE fid='$fid'";
$getsettings=mysqli_query( $connection, $getsettingsquery );
$getsetrow = mysqli_fetch_assoc( $getsettings );

$getfestdetails = mysqli_query( $connection,"SELECT * FROM fests WHERE fid='$fid'");
$getfestrow = mysqli_fetch_assoc( $getfestdetails );
$dateb=$getfestrow['fdate'];
$myDateTime = DateTime::createFromFormat('Y-m-d', $dateb);
$dobc = $myDateTime->format('F j, Y'); 
$datefest = $myDateTime->format('d-m-Y');

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
	<link href="../plugins/css/hover.css" rel="stylesheet" media="all">
	<script>
	// Set the date we're counting down to
	var countDownDate = new Date("<?php echo $dobc ?>").getTime();

	// Update the count down every 1 second
	var x = setInterval(function() {

	  // Get todays date and time
	  var now = new Date().getTime();

	  // Find the distance between now and the count down date
	  var distance = countDownDate - now;

	  // Time calculations for days, hours, minutes and seconds
	  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	  // Output the result in an element with id="demo"
	  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
	  + minutes + "m " + seconds + "s ";

	  // If the count down is over, write some text 
	  if (distance < 0) {
		clearInterval(x);
		document.getElementById("demo").innerHTML = "Started";
	  }
	}, 1000);
</script>
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
                        <h4 class="page-title">Admin Dashboard</h4>
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
							<img id="theImgId" class="card-img" src="../plugins/images/cards/bg.png" height="140" alt="Card image">
							<div class="card-img-overlay" style="padding-top: 5px">
								<h4 class="card-title text-uppercase">WELCOME <?php echo $ausername; ?></h4>
								<p class="card-text" style=" float: left;">You are logged-in to ADMIN control panel </p><p class="card-text text-warning"><i style="padding-left: 10px" class="fa fa-calendar-alt"></i><?php echo ' '.$datefest; if($getfestrow['fnodays']>=2){ echo ' to '.$getfestrow['ftodate']; } ?></p>
								<p style="font-size: 16px; float: left; padding-right: 10px" class="card-text text-blue">Days Left </p>
								<p id="demo" style="font-size: 16px" class="card-text text-blue"></p>
				<!--<p class="card-text"><small class="text-white">~OFMS</small></p>-->
                                <?php if($getfestrow['rules']==NULL || $getfestrow['regfees']==NULL) { ?>
                                <p id="wText" class="card-text text-warning"><i class="fa fa-info-circle"></i><b><?php echo' Fest Rules and Fee is not Updated'; ?> </b></p> <?php } ?>
							</div>
						</div>
					</div>
				</div>
	
				
                <div class="row">
                    <div class="col-md-3 col-sm-6 hvr-float-shadow" onClick="window.location='view-colleges.php'">
                        <div class="white-box">
							<h3 class="box-title"><b>Colleges Registered</b></h3>
							<ul class="list-inline two-part">
								<li><i class="fa fa-pen-square" style="color: blueviolet"></i></li>
								<li class="text-right"><span class="counter"><?php echo $wcount; ?></span></li>
							</ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 hvr-float-shadow" onClick="window.location=''">
                        <div class="white-box">
							<h3 class="box-title"><b>No Of Events</b></h3>
							<ul class="list-inline two-part">
								<li><i class="fa fa-users text-info"></i></li>
								<li class="text-right"><span class="counter"><?php echo $dcount ?></span></li>
							</ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 hvr-float-shadow" onClick="window.location=''">
                        <div class="white-box">
							<h3 class="box-title"><b>No Of Feedback </b></h3>
							<ul class="list-inline two-part">
								<li><i class="fa fa-comment-dots" style="color: blueviolet"></i></li>
								<li class="text-right"><span class="counter"><?php echo $scount ?></span></li>
							</ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 hvr-float-shadow" onClick="window.location='view-participants.php'">
                        <div class="white-box">
							<h3 class="box-title"><b>Confirmed Colleges</b></h3>
							<ul class="list-inline two-part">
								<li><i class="fa fa-check-square text-info"></i></li>
								<li class="text-right"><span class="counter"><?php echo $pcount ?></span></li>
							</ul>
                        </div>
                    </div>
                    
                </div>
                <!--/row -->
				<!--row -->
                <div class="row p-t-10">
                     <div class="col-md-3 col-sm-6 Hoveranimated hvr-float" data-toggle="tooltip" data-original-title="Fest is <?php if($getsetrow['viewfest']==0) echo'NOT'; ?> public and <?php if($getsetrow['startreg']==0 || $getsetrow['startreg']=='2') echo'NOT';  ?> open for Registration" onClick="window.location='fest-settings.php'">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="fa fa-cog bg-black Hoveranimatedoc"></i>
                                <div class="bodystate p-l-10 p-t-10">
									<h4><b>Fest Settings</b></h4>
                                    <!--<span class="text-muted" style="font-size: 80%"></span>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 Hoveranimatep hvr-float" data-toggle="tooltip" data-original-title="Add New Event" onClick="window.location='add-events.php'">
                        <div class="white-box">
                            <div class="r-icon-stats">
                               <i class="fa fa-user bg-black Hoveranimatepat"></i>
                                <div class="bodystate p-t-10">
									<h4><b>Event Head</b></h4>
                                    <!--<span class="text-muted" style="font-size: 80%"></span>-->
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-md-3 col-sm-6 Hoveranimates hvr-float" data-toggle="tooltip" data-original-title="View Event Result" onClick="window.location='view-results.php'">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="fa fa-clipboard-list bg-black Hoveranimatestaff"></i>
                                <div class="bodystate p-t-10">
									<h4><b>Event Result</b></h4>
                                    <span class="text-muted" style="font-size: 80%"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                
                       <div class="col-md-3 col-sm-6 Hoveranimatew hvr-float" data-toggle="tooltip" data-original-title="Edit Fest Details" onClick="window.location='edit-fest-details.php'">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="fa fa-edit bg-black Hoveranimatewrd"></i>
                                <div class="bodystate p-t-10">
									<h4><b>Fest Details</b></h4>
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
            <?php include'assets/footer.php' ?>
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
				$(".Hoveranimatedoc").removeClass("fa-cog").addClass("fa-plus");
			},
			function(){
				$(".Hoveranimatedoc").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatedoc").removeClass("fa-plus").addClass("fa-cog");
			}
									
			)
			
			$('.Hoveranimatep').hover(function(){
				$(".Hoveranimatepat").removeClass("bg-black").addClass("bg-success");
				$(".Hoveranimatepat").removeClass("fa-user").addClass("fa-plus");
			},
			function(){
				$(".Hoveranimatepat").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatepat").removeClass("fa-plus").addClass("fa-user");
			}
									
			)
				 
			$('.Hoveranimates').hover(function(){
				$(".Hoveranimatestaff").removeClass("bg-black").addClass("bg-success");
				$(".Hoveranimatestaff").removeClass("fa-clipboard-list").addClass("fa-plus");
			},
			function(){
				$(".Hoveranimatestaff").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatestaff").removeClass("fa-plus").addClass("fa-clipboard-list");
			}
									
			)
					
			$('.Hoveranimatew').hover(function(){
				$(".Hoveranimatewrd").removeClass("bg-black").addClass("bg-success");
				$(".Hoveranimatewrd").removeClass("fa-edit").addClass("fa-plus");
			},
			function(){
				$(".Hoveranimatewrd").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatewrd").removeClass("fa-plus").addClass("fa-edit");
			}
									
			)
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
			}

			$(window).resize(function () {

				if (viewportWidth < 750) {
					var theImg = document.getElementById('theImgId');
		theImg.height = 180;
				}
			});
		});
	</script>
</body>

</html>
