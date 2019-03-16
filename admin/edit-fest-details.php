<?php
include '../login/accesscontroladmin.php';
require('connect.php');
$ausername=$_SESSION['admin'];
    
$query="SELECT fname,fdate,ftype,fdesc,cname,caddress,cphone,cemail,city,cstate,cpincode,regfees,rules FROM fests";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);

//update profile
if(isset($_POST['updateprofile']))
{
	
    $fname=mysqli_real_escape_string($connection,$_POST['fname']);
    $ftype=mysqli_real_escape_string($connection,$_POST['ftype']);
    $edate=$_POST['fdate'];
    $myDateTime = DateTime::createFromFormat('d-m-Y', $edate);
    $dob = $myDateTime->format('Y-m-d');
    $fdesc=mysqli_real_escape_string($connection,$_POST['fdesc']);
    $cname=mysqli_real_escape_string($connection,$_POST['cname']);
    $cadress=mysqli_real_escape_string($connection,$_POST['caddress']);
    $cphone=mysqli_real_escape_string($connection,$_POST['cphone']);
	$cemail=mysqli_real_escape_string($connection,$_POST['cemail']);
	$city=mysqli_real_escape_string($connection,$_POST['city']);
    $state=mysqli_real_escape_string($connection,$_POST['state']);
    $pincode=mysqli_real_escape_string($connection,$_POST['pincode']);
    $regfees=mysqli_real_escape_string($connection,$_POST['regfees']);
    $frules=mysqli_real_escape_string($connection,$_POST['frules']);
    
    
	$uquery="UPDATE fests SET fname='$fname',ftype='$ftype',fdate='$dob',fdesc='$fdesc',cname='$cname',caddress='$cadress',cphone='$cphone',cemail='$cemail',city='$city',cstate='$state',cpincode='$pincode',regfees='$regfees',rules='$frules'";
	$uresult = mysqli_query($connection, $uquery);
	if($uresult)
	{
		$squery="SELECT fname,ftype,fdate,fdesc,cname,caddress,cphone,cemail,city,cstate,cpincode,regfees,rules FROM fests";
		$sresult = mysqli_query($connection, $squery);
		$row = mysqli_fetch_assoc($sresult);
		$smsg="Fest Details Updated successfully!";

	}
	else
	{
		$fmsg="error!".mysqli_error($connection); ;
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
	
	<link href="../plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
<!-- username check js start -->
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#usernameLoading').hide();
		$('#username').keyup(function(){
		  $('#usernameLoading').show();
	      $.post("check-docusername.php", {
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
    return (today - idate) < 0 ? true : false;
}
	</script>
	
	<script>
		function checkDate(){
    var idate = document.getElementById("datepicker"),
        resultDiv = document.getElementById("datewarn");
        //dateReg = /(0[1-9]|[12][0-9]|3[01])[-](0[1-9]|1[012])[-]201[4-9]|20[2-9][0-9]/;

   // if(dateReg.test(idate.value)){
        if(isFutureDate(idate.value)){
            resultDiv.innerHTML = "Entered date is a future date";
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
	
	
   <!-- wysihtml5 CSS -->
    <link rel="stylesheet" href="../plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" />
	<link href="../plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
        
    
    
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
                        <h4 class="page-title">Fest Details</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="../index.php" target="_blank" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Home</a>
                        <?php echo breadcrumbs(); ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
				
				<!--- imported add-doctors---->
				<!--.row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">Edit Fest Details</div>
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
                                   <?php if(isset($smsg1)) { ?>
										<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											 <?php echo $smsg1; ?>
										</div> 
								<?php }?>
                                    <?php if(isset($fmsg1)) { ?>
									<div class="alert alert-danger alert-dismissable">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										 <?php echo $fmsg1; ?>
									</div> 
					            <?php }?> 
                                    <form method="post" data-toggle="validator">
                                        <div class="form-body">
                                            <h3 class="box-title">Fest Info</h3>
                                            <hr>
                                          <div class="row">
                                	<div class="col-md-12">
                                       <div class="form-group">
                                        	 <label class="control-label">Fest Name</label>
											<div class="col-sm-12 p-l-0">
												<div class="input-group">
													<!--<div class="input-group-addon">Dr.</div>-->
													<input type="text" name="fname" class="form-control" id="ename" placeholder="Enter your event name" value="<?php echo $row["fname"]; ?>">
													<!--onKeyUp="copyTextValue();"-->
												</div>
											</div>
                                         </div>
                                    </div>
                                    <!--/span-->
                                    
                                    <div class="row">
                                          <div class="form-group col-sm-6">
                                               <label class="control-label">Fest Type</label>
                                                 <!--<div class="col-sm-12 p-l-0">-->
                                                      <select class="form-control" name="ftype" required>
                                                            <option <?php if($row["ftype"]=='1'){echo 'selected';}?> value="G">IT</option>
                                                            <option <?php if($row["ftype"]=='2'){echo 'selected';}?> value="1">MANAGEMENT</option>
                                                            <option <?php if($row["ftype"]=='3'){echo 'selected';}?> value="2">CULTURAL</option>
                                                            <option <?php if($row["ftype"]=='4'){echo 'selected';}?> value="3">OTHERS...</option>
                                                      </select>
                                              <!--</div> -->
                                         </div>
                                   
                                         <div class="form-group col-sm-6">                             
                                               <label class="control-label">Fest Date</label>
                                                      
                                                           <!--<div class="input-group">-->
								                                 <input onChange="checkDate();" onKeyUp="checkDate();" data-date-format="dd-mm-yyyy" type="text" class="form-control" data-mask="99-99-9999" id="datepicker" name="fdate" placeholder="dd-mm-yyyy" required  value="<?php echo $row["fdate"]; ?>">
								                           <!--</div>-->
                                                     
								                     <div id="datewarn"></div>
                                            <!--<span class="font-13 text-muted">dd-mm-yyyy</span>-->
                                        </div>
                                 </div>

									 <div class="col-md-12">
										  <div class="form-group">
											   <label class="control-label">Fest Description</label>
                                              <div class="col-sm-12 p-l-0">
											   <textarea type="text" name="fdesc" id="edesc" class="form-control" placeholder="Enter your event description" ><?php echo $row["fdesc"]; ?></textarea>
											   <!--<span class="help-block"> This field has error. </span>-->
                                         </div>
										   </div>
									 </div>
                                    <!--/span-->
                                 </div>
                               
                                <div class="form-group">
                                    <label for="inputName1" class="control-label">College Name</label>
                                     <div class="col-sm-12 p-l-0">
                                    <input type="text" class="form-control" autocomplete="off" id="erounds" name="cname" placeholder="Enter your event rounds" value="<?php echo $row["cname"];?>">
                                         </div>
                                   
                                </div>
                                  <div class="form-group">
                                        	 <label class="control-label">College address</label>
											<div class="col-sm-12 p-l-0">
												<div class="input-group">
													<!--<div class="input-group-addon">Dr.</div>-->
													<textarea input type="text" name="cadress" class="form-control" id="hname" placeholder="Enter the address" ><?php echo $row["caddress"];?></textarea>
													<!--onKeyUp="copyTextValue();"-->
												</div>
											</div>
                                       </div>
                                 <div class="row">
                                  <div class="form-group col-sm-6">
                                    <label for="example-phone">College Phone number</span></label>
                                 
                                        <input type="text" required id="example-phone" name="cphone" class="form-control" placeholder="enter your mobile number" data-mask="(999) 999-9999" value="<?php echo $row["cphone"]; ?>">
                                </div>
                            
                                   <div class="form-group col-sm-6">
                                    <label for="inputEmail" class="control-label"> College Email</label>
                                    
                                    <input type="email" name="cemail" class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $row["cemail"]; ?>" data-error="This email address is invalid" required>
                                    <div class="help-block with-errors"></div>
                                    
                                </div>
                                 </div>
                            <div class="row">
                                 <div class="form-group  col-sm-4">
                                        	 <label class="control-label ">City</label>
								                 <div class="input-group">
													<!--<div class="input-group-addon">Dr.</div>-->
													<input type="text" name="city" class="form-control" id="hname" placeholder="Enter your event head name" value="<?php echo $row["city"]; ?>">
													<!--onKeyUp="copyTextValue();"-->
												</div>
                                                </div>
                                             
                                            <div class="form-group  col-sm-4">
                                                <label class="control-label ">State</label>
                                               
                                                <div class="input-group">
													<!--<div class="input-group-addon">Dr.</div>-->
													<input type="text" name="state" class="form-control" id="hname" placeholder="Enter your event head name" value="<?php echo $row["cstate"]; ?>">
													<!--onKeyUp="copyTextValue();"-->
												</div>
                                                </div> 
                                                <div class="form-group  col-sm-4">
                                                <label class="control-label">Pincode</label>
                                               
                                                <div class="input-group ">
													<!--<div class="input-group-addon">Dr.</div>-->
													<input type="text" name="pincode" class="form-control" id="hname" placeholder="Enter your event head name" value="<?php echo $row["cpincode"]; ?>">
													<!--onKeyUp="copyTextValue();"-->
												</div>
											</div>
                                       </div>
                                  <div class="form-group">
                                    <label for="inputName1" class="control-label">Register fees</label>
                                     <div class="col-sm-12 p-l-0">
                                    <input type="text" class="form-control" autocomplete="off" id="erounds" name="regfees" placeholder="Enter your registration fees">
                                 </div>
                                   
                                </div> 
                                <div class="row form-group">
                                       <label for="inputName1" class="control-label">Fest Rules</label>
                                </div>
									  <!--<div class="form-group">
                                        <textarea style="font-weight: normal" required class="textarea_editor form-control" rows="15" cols="120" placeholder="Enter text ..." name="frules"></textarea>
                                    </div>-->
                                    <div class="form-group">
                                        <textarea style="font-weight: normal" required class="textarea_editor form-control" rows="15" placeholder="Enter text ..." name="msg"></textarea>
                                    </div>
                                    
                                    <!--</div> --> 
                                </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <button class="btn btn-success" name="updateprofile">Update Profile</button>
                                            </div>
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
	<script src="../plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
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
<!-- /#wrapper -->
    <!--jslink has all the JQuery links-->
    <?php include'assets/jslink.php'; ?>
<script src="../plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="../plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
    <script src="../plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
    <script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();

    });
    </script>
</body>

</html>