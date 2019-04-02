<?php
include '../login/accesscontroladmin.php';
require('connect.php');
$ausername=$_SESSION['admin'];

$getidquery = "SELECT fests.fid,fests.fdate FROM admin JOIN fests ON admin.aid=fests.aid WHERE ausername='$ausername'";
$getidresult = mysqli_query( $connection, $getidquery );
$getidrow = mysqli_fetch_assoc( $getidresult );
$fid = $getidrow[ 'fid' ];
$fdate = $getidrow[ 'fdate' ];

$getsettingsquery="SELECT * FROM admin_settings WHERE fid='$fid'";
$getsettings=mysqli_query( $connection, $getsettingsquery );
$getsetrow = mysqli_fetch_assoc( $getsettings );

if(isset($_POST['updatesettings']))
{
	$visible=$_POST['visiblity'];
	$reg=$_POST['regset'];
    if(isset($_POST['enddate']))
	    $endate=$_POST['enddate'];
    else
        $endate='0';
	$schedule=$_POST['schedule'];
	
	$query="UPDATE `admin_settings` SET viewfest='$visible' ,startreg='$reg',stopdate='$endate',schedule='$schedule' WHERE fid='$fid'";
	$result=mysqli_query($connection,$query);
	if($result)
	{
      $getsettingsquery="SELECT * FROM admin_settings WHERE fid='$fid'";
      $getsettings=mysqli_query( $connection, $getsettingsquery );
      $getsetrow = mysqli_fetch_assoc( $getsettings );
	  $smsg="Settings updated successfully";
	}
	else
	{
    	$fmsg="error".mysqli_error($connection);				
	}
}


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
    <!-- Date picker plugins css -->
	<link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>
<!-- username check js start--->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#usernameLoading').hide();
		$('#username').keyup(function(){
		  $('#usernameLoading').show();
	      $.post("check-eventusername.php", {
	        username: $('#username').val()
	      }, function(response){
	        $('#usernameResult').fadeOut();
	        setTimeout("finishAjax('usernameResult', '"+escape(response)+"')", 500);
	      });
	    	return false;
		});
	});

	function finishAjax(id, response) {
	  $('#usernameLoading').hide();
	  $('#'+id).html(unescape(response));
	  $('#'+id).fadeIn();
	} //finishAjax
</script>
<!-- username check js end -->
    <script>
		function isFutureDate( idate ) {
			var today = document.getElementById( "datepicker-autoclose1" ).value,
				idate = idate.split( "-" );
                today = today.split( "-" );

			idate = new Date( idate[ 2 ], idate[ 1 ] - 1, idate[ 0 ] );
            today = new Date( today[ 2 ], today[ 1 ] - 1, today[ 0 ] );
			return ( today - idate ) <= 0 ? true : false;
		}
	</script>

	<script>
		function checkDate() {
			var idate = document.getElementById( "datepicker" ),
				resultDiv = document.getElementById( "datewarn" );
			//dateReg = /(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[012])[-]201[4-9]|20[2-9][0-9]/;

			// if(dateReg.test(idate.value)){
			if ( isFutureDate( idate.value ) ) {
				resultDiv.innerHTML = "Registration should end before fest date";
				resultDiv.style.color = "red";
			} else {
				resultDiv.innerHTML = "It's a valid date";
				resultDiv.style.color = "green";
			}
			// } else {
			// resultDiv.innerHTML = "Invalid date!";
			// resultDiv.style.color = "red";
			// }
		}
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
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Fest settings</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="../index.php" target="_blank" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Home</a>
                        <?php echo breadcrumbs(); ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

				<!--- imported add-doctors---->
				<!--Script to copy the input from fname to username-->

				<div class="row">
				<div class="col-sm-12">
                        <div class="white-box">
<!--                            <h3 class="box-title m-b-0">Fest settings</h3>-->
							<?php if(isset($fmsg)) { ?>
									<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										 <?php echo $fmsg; ?>
									</div>
					            <?php }?>
							<?php if(isset($smsg)) { ?>
									<div class="alert alert-success alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										 <?php echo $smsg; ?>
									</div>
							<?php }?>
							<div class="row p-b-10">
					<div class="col-md-12 col-sm-10 hvr-wobble-horizontal">
						<div class="card card-inverse">
							<img id="theImgId" class="card-img" src="../plugins/images/heading-title-bg.jpg" height="70" alt="Card image">
							<div class="card-img-overlay" style="padding-top: 5px">
								<h4 class="card-title text-uppercase">Fest is <?php if($getsetrow['viewfest']==0) echo'NOT'; ?> Public and <?php if($getsetrow['startreg']=='0' || $getsetrow['startreg']=='2') echo'NOT';  ?> open for Registration</h4>
								<!-- <p class="card-text">You are logged-in to ADMIN control panel, here are some of the basic information about fest details and some basic functions to perform. </p> -->
<!--								<p class="card-text"><small class="text-white">~OFMS</small></p>-->
							</div>
						</div>
					</div>
				</div>
                            
                        <h3 style="padding-top: 10px;" class="box-title m-b-0">Change Settings</h3>
                            <hr>
                            <form data-toggle="validator" method="post">
                                <div class="row">
											<div class="form-group col-sm-6">
												<label class="control-label">Visibility</label>
												<!--<div class="col-sm-12 p-l-0">-->
												<select class="form-control" name="visiblity" required>
													<!-- <option selected hidden> <?php //if($getsetrow['viewfest']==0) echo'Fest is Private'; else echo 'Fest is Public'; ?> </option> -->
													<option <?php if($getsetrow['viewfest']=='1') echo 'selected'; ?> value="1">Make fest PUBLIC</option>
													<option <?php if($getsetrow['viewfest']=='0') echo 'selected';  ?> value="0">Make fest PRIVATE</option>
												</select>
												<!--</div> -->
											</div>

											<div class="form-group col-sm-6">
												<label class="control-label">Registration</label>
												<!--<div class="col-sm-12 p-l-0">-->
												<select id="selectdate" onChange="exect(this.value)" class="form-control" name="regset" required>
                                                    <!-- <option selected hidden><?php //if($getsetrow['startreg']==0) echo'Registration is stopped'; else echo 'Registration is started'; ?> </option> -->
													<option <?php if($getsetrow['startreg']=='1') echo 'selected'; ?> value="1">Start Registration</option>
													<option <?php if($getsetrow['startreg']=='0') echo 'selected'; ?> value="0">Stop Registration ( Not open for registration )</option>
													<option <?php if($getsetrow['startreg']=='2') echo 'selected'; ?> value="2">Registration Time out</option>
												</select>
												<!--</div> -->
											</div>

										</div>
                                <div class="row">
                                <div class="col-md-6" id="dydate2">
												<div class="form-group">
													<label class="control-label">Registration end date</label>
													<div class="input-group">
                                                        <input hidden="true" data-date-format="dd-mm-yyyy" type="text" id="datepicker-autoclose1" class="form-control" data-mask="99-99-9999"  placeholder="dd-mm-yyyy" value="<?php $dateb=$getidrow['fdate'];
													$myDateTime = DateTime::createFromFormat('Y-m-d', $dateb);
													$dobc = $myDateTime->format('d-m-Y');  echo $dobc; ?>">
														
														<input <?php if($getsetrow['startreg']=='0' || $getsetrow['startreg']=='2') echo 'disabled'; ?> onChange="checkDate()" onKeyUp="checkDate()" data-date-format="dd-mm-yyyy" type="text" class="form-control" data-mask="99-99-9999" id="datepicker" name="enddate" value="<?php if(!$getsetrow['stopdate']=='0' || $getsetrow['startreg']=='2'){ echo $getsetrow['stopdate']; } ?>" placeholder="dd-mm-yyyy">
													</div>
													<div id="datewarn"></div>
													<!--<span class="font-13 text-muted">dd-mm-yyyy</span>-->
												</div>
											</div>
                                <div class="form-group col-sm-6">
												<label class="control-label">Schedule</label>
												<!--<div class="col-sm-12 p-l-0">-->
												<select class="form-control" name="schedule" required>
													<!-- <option selected hidden><?php //if($getsetrow['schedule']==0) echo'Schedule is not displayed'; else echo 'Schedule is displayed'; ?> </option> -->
													<option <?php if($getsetrow['schedule']=='1') echo 'selected'; ?> value="1">Display Schedule</option>
													<option <?php if($getsetrow['schedule']=='0') echo 'selected'; ?> value="0">Hide Schedule</option>
												</select>
												<!--</div> -->
											</div>
                                </div>
								<div class="form-group">
										<div class="col-sm-12">
											<center>
												<button class="btn btn-success" name="updatesettings">Update Settings</button> </center>
										</div>
									</div>
                                
                            </form>
                        </div>
                    </div>
				</div>
				<!---End of impoted--->
                <!-- .right-sidebar -->
                <!--DNS Removed Service Panel-->
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
    <script src="../plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
	<!-- Date Picker Plugin JavaScript -->
	<script src="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	<script src="../plugins/js/mask.js"></script>
	<script>
		jQuery( '.mydatepicker, #datepicker' ).datepicker();
		jQuery( '#datepicker-autoclose' ).datepicker( {
			autoclose: true,
			todayHighlight: true
		} );
	</script>
	<script>
		jQuery( '.mydatepicker, #datepicker' ).datepicker();
		jQuery( '#datepicker-autoclose1' ).datepicker( {
			autoclose: true,
			todayHighlight: true
		} );
	</script>
	<script>
		function unhide() {
			//document.getElementById("myFieldset").disabled = false;
			document.getElementById( "datepicker" ).disabled = false;
			//document.getElementById( "dydate2" ).removeAttribute( "hidden" );
			//document.getElementById( "dateshow" ).setAttribute( "hidden", true );
		}

		function datehide() {
			document.getElementById( "datepicker" ).disabled = true;
			//document.getElementById( "dateshow" ).removeAttribute( "hidden" );
			//document.getElementById( "dydate" ).setAttribute( "hidden", true );
		}

		function exect( value ) {
			//var selectedVal = $(this).val();
			switch ( value ) {
				case '1':
					unhide();
					break;
				case '0':
					datehide();
					break;
				case '2':
					datehide();
					break;
			}
		}
	</script>
</body>

</html>