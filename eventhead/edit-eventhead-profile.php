<?php
include '../login/accesscontrolhead.php';
require('connect.php');

    $ausername=($_SESSION['husername']);



$query="SELECT ename,edesc,erounds,participants,hname,addname,hmob,hemail,husername,hpassword FROM events";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

//update profile
if(isset($_POST['updateprofile']))
{
	$ename=mysqli_real_escape_string($connection,$_POST['ename']);
    $edesc=mysqli_real_escape_string($connection,$_POST['edesc']);
    $erounds=mysqli_real_escape_string($connection,$_POST['erounds']);
    $noparticipants=mysqli_real_escape_string($connection,$_POST['noparticipant']);
	$hname=$_POST['hname'];
    $hmob=mysqli_real_escape_string($connection,$_POST['hmob']);
	$hemail=mysqli_real_escape_string($connection,$_POST['hemail']);
	$husername=mysqli_real_escape_string($connection,$_POST['husername']);
    
    
	$uquery="UPDATE events SET ename='$ename',edesc='$edesc',erounds='$erounds',participants='$noparticipants',hname='$hname',hmob='$hmob', hemail='$hemail',husername='$husername'";
	$uresult = mysqli_query($connection, $uquery);
	if($uresult)
	{
		$squery="SELECT ename,edesc,erounds,participants,hname,addname,hmob,hemail,husername FROM events";
		$sresult = mysqli_query($connection, $squery);
		$row = mysqli_fetch_assoc($sresult);
		$smsg="Profile updated successfully!";

	}
	else
	{
		$fmsg="error!".mysqli_error($connection); ;
	}
}
//change password
if(isset($_POST['changepw']))
{
	$oldpw=md5($_POST['oldpassword']);
	if($oldpw==$row["hpassword"])
	{
		$npw=md5($_POST['newpassword']);
		$pwquery="UPDATE events SET hpassword='$npw'";
		$pwresult = mysqli_query($connection, $pwquery);
		$smsg="Password updated successfully!";
		
	}
	else
	{
		$fmsg="Wrong old password!";
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
      
      <!-- username check js start -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#usernameLoading').hide();
		$('#username').keyup(function(){
		  $('#usernameLoading').show();
	      $.post("check-staffusername.php", {
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
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Event Head Profile</h4>
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
                
                 <!--DNS Added Model-->
                <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Important Instruction</h4>
                                        </div>
                                        <div class="modal-body">
                                       	 To Edit Admin information or to delete Admin account you need to login to that admin account.
										</div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            <a href="logout.php" class="btn btn-danger waves-effect waves-light">Proceed for login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         <!--DNS model END-->
               
                
                <!--row -->
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
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg"> <img width="100%" height="100%" alt="user" src="../plugins/images/profile-menu.png">
                                <div class="overlay-box">
                                    <div class="user-content">
                                        <a href="javascript:void(0)"> <img src="../plugins/images/users/man.png" class="thumb-lg img-circle" >
                                        </a>
                                        <h4 class="text-white"><?php echo $row["ename"]; ?></h4>
                                   </div>
                                </div>
                            </div>
                            <!--<div class="user-btm-box">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-purple"><i class="ti-facebook"></i></p>
                                    <h1>258</h1>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-blue"><i class="ti-twitter"></i></p>
                                    <h1>125</h1>
                                </div>
                                <div class="col-md-4 col-sm-4 text-center">
                                    <p class="text-danger"><i class="ti-dribbble"></i></p>
                                    <h1>556</h1>
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <ul class="nav customtab nav-tabs" role="tablist">
                                <!--<li role="presentation" class="nav-item"><a href="#home" class="nav-link " aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa fa-home"></i></span><span class="hidden-xs"> Activity</span></a></li>-->
                                <li role="presentation" class="nav-item"><a href="#profile" class="nav-link active" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span></a></li>
                                <li role="presentation" class="nav-item"><a href="#settings" class="nav-link" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Setting</span></a></li>
                                <li role="presentation" class="nav-item"><a href="#changepassword" class="nav-link" aria-controls="changepassword" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-key"></i></span> <span class="hidden-xs">Change Password</span></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Event Head Name</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $row["hname"]." ".$row["addname"]; ?></p>
                                        </div>
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile number</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $row["hmob"]; ?></p>
                                        </div>
                                        <div class="col-md-6 col-xs-6 "> <strong>Email</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $row["hemail"]; ?></p>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                                
                               
                            <div class="tab-pane" id="settings">
                             <form data-toggle="validator" method="post">
                              
                              
                         		<div class="row">
                                	<div class="col-md-12">
                                       <div class="form-group">
                                        	 <label class="control-label">Event Name</label>
											<div class="col-sm-12 p-l-0">
												<div class="input-group">
													<!--<div class="input-group-addon">Dr.</div>-->
													<input type="text" name="ename" class="form-control" id="ename" placeholder="Enter your event name" value="<?php echo $row["ename"]; ?>">
													<!--onKeyUp="copyTextValue();"-->
												</div>
											</div>
                                         </div>
                                    </div>
                                    <!--/span-->
									 <div class="col-md-12">
										  <div class="form-group">
											   <label class="control-label">Event Description</label>
                                              <div class="col-sm-12 p-l-0">
											   <textarea type="text" name="edesc" id="edesc" class="form-control" placeholder="Enter your event description" ><?php echo $row["edesc"]; ?></textarea>
											   <!--<span class="help-block"> This field has error. </span>-->
                                         </div>
										   </div>
									 </div>
                                    <!--/span-->
                                 </div>
                               
                                <div class="form-group">
                                    <label for="inputName1" class="control-label">Event Rounds</label>
                                     <div class="col-sm-12 p-l-0">
                                    <textarea type="text" class="form-control" autocomplete="off" id="erounds" name="erounds" placeholder="Enter your event rounds"><?php echo $row["erounds"]; ?></textarea>
                                         </div>
                                   
                                </div>
                                  <div class="form-group">
                                        	 <label class="control-label">Number of Participants</label>
											<div class="col-sm-12 p-l-0">
												<div class="input-group">
													<!--<div class="input-group-addon">Dr.</div>-->
													<input type="text" name="noparticipant" class="form-control" id="hname" placeholder="Enter number of participants" value="<?php echo $row["participants"];?>">
													<!--onKeyUp="copyTextValue();"-->
												</div>
											</div>
                                         </div>
                                    
                                       <div class="form-group">
                                        	 <label class="control-label">Event Head Name</label>
											<div class="col-sm-12 p-l-0">
												<div class="input-group">
													<!--<div class="input-group-addon">Dr.</div>-->
													<input type="text" name="hname" class="form-control" id="hname" placeholder="Enter your event head name" value="<?php echo $row["hname"]." ".$row["addname"]; ?>">
													<!--onKeyUp="copyTextValue();"-->
												</div>
											</div>
                                         </div>
                                    
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label">Email</label>
                                    <div class="col-sm-12 p-l-0">
                                    <input type="email" name="hemail" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $row["hemail"]; ?>" data-error="This email address is invalid" required>
                                    <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <!--<div class="form-group">
                                    <label class="col-sm-12 p-l-0">Gender</label>
                                    <div class="col-sm-12 p-l-0">
                                        <select class="form-control" name="gender" required>
                                            <option <?php if($row["gender"]=='male'){echo 'selected';}?> value="male">Male</option>
                                            <option <?php if($row["gender"]=='female'){echo 'selected';}?> value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-12 p-l-0">Floor</label>
                                    <div class="col-sm-12 p-l-0">
                                        <select class="form-control" name="floor" required>
                                            <option <?php if($row["floor"]=='G'){echo 'selected';}?> value="G">Ground floor</option>
                                            <option <?php if($row["floor"]=='1'){echo 'selected';}?> value="1">1st floor</option>
                                            <option <?php if($row["floor"]=='2'){echo 'selected';}?> value="2">2nd floor</option>
                                            <option <?php if($row["floor"]=='3'){echo 'selected';}?> value="3">3rd floor</option>
                                        </select>
                                    </div>
                                </div>-->
                                
                                
                                <div class="form-group">
                                    <label for="example-phone">Mobile number</span>
                                    
                                    
                                    
                                    </label>
                                    <div class="col-sm-12 p-l-0">
                                        <input type="text" required id="example-phone" name="hmob" class="form-control" placeholder="enter your mobile number" data-mask="(999) 999-9999" value="<?php echo $row["hmob"]; ?>">
                                 </div>
                                </div>
                                   <div class="form-group">
                                    <label for="inputName1" class="control-label">Username</label>
                                    <input type="text" class="form-control" autocomplete="off" id="username" name="husername" placeholder="Username is used to login" value="<?php echo $row["husername"]; ?>" required>
                                    <!-- username check start -->
										<div>
										<span id="usernameLoading"><img src="../plugins/images/busy.gif" alt="Ajax Indicator" height="15" width="15" /></span>
										<span id="usernameResult" style="color: #E40003"></span>
										</div>
				                     <!-- username check end -->
                                </div>
                                
                                
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" name="updateprofile">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="tab-pane" id="changepassword"> 
                                
                                <form data-toggle="validator" method="post">
                                <div class="form-group">
                                    <label for="inputPassword" class="control-label">Change Password</label>
                                    <div calss="row">
                                    <div class="form-group col-sm-12 p-l-0 p-t-10">
                                    <input type="password" name="oldpassword" data-toggle="validator" data-minlength="6" class="form-control" id="oldPassword" placeholder="Old Password" required>
                                     </div>
									</div>
                                    
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <input type="password" name="newpassword" data-toggle="validator" data-minlength="6" class="form-control" id="inputPassword" placeholder="New Password" required>
                                            <span class="help-block">Minimum of 6 characters</span> </div>
                                        <div class="form-group col-sm-6">
                                            <input type="password" name="retypepassword" class="form-control" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Passwords don't match" placeholder="Confirm New Password" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group p-t-0">
                                    
                                        <button class="btn btn-success" name="changepw">Change Password</button>
                                     
                                </div>
                                
								</form>
                                
                                
								</div>
                               
                            </div>
                        </div>
                    </div>
                </div>
              
                <!--/row -->
                
                <!--DNS End-->
                <!-- .row -->
                <!--<div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title">Blank Starter page</h3>
                        </div>
                    </div>
                </div>-->
                <!-- /.row -->
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
</body>

</html>
