<?php                                                                   
require("connect.php");
if(isset($_GET['id']))
{
    $id = $_GET['id'];
}
$getsettingsquery="SELECT * FROM admin_settings WHERE fid='$id'";
$getsettings=mysqli_query( $connection, $getsettingsquery );
$getsetrow = mysqli_fetch_assoc( $getsettings );
if(!isset($_GET['id']) || $getsetrow['startreg']=='0' || $getsetrow['startreg']=='2' || $getsetrow['viewfest']=='0' )
{
		   
		   echo'<script> window.location="../admin/403.php";</script>';
           //$id=$_POST['fest'];
}
 if(isset($_POST['pregister']))
    {
        $pname=mysqli_real_escape_string($connection,$_POST['pusername']);
        $cmob=mysqli_real_escape_string($connection,$_POST['pmob']);
        $cemail=mysqli_real_escape_string($connection,$_POST['pemail']);
        $cname=mysqli_real_escape_string($connection,$_POST['cname']);
        $caddress=$_POST['cadd1'].' , ';
        $caddress.=$_POST['cadd2'];
        $city=mysqli_real_escape_string($connection,$_POST['city']);
        $cstate=mysqli_real_escape_string($connection,$_POST['cstate']);
        $cpincode=mysqli_real_escape_string($connection,$_POST['cpincode']);

        $query1="INSERT INTO `participants`(fid,pusername,pemail,pmob,pclgname,pcaddress,pcity,pstate,pincode) VALUES ('$id','$pname', '$cemail','$cmob','$cname','$caddress','$city','$cstate','$cpincode')";
        $result2 = mysqli_query($connection,$query1 );
        if($result2)
           {
             $smsg="Registration is Completed!,please wait for your confirmation email";
          }
     else{
         $fmsg="Email already registered";
     }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Online Fest Management System">
    <meta name="author" content="Soujanya M">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>OFMS</title>
    <!-- Bootstrap Core CSS -->
    <link href="../plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="../plugins/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../plugins/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="../plugins/css/colors/blue.css" id="theme" rel="stylesheet">
    <!--alerts CSS -->
    <link href="../plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link href="../plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
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
   // } else {
       // resultDiv.innerHTML = "Invalid date!";
       // resultDiv.style.color = "red";
   // }
}
	</script>
   <!-- username check js start -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#usernameLoading').hide();
		$('#username').keyup(function(){
		  $('#usernameLoading').show();
	      $.post("check-participantusername.php", {
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
<body>
    <!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login-register" style="overflow: scroll">
    <?php if(isset($fmsg)) { ?>
            <div class="alert alert-danger alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                 <?php echo $fmsg; ?>
            </div> 
            <?php }?> 
            <?php if(isset($smsg)) { ?>
             <div class="alert alert-success alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  <?php echo $smsg; 
                  echo '<script> window.setTimeout(function(){
				  swal("Event registration is Completed!", "Redirecting to login in 4 seconds.","success");
				  }, 300);  window.setTimeout(function(){
				  window.location.href = "../login/index.php";
				  }, 4000); </script>'
				  ?>
              </div> 
              <?php }?>
<div style="padding-top: 90px; padding-left: 60px; padding-right: 60px; padding-bottom: 40px">
     <div class="row">
          <div class="col-md-12">
               <div class="white-box">
                    <h3 class="box-title m-b-0">Participant Details</h3><hr>
                    <form data-toggle="validator" method="post">
                              <div class="row">
                                  <div class="col-md-12" >
                                        <div class="form-group">
                                        <label class="control-label">Username Name(for LOGIN)</label>
											   <div class="col-sm-12 p-l-0">
												    <div class="input-group">
													     <input type="text" autocomplete="off" name="pusername" class="form-control" id="username" placeholder="Enter participant user name" required >
												    </div>
                                                   <!-- username check start -->
										                   <div>
										                      <span id="usernameLoading"><img src="../plugins/images/busy.gif" alt="Ajax Indicator" height="15" width="15" /></span>
										                      <span id="usernameResult" style="color: #E40003"></span>
										                   </div>
				                                        <!-- username check end -->
											  </div>
                                        </div>
                                </div>
                                  <!-- <div class="row col-md-12">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                  <label class="control-label">Password</label>
                                                         <input required  id="inputPassword" data-minlength="6" class="form-control" name="pass" type="password" placeholder="Enter the password(minimum of 6 characters)">
                                                  <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label class="control-label">Confirm Password</label>
                                                        <input data-match="#inputPassword" data-match-error="Passwords don't match" data-minlength="6" class="form-control" type="password" name="cpass" required placeholder="Confirm Password">
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                    </div>-->
                                   <div class="row col-md-12">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                              <label class="control-label">Mobile number</label>
                                              <input type="tel" pattern="[0-9]*" maxlength="11" id="pmobile" name="pmob" class="form-control" placeholder="Enter Mobile no." data-error="Invalid mobile number"required>
								              <div class="help-block with-errors"></div>
                                         </div>
                                    </div>
                                
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="pemail" id="pemail" class="form-control" placeholder="Enter email address" data-error="email address is invalid" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                 </div>
                                   <div class="col-md-12" >
                                        <div class="form-group">
                                        <label class="control-label">College Name</label>
											   <div class="col-sm-12 p-l-0">
												    <div class="input-group">
													     <input type="text" name="cname" class="form-control" id="fname" placeholder="Enter your college name" required >
												    </div>
											  </div>
                                        </div>
                                </div>
                                  <?php if(!isset($_GET['id'])) { ?>
                                  <div class="col-md-12" >
                                        <div class="form-group" style="padding-bottom: 0px; margin-bottom: 0px">
                                        <label class="control-label">Select Fest</label>
                                             <div class="col-sm-12 p-l-0">
                                                 <div class="input-group">
											   <select required class="form-control" data-style="form-control" name="fest">
                                                   <option disabled hidden selected>Select Fest</option>
                                                   <?php $getfestquery="SELECT * FROM fests";                                            $getfestresult=mysqli_query($connection,$getfestquery); while($getfests=mysqli_fetch_assoc($getfestresult))
														{ 
                                                   ?>
                                                   <option value="<?php echo $getfests['fid']; ?>"> <?php echo $getfests['fname'] ?></option>
                                                   <?php } ?>
                                            </select>
                                                 </div>
                                            </div>
                                        </div>
                                </div>
                                  <?php } ?>
                                      <?php if(isset($_GET['id'])) { 
                                  $getfestquery="SELECT * FROM fests WHERE fid='$id'";                                $getfestresult=mysqli_query($connection,$getfestquery); $getfests=mysqli_fetch_assoc($getfestresult);
                                  ?>
                                      <div class="col-md-12" e>
                                        <div class="form-group" style="padding-bottom: 0px; margin-bottom: 0px">
                                        <label class="control-label">Fest Name</label>
											   <div class="col-sm-12 p-l-0">
												    <div class="input-group">
													     <input disabled type="text" name="fest" class="form-control" value="<?php echo $getfests['fname'] ?>">
												    </div>
											  </div>
                                        </div>
                                </div>
                                      <?php } ?>
                                 <h3 class="box-title m-t-40">College Address</h3><hr>
                                 <!--<div class="row">-->
                                <div class="col-md-12 ">
                                     <div class="form-group">
                                          <label>Address line 1</label>
                                          <input name="cadd1" type="text" class="form-control" required>
                                     </div>
                                </div>
                                <!-- </div>
                                <div class="row">-->
                                <div class="col-md-12 ">
                                     <div class="form-group">
                                          <label>Address line 2</label>
                                          <input type="text" name="cadd2" class="form-control" required>
                                     </div>
                                </div>
                        </div>
                                <!--</div>
                                    <!--/span-->
									<!--<div class="col-md-6">
										  <div class="form-group">
											   <label class="control-label">Last Name</label>
											   <input type="text" name="lname" id="lastName" class="form-control" placeholder="Enter your last name" required>
											   <!--<span class="help-block"> This field has error. </span>
										   </div>
									 </div>
                                    <!--/span-->
                           
                               
                               <!--<div class="form-group">
                                    <label for="inputName1" class="control-label">Username</label>
                                    <input type="text" class="form-control" autocomplete="off" id="username" name="username" placeholder="Username is used to login" required>
                                    <!-- username check start 
										<div>
										<span id="usernameLoading"><img src="../plugins/images/busy.gif" alt="Ajax Indicator" height="15" width="15" /></span>
										<span id="usernameResult" style="color: #E40003"></span>
										</div>
				                     <!-- username check end 
                                </div>-->
                                  
                                <div class="row">
                                 <!--/span-->
                                    <div class="col-md-4">
                                         <div class="form-group">
                                              <label>State</label>
                                              <input name="cstate" type="text" class="form-control" required>
                                         </div>
                                    </div>
                                 <!--/span-->
                                    <div class="col-md-4">
                                         <div class="form-group">
                                              <label>City</label>
                                              <input name="city" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                         <div class="form-group">
                                               <label>Pincode</label>
                                               <input name="cpincode" type="text" class="form-control" required>
                                         </div>
                                     </div>
                                </div>
                               
                                <!--<div class="form-group">
                                    <label class="col-sm-12 p-l-0">Gender</label>
                                    <div class="col-sm-12 p-l-0">
                                        <select class="form-control" name="gender" required>
                                            <option selected hidden disabled>Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>-->
                                      <div  class="form-group">
                                           <center>
                                           <button type="submit" name="pregister" class="btn btn-rounded btn-lg btn-info">Submit</button></center>
                                     </div>
                    </form>
                 </div>
            </div>
         </div>
    </div>
</section>
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../plugins/bootstrap/dist/js/tether.min.js"></script>
    <script src="../plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="../plugins/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../plugins/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../plugins/js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    
    <script src="../plugins/js/validator.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="../plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
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
