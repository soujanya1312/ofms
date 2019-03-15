<?php
require("connect.php");
session_start();
if(!isset($_SESSION['aid']))
   {
	echo '<script> window.location="register-user.php"; </script>';
   }
 if(isset($_POST['eventsubmit']))
    {
        $id = $_SESSION['aid'];
        $ename=mysqli_real_escape_string($connection,$_POST['dname']);
        $edate=$_POST['fdate'];
        $myDateTime = DateTime::createFromFormat('d-m-Y', $edate);
        $dob = $myDateTime->format('Y-m-d');
        $ctype=mysqli_real_escape_string($connection,$_POST['ftype']);
        $cdesc=mysqli_real_escape_string($connection,$_POST['fdesc']);
        $cname=mysqli_real_escape_string($connection,$_POST['cname']);
        $caddress=$_POST['cadd1'].' , '.$_POST['cadd2'];
        $cphone=mysqli_real_escape_string($connection,$_POST['cphone']);
        $cemail=mysqli_real_escape_string($connection,$_POST['cemail']);
        $city=mysqli_real_escape_string($connection,$_POST['city']);
        $cstate=mysqli_real_escape_string($connection,$_POST['cstate']);
        $cpincode=mysqli_real_escape_string($connection,$_POST['cpincode']);

        $query1="INSERT INTO `fests`(aid,fname,fdate,ftype,fdesc,cname,caddress,cphone,cemail,city,cstate,cpincode) VALUES ('$id','$ename','$dob','$ctype'
        ,'$cdesc','$cname','$caddress',' $cphone',' $cemail','$city','$cstate','$cpincode')";
        $result2 = mysqli_query($connection,$query1 );
        if($result2)
           {
             $smsg="Event registration is Completed!, redirecting to login in 4 seconds";
          } 
     else{
         $fmsg="Error".mysqli_error($connection);
     }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>OFMS-EventRegister</title>
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
				  window.location.href = "../login/logout.php";
				  }, 4000); </script>'
				  ?>
              </div> 
              <?php }?>
<div style="padding-top: 90px; padding-left: 60px; padding-right: 60px; padding-bottom: 40px">
     <div class="row">
          <div class="col-sm-12">
               <div class="white-box">
                <form data-toggle="validator" method="post">
               <h3 class="box-title m-b-0">Fest Details</h3><hr>
                                   <div class="row">
                                	 <div class="col-md-6" >
                                          <div class="form-group">
                                               <label class="control-label">Fest Name</label>
								                       <div class="col-sm-12 p-l-0">
								                            <div class="input-group">
								                                 <input type="text" name="dname" class="form-control" placeholder="Fest Name" required>
								                            </div>
				                                       </div>
                                         </div>
                                    </div>
                                     
                                       <div class="col-md-6" >
                                            <div class="form-group">                                   
                                                 <label class="control-label">Fest Date</label>
                                                      <div class="input-group">
								                         <input onChange="checkDate();" onKeyUp="checkDate();" data-date-format="dd-mm-yyyy" type="text" class="form-control" data-mask="99-99-9999" id="datepicker" name="fdate" placeholder="dd-mm-yyyy" required>
								               </div>
								                     <div id="datewarn"></div>
                                                              <!--<span class="font-13 text-muted">dd-mm-yyyy</span>-->
                                             </div>
                                        </div>
                                   </div>

                                   <div class="form-group">
                                    <label class="col-sm-12 p-l-0">Fest Type</label>
                                    <div class="col-sm-12 p-l-0">
                                        <select class="form-control" name="ftype">
                                            <option selected hidden disabled>Select Your FestType</option>
                                            <option value="IT">IT</option>
                                            <option value="Management">MANAGEMENT</option>
                                            <option value="Cultural">CULTURAL</option>
                                            <option value="Others">OTHERS</option>
                                        </select>
                                    </div>
                                </div>
                                <label class="control-label">Fest Description</label>
                                <div class="col-md-12 p-l-0">
                                     <div class="form-group">
                                          <textarea input type="text" name="fdesc" class="form-control" placeholder="Tell us about your fest"></textarea>
                                     </div>
                                </div>

                    <h3 class="box-title m-b-0">College Details</h3><hr>
                    
                              <div class="row">
                                   <div class="col-md-12" >
                                        <div class="form-group" style="padding-bottom: 0px; margin-bottom: 0px">
                                        <label class="control-label">College Name</label>
											   <div class="col-sm-12 p-l-0">
												    <div class="input-group">
													     <input type="text" name="cname" class="form-control" id="fdname" placeholder="Enter your college name" required >
												    </div>
											  </div>
                                        </div>
                                </div>
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
                                          <input type="text" name="cadd2" class="form-control">
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
                                <div class="row">
                                    <div class="col-md-6">
                                         <div class="form-group">
                                              <label class="control-label">Phone</label>
                                              <input type="tel" pattern="[0-9]*" maxlength="11" id="firstName" name="cphone" class="form-control" placeholder="Enter phone no." data-error="Invalid phone number">
								              <div class="help-block with-errors"></div>
                                         </div>
                                    </div>
                                     <!--/span-->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="email" name="cemail" id="lastName" class="form-control" placeholder="Enter email address" data-error="email address is invalid">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                     <!--/span-->
                                 </div>
                               
                               
                                     <div  class="form-group">
                                           <center>
                                           <button type="submit" name="eventsubmit" class="btn btn-rounded btn-lg btn-info">Submit</button></center>
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
