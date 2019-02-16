 <?php
require('connect.php');
session_start();
//if(isset($_SESSION['$ausername']))
//{
//    $username=$_SESSION['$ausername'];
//}
if(isset($_POST['username']) && isset($_POST['password']))
    {
    $username=mysqli_real_escape_string($connection,$_POST['username']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);
    $mobile=mysqli_real_escape_string($connection,$_POST['mobile']);
    $password=md5($_POST['password']);
    $cpassword=md5($_POST['cpassword']);
    if($password==$cpassword)
    {
        $usersql= "SELECT * FROM `admin` WHERE ausername='$username'";
        $checkuser=mysqli_query($connection,$usersql);
        $countu=mysqli_num_rows($checkuser);
        $useremail="SELECT * FROM `admin` WHERE aemail='$email'";
        $checkemail=mysqli_query($connection,$useremail);
        $counte=mysqli_num_rows($checkemail);
        if($countu==1 || $counte==1)
        {
            $fmsg="username or email already exits";
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
                if($result1)
                {
                    $_SESSION['aid'] = $id;
                    $smsg="Account created successfully, redirecting to event registration in 2 seconds";
                }
                    
                
             }
        }
        
    }
    else
    {
            $fmsg="PASSWORD DONOT MATCH";
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
    <meta name="author" content="Soujanya M">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>OFMS-User Registration</title>
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
    <link href="../plugins/css/colors/blue.css" id="theme" rel="stylesheet">
    <!--alerts CSS -->
    <link href="../plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
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
</head>
<body >
    <!-- Preloader -->
    <div class="preloader">
    <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register" style="overflow: scroll; max-width: 100%; overflow-x: hidden">
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
				  window.location.href = "../login/register-fest.php";
				  }, 2000); </script>'
				  ?>
              </div> 
              <?php }?>
<div class="login-box">
     <div class="white-box">
           <form data-toggle="validator" class="form-horizontal form-material" id="loginform" method="post">
           <h3 class="box-title m-b-20">Enter Account Details</h3>
                <div class="form-group ">
                     <div class="col-xs-12">
                           <input autocomplete="off" class="form-control" type="text" required placeholder="UserName" name="username" id="username">
                           <!-- username check start -->
                            <div>
                            <span id="usernameLoading"><img src="../plugins/images/busy.gif" alt="Ajax Indicator" height="15" width="15" /></span>
                            <span id="usernameResult" style="color: #E40003"></span>
                            </div>
                         <!-- username check end -->
                     </div>
                </div>
                <div class="form-group ">
                     <div class="col-xs-12">
                          <input class="form-control" name="email" type="email" required placeholder="Email" data-error="This email address is invalid">
                          <div class="help-block with-errors"></div>
                     </div>
                </div>
                <div class="form-group">
                     <input type="tel" pattern="[0-9]*" maxlength="11" minlength="10" required id="example-phone" name="mobile" class="form-control" placeholder="Enter your mobile number" data-error="Invalid mobile number">
                     <div class="help-block with-errors"></div>
                </div>
                <div class="form-group ">
                      <div class="col-xs-12">
                            <input required  id="inputPassword" data-minlength="6" class="form-control" name="password" type="password" placeholder="Password(minimum of 6 characters)">
                            <div class="help-block with-errors"></div>
                      </div>
                </div>
                <div class="form-group">
                     <div class="col-xs-12">
                          <input data-match="#inputPassword" data-match-error="Passwords don't match" data-minlength="6" class="form-control" type="password" name="cpassword" required placeholder="Confirm Password">
                          <div class="help-block with-errors"></div>
                     </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Next</button>
                    </div>
                    </div>

         </form>
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
</body>
</html>
