<?php
include '../login/accesscontroladmin.php';
require('connect.php');
$ausername=$_SESSION['admin'];

$query="SELECT *,fests.fname, fests.fdesc,fests.fdate,fests.cname,fests.caddress,fests.cemail,fests.cphone,fests.fid FROM admin INNER JOIN fests ON admin.aid=fests.fid WHERE ausername='$ausername'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$id=$row["aid"];
$fid=$row["fid"];

//update profile
if(isset($_POST['updateprofile']))
{
	$username= mysqli_real_escape_string($connection,$_POST['username']);
	$email=mysqli_real_escape_string($connection,$_POST['email']);
	
	$uquery="UPDATE admin SET ausername='$username', aemail='$email' WHERE aid='$id'";
	$uresult = mysqli_query($connection, $uquery);
	if($uresult)
	{
		$squery="SELECT ausername, aemail FROM admin WHERE aid='$id'";
		$sresult = mysqli_query($connection, $squery);
		$row = mysqli_fetch_assoc($sresult);
		$smsg="Profile updated successfully!";
		$_SESSION['admin']=$row['ausername'];
		$ausername=$_SESSION['admin'];
		

	}
	else
	{
		$fmsg="error!".mysqli_error($connection);
	}
}

//update event details
if(isset($_POST['editevent']))
{
	$ename= mysqli_real_escape_string($connection,$_POST['ename']);
    $edate=$_POST['edate'];
    $myDateTime = DateTime::createFromFormat('d-m-Y', $edate);
    $dob = $myDateTime->format('Y-m-d');
	$edesc=mysqli_real_escape_string($connection,$_POST['edesc']);
    $cname=mysqli_real_escape_string($connection,$_POST['cname']);
    $caddress=mysqli_real_escape_string($connection,$_POST['caddress']);
    $cemail=mysqli_real_escape_string($connection,$_POST['cemail']);
    $cphone=mysqli_real_escape_string($connection,$_POST['cphone']);
    
	$equery="UPDATE fests SET    fname='$ename',fdate='$dob',fdesc='$edesc',cname='$cname',caddress='$caddress',cemail='$cemail',cphone='$cphone' WHERE fid='$fid'";
	$eresult = mysqli_query($connection, $equery);
	if($eresult)
	{
		$cquery="SELECT *,fests.fname, fests.fdesc,fests.fdate,fests.cname,fests.caddress,fests.cemail,fests.cphone,fests.eid FROM admin INNER JOIN fests ON admin.aid=fests.fid WHERE ausername='$ausername'";
		$cresult = mysqli_query($connection, $cquery);
		$row = mysqli_fetch_assoc($cresult);
		$smsg="Event details updated successfully!";
    }
	else
	{
		$fmsg="Event details are  not submitted";
	}
}


//change password
if(isset($_POST['changepassword']))
{
	$oldpw=md5($_POST['oldpassword']);
	if($oldpw==$row["apassword"])
	{
		$npw=md5($_POST['newpassword']);
		$pwquery="UPDATE admin SET apassword='$npw' WHERE ausername='$ausername'";
		$pwresult = mysqli_query($connection, $pwquery);
		$smsg="Password updated successfully!";
		
	}
	else
	{
		$fmsg="Wrong old password!";
        //.mysqli_error($connection);
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
    <meta name="description" content="Online Fest Hospital Management System">
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
	      $.post("check-adminusername.php", {
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
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#usernameLoading').hide();
		$('#username').keyup(function(){
		  $('#usernameLoading').show();
	      $.post("check-adminusername.php", {
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
		function isFutureDate(idate){
    var today = new Date().getTime(),
        idate = idate.split("-");

    idate = new Date(idate[2], idate[1] - 1, idate[0]).getTime();
    return (today - idate) > 0 ? true : false;
    }
	</script>
	<script>
		function checkDate(){
    var idate = document.getElementById("datepicker"),
        resultDiv = document.getElementById("datewarn");
        //dateReg = /(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[012])[-]201[4-9]|20[2-9][0-9]/;
       // if(dateReg.test(idate.value)){
        if(isFutureDate(idate.value)){
            resultDiv.innerHTML = "Event date cannot be in the past";
            resultDiv.style.color = "red";
       } else {
            resultDiv.innerHTML = "It's a valid date";
            resultDiv.style.color = "green";
        }
    } else {
       resultDiv.innerHTML = "Invalid date!";
        resultDiv.style.color = "red";
   }
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
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Profile</h4>
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
                                        <a href="javascript:void(0)"> <img src="../plugins/images/users/user(2).png" class="thumb-lg img-circle" > </a>
                                        <h4 class="text-white"><?php echo $ausername; ?></h4>
                                        <h5 class="text-white"><?php echo $row["aemail"]; ?></h5>
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
                                <li role="presentation" class="nav-item"><a href="#remove" class="nav-link" aria-controls="remove" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs">Remove Account</span></a></li>
                                <li role="presentation" class="nav-item"><a href="#editevent" class="nav-link" aria-controls="editevent" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-times"></i></span> <span class="hidden-xs">Edit Event Details</span></a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6 b-r"> <strong>Username</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $ausername; ?></p>
                                        </div>
                                        <div class="col-md-6 col-xs-6 "> <strong>Email</strong>
                                            <br>
                                            <p class="text-muted"><?php echo $row["aemail"]; ?></p>
                                        </div>
                                        
                                    </div>
                                    
                                    
                                </div>
                                
                               
                            <div class="tab-pane" id="settings">
                             <form data-toggle="validator" method="post">
                             <div class="form-group">
                                    <label for="inputName1" class="control-label">Username</label>
                                    <input type="text" class="form-control" autocomplete="off" id="username" name="username" placeholder="Username is used to login" value="<?php echo $ausername ?>" required>
                                    <!-- username check start -->
										<div>
										<span id="usernameLoading"><img src="../plugins/images/busy.gif" alt="Ajax Indicator" height="15" width="15" /></span>
										<span id="usernameResult" style="color: #E40003"></span>
										</div>
				                     <!-- username check end -->
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="control-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $row["aemail"]; ?>" data-error="This email address is invalid" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                 
                                
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" type="submit" name="updateprofile">Update Profile</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="tab-pane" id="changepassword"> 
                                
                                <form data-toggle="validator" method="post">
                                <div class="form-group">
                                    <label for="inputPassword" class="control-label">Change Password</label>
                                    <div class="row">
                                    <div class="form-group col-sm-12 p-l-0 p-t-10">
                                    <input type="password" name="oldpassword" data-toggle="validator" data-minlength="6" class="form-control" id="oldpassword" placeholder="Old Password" required>
                                     </div>
									</div>
                                    
                                    <div class="row">
                                        <div class="form-group col-sm-6  p-l-0 p-t-10">
                                            <input type="password" name="newpassword" data-toggle="validator" data-minlength="6" class="form-control" id="inputPassword" placeholder="New Password" required>
                                            <span class="help-block">Minimum of 6 characters</span> </div>
                                        <div class="form-group col-sm-6  p-l-0 p-t-10">
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
                              	<div class="tab-pane" id="remove">
                              		<div class="text-center">
                              		<a href="#" class="fcbtn btn btn-danger model_img deleteAdmin" data-id="<?php echo $id ?>" id="deleteDoc">Remove Admin Account</a>
									</div>
								</div>
                                 <div class="tab-pane" id="editevent"> 
                                 <form data-toggle="validator" method="post">
                                   <div class="row">
                                	 <div class="col-md-6" >
                                          <div class="form-group">
                                               <label class="control-label">Event Name</label>
								                       <div class="col-sm-12 p-l-0">
								                            <div class="input-group">
								                                 <input value="<?php echo $row['ename'] ?>" type="text" name="ename" class="form-control" id="ename" placeholder="Event Name" >
								                            </div>
				                                       </div>
                                         </div>
                                    </div>
                                     
                                    <div class="col-md-6" >
                                         <div class="form-group">                                    <label class="control-label">Event Date</label>
                                                    <div class="input-group">
								                         <input onChange="checkDate();" onKeyUp="checkDate();" data-date-format="dd-mm-yyyy" type="text" class="form-control" data-mask="99-99-9999" id="edate" name="edate" placeholder="dd-mm-yyyy" value="<?php $dateb=$row['edate'];
											$myDateTime = DateTime::createFromFormat('Y-m-d', $dateb);
											$dobc = $myDateTime->format('d-m-Y');  echo $dobc;  ?>">
								                    </div>
								                   <div id="datewarn"></div>
                                    <!--<span class="font-13 text-muted">dd-mm-yyyy</span>-->
                                         </div>
                                   </div>
                                </div>
                                <label class="control-label">Event Description</label>
                                <div class="col-md-12 p-l-0 p-t-10 ">
                                     <div class="form-group">
                                          <input value="<?php echo $row['edesc'] ?>" type="text" name="edesc"id="edesc" class="form-control" placeholder="Tell us about your fest">
                                     </div>
                                </div>   
                              <div class="form-group col-md-12 p-l-0 p-t-10">
                                     <label class="control-label">College Name</label>
                                  <input type="text" name="cname" data-toggle="validator" class ="form-control" id="cname" placeholder="Enter the college name" value="<?php echo $row['cname'] ?>">
                                     </div>
                                     <div class="form-group">
                                     <label for="Name2" class="control-label">College Address</label>
                                    <div class="form-group col-md-12 p-l-0 p-t-10">
                                    <textarea name="caddress" data-toggle="validator"  class="form-control" id="caddres" placeholder="Address panel 1" > <?php echo $row['caddress'] ?> </textarea>
                                     </div>
                                   
                                          
                                        <div class="form-group col-md-12 p-l-0 p-t-10">
                                            <label class="control-label"> College Email</label>
                                            <input type="email" name="cemail" id="cemail" class="form-control" placeholder="Enter email address" data-error="email address is invalid" value="<?php echo $row['cemail'] ?>" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    <div class="form-group  col-md-12 p-l-0 p-t-10">
                                     <label for="inputphone" class="control-label">College Phone Number</label>
                                     <input type="tel" pattern="[0-9]*" maxlength="11" id="cphone" name="cphone" class="form-control" placeholder="Enter phone no." data-error="Invalid phone number" value="<?php echo $row['cphone'] ?>">
								 <div class="help-block with-errors"></div>
                                     </div>
                                         <div class="form-group p-t-0">
                                    
                                        <button class="btn btn-success" type="submit" name="editevent">Change Event Details</button>
                                     
                                </div>
									
                                   </form>
                                     
                      </div>
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

<script>
$(document).ready(function() {
  $('.deleteAdmin').click(function(){
    id = $(this).attr('data-id');
      swal({
          title: "Are you sure?",
          text: "You will not be able to recover this account!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false,
		  closeOnCancel: false
      },function(isConfirm)
		 {   
           if (isConfirm) {
			   $.ajax({
			  url: 'deleteadmin.php?id='+id,
			  type: 'DELETE',
			  data: {id:id},
			  success: function(){
				swal("Deleted!", "User has been deleted.", "success");
				window.location.replace("logout.php");
          }
        });   
            } else {     
                swal("Cancelled", "Admin account is safe :)", "error");   
            }
      });
  });

});
	
</script>
