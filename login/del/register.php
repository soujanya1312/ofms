<?php
require('connect.php');
//if(isset($_SESSION['$ausername']))
//{
//    $username=$_SESSION['$ausername'];
//}
if(isset($_POST['username']) && isset($_POST['password']))
    {
    $username=mysqli_real_escape_string($connection,$_POST['username']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);
    $mobile=mysqli_real_escape_string($connection,$_POST['mobnum']);
    $password=md5($_POST['password']);
    $rpassword=md5($_POST['rpassword']);
    if($password==$rpassword)
    {
        $usersql= "SELECT * FROM `admin` WHERE ausername='$username'";
        $checkuser=mysqli_query($connection,$usersql);
        $countu=mysqli_num_rows($checkuser);
        $useremail="SELECT * FROM `admin` WHERE aemail='$email'";
        $checkemail=mysqli_query($connection,$useremail);
        $counte=mysqli_num_rows($checkemail);
        if($countu==1 || $counte==1)
        {
            echo"username or email already exits";
        }
        else
        {
            $query="INSERT INTO `admin`(ausername, aemail,amob,apassword) VALUES ('$username','$email','$mobile','$password')";
            $result = mysqli_query($connection, $query); 
            if($result)
            {
                $insertquery="SELECT aid FROM admin WHERE (ausername='$username' AND aemail='$email')";
                $result1=mysqli_query($connection, $insertquery);
				$row = mysqli_fetch_assoc($result1);
				$id=$row["aid"];
                $ename=mysqli_real_escape_string($connection,$_POST['ename']);
                $edate=$_POST['edate'];
		        $myDateTime = DateTime::createFromFormat('d-m-Y', $edate);
		        $dob = $myDateTime->format('Y-m-d');
                $edesc=mysqli_real_escape_string($connection,$_POST['edesc']);
                $cname=mysqli_real_escape_string($connection,$_POST['cname']);
                $caddress=mysqli_real_escape_string($connection,$_POST['cadd']);
                $cphone=mysqli_real_escape_string($connection,$_POST['cphone']);
                $cemail=mysqli_real_escape_string($connection,$_POST['cemail']);
                $city=mysqli_real_escape_string($connection,$_POST['city']);
                $cstate=mysqli_real_escape_string($connection,$_POST['cstate']);
                $cpincode=mysqli_real_escape_string($connection,$_POST['cpincode']);
                
                $query1="INSERT INTO `event`(aid,ename,edate,edesc,cname,caddress,cphone,cemail,city,cstate,cpincode) VALUES ('$id','$ename','$dob','$edesc','$cname','$caddress',' $cphone',' $cemail','$city','$cstate','$cpincode')";
				$result2 = mysqli_query($connection,$query1 );
                if($result2)
                {
                    echo "User created, Please login";
                }
          }
     }
        
  }
}
else
{
    echo "Please enter the details!";
}
    ?>
<!--<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>AlphaSystems - OBS</title>
    <!-- Bootstrap Core CSS -->
    <link href="../plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="../plugins/css/animate.css" rel="stylesheet">
    <!-- Wizard CSS -->
    <link href="../plugins/bower_components/register-steps/steps.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../plugins/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="../plugins/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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
            resultDiv.innerHTML = "Event date is not valid";
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
    <section style="background-color: #DDDDDD; height: 1000px" id="wrapper" class="step-register">
        <div class="register-box">
            <div class="">
                <a href="javascript:void(0)" class="text-center db m-b-40"><img src="../plugins/images/eliteadmin-logo-dark.png" alt="Home" />
                    <br/><img src="../plugins/images/eliteadmin-text-dark.png" alt="Home" /></a>
                <!-- multistep form -->
                <form id="msform" method="post">
                    <!-- progressbar -->
                    <ul id="eliteregister">
                        <li class="active">Account Setup</li>
                        <li>College Details</li>
                   		<li>Event  Details</li>
                    </ul>
                    <!-- fieldsets -->
                    <fieldset>
                        <h2 class="fs-title">Create your account</h2>
<!--                        <h3 class="fs-subtitle">This is step 1</h3> -->
						<input type="text" required name="username" placeholder="Username" />
                        <input type="email" required name="email" placeholder="Email" />
                        <input type="text" name="mobnum" placeholder="Mobile Number" />
                        <input type="password" required name="password" placeholder="Password" />
                        <input type="password" name="rpassword" placeholder="Confirm Password" />
                        <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">College Details</h2>
						<!--<p>Displayed on bill</p>-->
                        <input type="text" required name="cname" placeholder="College Name" />
                        <textarea name="cadd" placeholder="College Address"></textarea>
                        <input type="text" name="cphone" placeholder="College Phone number" />
                        <input type="email" name="cemail" placeholder="College email" />
                        <input type="text" name="city" placeholder="College City" />
                        <input type="text" name="cstate" placeholder="College State " />
                        <input type="text" name="cpincode" placeholder="College Pincode" />
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
	                    <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                   <fieldset>
                        <h2 class="fs-title">Event Details</h2>
<!--                        <h3 class="fs-subtitle">We will never sell it</h3>-->
                        <input type="text" required name="ename" placeholder="Event Name " />
                       <div class="form-group">
                                                        <label class="control-label">Event Date</label>
                                                        <div class="input-group">
															
															<input onChange="checkDate();" onKeyUp="checkDate();" data-date-format="dd-mm-yyyy" type="text" class="form-control" data-mask="99-99-9999"id="datepicker" name="edate" placeholder="dd-mm-yyyy" required>
															
														</div>
														<div id="datewarn"></div>
                                                   		<!--<span class="font-13 text-muted">dd-mm-yyyy</span>-->
                                                    </div>
<!--                       <input data-date-format="dd-mm-yyyy" type="date" name="edate" placeholder="Event Date (dd-mm-yyyy)"/>-->
						<textarea name="edesc" placeholder="Event Description"></textarea>
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                        <button type="submit" name="asubmit" class="action-button">Submit</button>
                    </fieldset> 
                </form>
                <div class="clear"></div>
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
    <script src="../plugins/bower_components/register-steps/jquery.easing.min.js"></script>
    <script src="../plugins/bower_components/register-steps/register-init.js"></script>
    <!--slimscroll JavaScript -->
    <script src="../plugins/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="../plugins/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../plugins/js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    
    
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
</body>

</html>






    