<?php
include '../login/accesscontrolparticipant.php';
require('connect.php');
if(isset($_SESSION['pusername']))
{
	$ausername=$_SESSION['pusername'];
}
elseif(isset($_SESSION['admin']))
{
	$ausername=$_SESSION['admin'];
}
$getidquery="SELECT *, fests.fid FROM participants JOIN fests ON participants.fid=fests.fid WHERE pusername='$ausername'";
$getidresult = mysqli_query($connection, $getidquery);
$getidrow = mysqli_fetch_assoc($getidresult);
$fid=$getidrow['fid'];
$pid=$getidrow['pid'];

$geteventcount=mysqli_query($connection,"SELECT DISTINCT eid FROM eventparticipants JOIN participants ON eventparticipants.pid=participants.pid WHERE eventparticipants.pid='$pid' AND participants.fid='$fid'");
$pcount=mysqli_num_rows($geteventcount);

$getdoccount=mysqli_query($connection,"SELECT eid FROM events WHERE events.eid NOT IN (SELECT DISTINCT eid FROM eventparticipants JOIN participants ON eventparticipants.pid=participants.pid WHERE eventparticipants.pid='$pid' AND participants.fid='$fid')");
$dcount=mysqli_num_rows($getdoccount);

$getstaffcount=mysqli_query($connection,"SELECT * FROM events WHERE fid='$fid'");
$scount=mysqli_num_rows($getstaffcount);

$getwardcount=mysqli_query($connection,"SELECT * FROM participants WHERE teamcode IS NOT NULL && fid='$fid'");
$wcount=mysqli_num_rows($getwardcount);

$getsettingsquery="SELECT * FROM admin_settings WHERE fid='$fid'";
$getsettings=mysqli_query( $connection, $getsettingsquery );
$getsetrow = mysqli_fetch_assoc( $getsettings );

$getfestdetails = mysqli_query( $connection,"SELECT * FROM fests WHERE fid='$fid'");
$getfestrow = mysqli_fetch_assoc( $getfestdetails );

if($getsetrow['stopdate']!='0')
{
	$dateb=$getsetrow['stopdate'];
	$myDateTime = DateTime::createFromFormat('d-m-Y', $dateb);
	$dobc=$myDateTime->format('F j, Y');
}
else
{
	$dateb=$getfestrow['fdate'];
	$myDateTime = DateTime::createFromFormat('Y-m-d', $dateb);
	$dobc = $myDateTime->format('F j, Y'); 
}
$datec=$getfestrow['fdate'];
$myDateTimee = DateTime::createFromFormat('Y-m-d', $datec);
$datestart = $myDateTimee->format('d-m-Y'); 
//$datefest = $myDateTime->format('d-m-Y');
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
                        <h4 class="page-title">Participants Dashboard</h4>
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
								<h4 class="card-title text-uppercase">WELCOME <?php echo $ausername; ?></h4>
								<p class="card-text" style=" float: left;">You are logged-in to PARTICIPENTS control panel </p><p class="card-text text-blue"><i style="padding-left: 10px" class="fa fa-calendar-alt"></i><?php echo ' '.$datestart; if($getfestrow['fnodays']>=2){ echo ' to '.$getfestrow['ftodate']; } ?></p>
								<p style="font-size: 16px; float: left; padding-right: 10px" class="card-text text-warning"><?php if($getsetrow['stopdate']!='0') echo 'Days Left to Register :'; else echo 'Days left for Fest :'; ?> </p>
								<p id="demo" style="font-size: 16px" class="card-text text-warning"></p>
				<!--<p class="card-text"><small class="text-white">~OFMS</small></p>-->
							</div>
						</div>
					</div>
				</div>
	        
				
                <div class="row">
                    <div class="col-md-3 col-sm-6 hvr-float-shadow Hoveranimatevp" onClick="window.location='index.php'">
                        <div class="white-box">
							<h3 class="box-title"><b>Events Registered</b></h3>
							<ul class="list-inline two-part">
                                 <li><i class="fa fa-clipboard-list " style="color: blueviolet"></i></li>
								<li class="text-right"><span class="counter"><?php echo $pcount ?></span></li>
							</ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 hvr-float-shadow" onClick="window.location=''">
                        <div class="white-box">
							<h3 class="box-title"><b>Events Left Over</b></h3>
							<ul class="list-inline two-part">
								<li><i class="fa fa-pen-square text-info"></i></li>
								<li class="text-right"><span class="counter"><?php echo $dcount ?></span></li>
							</ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 hvr-float-shadow" onClick="window.location=''">
                        <div class="white-box">
							<h3 class="box-title"><b>Total No Of Events </b></h3>
							<ul class="list-inline two-part">
								<li><i class="fa fa-users text-info"></i></li>
								<li class="text-right"><span class="counter"><?php echo $scount ?></span></li>
							</ul>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-sm-6 hvr-float-shadow" onClick="window.location=''">
                        <div class="white-box">
							<h3 class="box-title"><b>No Of Colleges Registered </b></h3>
							<ul class="list-inline two-part">
                              
                                <li><i class="fa fa-check-square" style="color: blueviolet"></i></li>
								<li class="text-right"><span class="counter"><?php echo $wcount ?></span></li>
							</ul>
                        </div>
                    </div>
                    </div>
                    <div class="row p-t-10">
                      <div class="col-md-3 col-sm-6 Hoveranimated hvr-float" data-toggle="tooltip" data-original-title="view event results" onClick="window.location='view-results.php'">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="fa fa-clipboard-list bg-black Hoveranimatedoc"></i>
                                <div class="bodystate p-t-10">
									<h4><b>Event Result</b></h4>
                                    <span class="text-muted" style="font-size: 80%"></span>
                                </div>
                            </div>
                        </div>
                    </div> 
                     
                      <div class="col-md-3 col-sm-6 Hoveranimatep hvr-float" data-toggle="tooltip" data-original-title="view events schedule" onClick="window.location='view-schedule.php'">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="fa fa-calendar-alt bg-black Hoveranimatepat"></i>
                                <div class="bodystate p-t-10">
									<h4><b>Schedule</b></h4>
                                    <span class="text-muted" style="font-size: 80%"></span>
                                </div>
                            </div>
                        </div>
                    </div> 
                       <div class="col-md-3 col-sm-6 Hoveranimates hvr-float" data-toggle="tooltip" data-original-title="view fest events" onClick="window.location='view-events.php'">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="fa fa-users bg-black Hoveranimatestaff"></i>
                                <div class="bodystate p-t-10">
									<h4><b>View Event</b></h4>
                                    <span class="text-muted" style="font-size: 80%"></span>
                                </div>
                            </div>
                        </div>
                    </div> 
                       <div class="col-md-3 col-sm-6 Hoveranimatew hvr-float" data-toggle="tooltip" data-original-title="Add a feedback" onClick="window.location='feedback.php'">
                        <div class="white-box">
                            <div class="r-icon-stats">
                                <i class="fa fa-comment-alt  bg-black Hoveranimatewrd"></i>
                                <div class="bodystate p-t-10">
									<h4><b>Feedback</b></h4>
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
				$(".Hoveranimatedoc").removeClass("fa-clipboard-list").addClass("fa-eye");
			},
			function(){
				$(".Hoveranimatedoc").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatedoc").removeClass("fa-eye").addClass("fa-clipboard-list");
			}
									
			)
			
			$('.Hoveranimatep').hover(function(){
				$(".Hoveranimatepat").removeClass("bg-black").addClass("bg-success");
				$(".Hoveranimatepat").removeClass("fa-calendar-alt").addClass("fa-eye");
			},
			function(){
				$(".Hoveranimatepat").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatepat").removeClass("fa-eye").addClass("fa-calendar-alt");
			}
									
			)
				 
			$('.Hoveranimates').hover(function(){
				$(".Hoveranimatestaff").removeClass("bg-black").addClass("bg-success");
				$(".Hoveranimatestaff").removeClass("fa-users").addClass("fa-eye");
			},
			function(){
				$(".Hoveranimatestaff").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatestaff").removeClass("fa-eye").addClass("fa-users");
			}
									
			)
					
			$('.Hoveranimatew').hover(function(){
				$(".Hoveranimatewrd").removeClass("bg-black").addClass("bg-success");
				$(".Hoveranimatewrd").removeClass("fa-comment-alt").addClass("fa-eye");
			},
			function(){
				$(".Hoveranimatewrd").removeClass("bg-success").addClass("bg-black");
				$(".Hoveranimatewrd").removeClass("fa-eye").addClass("fa-comment-alt");
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
