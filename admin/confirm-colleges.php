<?php
include '../login/accesscontroladmin.php';
require('connect.php');
$ausername=$_SESSION['admin'];

$id = $_GET['id'];
$getapointquery="SELECT pclgname,pcaddress,pemail,pmob,teamcode FROM participants WHERE pid='$id'";
$getapointresult = mysqli_query($connection, $getapointquery);
$apointrow = mysqli_fetch_assoc($getapointresult);

if (isset($_POST['apupdate']))
	{
		$apointstatus=mysqli_real_escape_string($connection,$_POST['apstatus']);
		if($apointstatus=='confirmed')
		{
			$teamname=mysqli_real_escape_string($connection,$_POST['tname']);
			$updatequery="UPDATE participants SET teamcode='$teamname' WHERE pid='$id'";
			$updateresult=mysqli_query($connection,$updatequery);
			if($updateresult)
			{
				$smsg="REGISTRATION INFORMATION UPDATED";
				echo'<script>window.history.go(-2);</script>';
			}
			else
			{
				$fmsg=mysqli_error($connection);
			}
		}
		elseif($apointstatus=='Cancelled')
		{
			$updatequery="UPDATE participants SET teamcode='$apointstatus' WHERE pid='$id'";
			$updateresult=mysqli_query($connection,$updatequery);
			if($updateresult)
			{
				$smsg="YOUR REGISTRATION IS CANCELLED";
				echo'<script>window.history.go(-2);</script>';
			}
			else
			{
				$fmsg=mysqli_error($connection);
			}
			
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
    <link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
<!-- username check js start -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#usernameLoading').hide();
		$('#username').keyup(function(){
		  $('#usernameLoading').show();
	      $.post("check-teamcode.php", {
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
                        <h4 class="page-title">Participants Details</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="../index.html" target="_blank" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Home</a>
                        <?php echo breadcrumbs(); ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
				
				<!--- imported add-doctors---->
				<!--.row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">Process Team Participation</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
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
                                   
                                    <form method="post" data-toggle="validator">
                                        <div class="form-body">
                                            <h3 class="box-title">Participating College Information</h3>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">College Name</label>
                                                        <input readonly type="text" id="Name" name="mname" class="form-control" required value="<?php echo $apointrow["pclgname"]; ?>">
                                                     </div>
                                                </div>
												<div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label">College Address</label>
                                                        <input readonly type="text" id="Name" name="cadd" class="form-control" required value="<?php echo $apointrow["pcaddress"]; ?>">
                                                     </div>
                                                </div>
												
                                                <!--/span-->
                                                
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                    
                                            <!--/row-->
                                            
				 <div class="row">
                                                <div class="col-md-6">                
                                     <div class="form-group">
                                                        <label class="control-label">Mobile No</label>
                                                        <input readonly type="tel" id="description" name="pmob" class="form-control" placeholder="" value="<?php echo $apointrow["pmob"]; ?>">
                                                    </div>
                                                </div>
												<div class="col-md-6">
													<div class="form-group">
														  <label class="control-label">Email ID</label>
                                                        <input readonly type="email" id="description" name="pemail" class="form-control" placeholder="" value="<?php echo $apointrow["pemail"]; ?>">
													 </div>
												</div>
											</div>
											
										
											<div class="row">
												<div class="col-md-6">
												   <div class="form-group">
													<label class="control-label">Participation Status</label>
													<div class="radio-list">
														<label class="radio-inline p-0">
															<div class="radio radio-info">
																<input onClick="document.getElementById('teamcode').disabled = false;" type="radio" name="apstatus" id="radio1" value="confirmed" checked>
																<label for="radio1">Confirm Registration</label>
															</div>
														</label>
														<label class="radio-inline">
															<div class="radio radio-info">
																<input onClick="document.getElementById('teamcode').disabled = true;" type="radio" name="apstatus" id="radio2" value="Cancelled">
																<label for="radio2">Cancelled</label>
															</div>
														</label>
													</div>
												 </div>
												</div>
												<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Enter a team name</label>
                                                        <input required type="text" id="username" name="tname" class="form-control" placeholder="Enter a teamcode" value="<?php echo $apointrow["teamcode"]; ?>">
                                                        
                                                        <!-- username check start -->
										                   <div>
										                      <span id="usernameLoading"><img src="../plugins/images/busy.gif" alt="Ajax Indicator" height="15" width="15" /></span>
										                      <span id="usernameResult" style="color: #E40003"></span>
										                   </div>
				                                        <!-- username check end -->
                                                     </div>
                                                </div>
											</div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" name="apupdate" class="btn btn-success"> <i class="fa fa-check"></i>Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--./row-->
				
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
    <!-- Date Picker Plugin JavaScript -->
    <script src="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="../plugins/js/mask.js"></script>
    <script>
		jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });
	</script>
	<script>
		jQuery('.mydatepicker, #datepicker').datepicker();
    jQuery('#datepicker-autoclose1').datepicker({
        autoclose: true,
        todayHighlight: true
    });
	</script>
</body>

</html>
