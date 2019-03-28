<?php
include '../login/accesscontroladmin.php';
require('connect.php');
$ausername=$_SESSION['admin'];
$getidquery="SELECT fests.fid FROM admin JOIN fests ON admin.aid=fests.aid WHERE ausername='$ausername'";
$getidresult = mysqli_query($connection, $getidquery);
$getidrow = mysqli_fetch_assoc($getidresult);
//$aid=$getidrow['aid'];
$fid=$getidrow['fid'];
if (isset($_POST['eventheadsubmit']))
	{
		// real eacape sting is used to prevent sql injection hacking
		$ename=mysqli_real_escape_string($connection,$_POST['ename']);
		$edesc=mysqli_real_escape_string($connection,$_POST['edesc']);
		$erounds= mysqli_real_escape_string($connection,$_POST['erounds']);
        $participants=mysqli_real_escape_string($connection,$_POST['participants']);
		$hname=mysqli_real_escape_string($connection,$_POST['hname']).',';
		$addname=mysqli_real_escape_string($connection,$_POST['addname']);
		$hmob=mysqli_real_escape_string($connection,$_POST['hmob']);
        $hemail=mysqli_real_escape_string($connection,$_POST['hemail']);
		$husername=mysqli_real_escape_string($connection,$_POST['username']);
		$password= md5($_POST['hpassword']);
		$repassword= md5($_POST['rpassword']);
		//sqll query
		//double quotes outside so we can use single quotes inside
		if($password == $repassword)
		{

			$usersql="SELECT * FROM `events` WHERE husername='$husername'";
			$checkuser=mysqli_query($connection, $usersql);
			$countu=mysqli_num_rows($checkuser);
			$emailsql="SELECT * FROM `events` WHERE hemail='$hemail'";
			$checkemail=mysqli_query($connection, $emailsql);
			$counte=mysqli_num_rows($checkemail);
			if($counte==1 || $countu==1)
			{
				$fmsg = "username/email alredy exists";
			}
			else
			{

				$query="INSERT INTO `events` (fid,ename,edesc,erounds,participants,hname,addname,hmob,hemail,husername,hpassword) VALUES ('$fid','$ename','$edesc','$erounds', '$participants','$hname','$addname','$hmob','$hemail','$husername',
                '$password')";
				$result = mysqli_query($connection, $query);
				//takes two arguments
				if($result)
				{
					$smsg = "Event Added Successfully.".mysqli_error($connection);
				}
				else
				{
					$fmsg = "Event Head Registration Failed";
				}
			}
		}
		else
		{
			$fmsg="Password Doesn't Match";
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
                        <h4 class="page-title">Add Events </h4>
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
                            <h3 class="box-title m-b-0">Event Information</h3>
                            <hr>
                            <form data-toggle="validator" method="post">
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

                         		<div class="row">
                                	<div class="col-md-12">
                                       <div class="form-group">
                                        	 <label class="control-label">Event Name</label>
											<div class="col-sm-12 p-l-0">
												<div class="input-group">
													<!--<div class="input-group-addon">Dr.</div>-->
													<input type="text" name="ename" class="form-control" id="ename" placeholder="Enter event name" required>
													<!--onKeyUp="copyTextValue();"-->
												</div>
											</div>
                                         </div>
                                    </div>
                                    <!--/span-->
									 
                                    <!--/span-->
                                 </div>

                                <div class="form-group">
                                    <label for="edecription" class="control-label">Event Description</label>
                                    <textarea type="text" class="form-control" autocomplete="off" id="edesc" name="edesc" placeholder="Enter event description" required></textarea>
                                    <!-- username check start 
										<div>
										<span id="usernameLoading"><img src="../plugins/images/busy.gif" alt="Ajax Indicator" height="15" width="15" /></span>
										<span id="usernameResult" style="color: #E40003"></span>
										</div>
				                     <!-- username check end -->
                                </div>
                                 <div class="form-group">
                                    <label for="inputName1" class="control-label">Event Rounds</label>
                                     <input type="text" name="erounds" class="form-control" id="erounds" placeholder="Enter number of rounds" required>
                                   
                                    <!-- username check start 
										<div>
										<span id="usernameLoading"><img src="../plugins/images/busy.gif" alt="Ajax Indicator" height="15" width="15" /></span>
										<span id="usernameResult" style="color: #E40003"></span>
										</div>
				                     <!-- username check end -->
                                </div>
                                
                                 <div class="form-group">
                                    <label for="inputName1" class="control-label">Number of Participants</label>
                                    <input type="text" class="form-control" autocomplete="off" id="participants" name="participants" placeholder="Enter number of participants" required>
                                    <!-- username check start 
										<div>
										<span id="usernameLoading"><img src="../plugins/images/busy.gif" alt="Ajax Indicator" height="15" width="15" /></span>
										<span id="usernameResult" style="color: #E40003"></span>
										</div>
				                     <!-- username check end -->
                                </div>
                                
                                <div class="row">
                                	<div class="col-md-12">
                                       <div class="form-group">
                                        	 <label class="control-label">Event Head Name</label>
											<div class="col-sm-12 p-l-0">
												<div class="input-group">
													<!--<div class="input-group-addon">Dr.</div>-->
													<input type="text" name="hname" class="form-control" id="hname" placeholder="Enter one event head name" required>
													<!--onKeyUp="copyTextValue();"-->
                                                </div><br></div>
                                           <div class="col-sm-12 p-l-0">
                                                <div class="input-group">
													<!--<div class="input-group-addon">Dr.</div>-->
													<input type="text" name="addname" class="form-control" id="addame" placeholder="Enter Additional event head name[separate by commas]" required>
													<!--onKeyUp="copyTextValue();"-->
												</div>
											</div>
                                         </div>
                                    </div>
                                    <!--/span-->
									 
                                    <!--/span-->
                                 </div>
                               <!-- <div class="form-group">
                                    <label class="col-sm-12 p-l-0">Gender</label>
                                    <div class="col-sm-12 p-l-0">
                                        <select class="form-control" name="gender" required>
                                            <option selected hidden disabled>Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-12 p-l-0">Floor</label>
                                    <div class="col-sm-12 p-l-0">
                                        <select class="form-control" name="floor">
                                            <option selected hidden disabled>Select Floor</option>
                                            <option value="G">Ground floor</option>
                                            <option value="1">1st floor</option>
                                            <option value="2">2nd floor</option>
                                            <option value="3">3rd floor</option>
                                        </select>
                                    </div>
                                </div>-->

                                <div class="form-group">
                                    <label for="example-phone">Event Head Mobile Number </label>
                                        <input type="text" required id="example-phone" name="hmob" class="form-control" placeholder="enter mobile number(multiple numbers separate by commas)" data-error="Invalid mobile number">
										<div class="help-block with-errors"></div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputEmail" class="control-label">Event Head Email</label>
                                    <input type="email" name="hemail" class="form-control" id="inputEmail" placeholder="Enter the email" data-error="This email address is invalid" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputName1" class="control-label">Event Head Username</label>
                                    <input type="text" class="form-control" autocomplete="off" id="username" name="username" placeholder="Username is used to login" required>
                                    <!-- username check start -->
										<div>
										<span id="usernameLoading"><img src="../plugins/images/busy.gif" alt="Ajax Indicator" height="15" width="15" /></span>
										<span id="usernameResult" style="color: #E40003"></span>
										</div>
				                     <!-- username check end -->
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="control-label">Event Head Password</label>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <input type="password" name="hpassword" data-toggle="validator" data-minlength="6" class="form-control" id="inputPassword" placeholder="Password" required>
                                            <span class="help-block">Minimum of 6 characters</span> </div>
                                        <div class="form-group col-sm-6">
                                            <input type="password" name="rpassword" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Passwords don't match" placeholder="Confirm" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="form-group">
                                    <div class="checkbox">
                                        <input type="checkbox" id="terms" data-error="Before you wreck yourself" required>
                                        <label for="terms"> Check yourself </label>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>-->
                                <div class="form-group">
                                    <center><button type="submit" name="eventheadsubmit" class="btn btn-info">Submit</button></center>
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
</body>

</html>