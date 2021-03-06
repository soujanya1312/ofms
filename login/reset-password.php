<?php
$id = $_GET['id'];
require('connect.php');
$query="SELECT email FROM resetpassword WHERE tmpstr='$id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$check= mysqli_num_rows($result);
if($check!=1)
{
	$emsg="EXPIRED LINK!";
}
$email=$row["email"];
if(isset($_POST['password']) && isset($_POST['cpassword']))
{
	$password=md5($_POST['password']);
	$repassword=md5($_POST['cpassword']);
	if($password == $repassword)
	{
		$query1="SELECT * FROM admin WHERE aemail='$email'";
		$result1 = mysqli_query($connection,$query1);
		$count1 = mysqli_num_rows($result1);
		if($count1==1)
		{
			$query2="UPDATE admin SET apassword='$password' WHERE aemail='$email' ";
			$result2 = mysqli_query($connection, $query2);
		 	if($result2)
			{
				$smsg="Password has been reset successfully";
				$query5="DELETE FROM resetpassword WHERE tmpstr='$id'";
				$result5 = mysqli_query($connection,$query5);
			}
        }
	}
	else
	{
		$fmsg="Password does not match!";
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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<!--JS to disbale Form inputs if the link is expired-->
<script>
function dissableForm() {
	document.getElementById("pw1").disabled=true;
	document.getElementById("pw2").disabled=true;
    document.getElementById("reset-button").disabled=true;
}
</script>
<!--end-->
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register">
        <div class="login-box">
            <div class="white-box">
                <form class="form-horizontal form-material" id="loginform" method="post">
                   
                <?php if(isset($fmsg)) { ?><div class="alert alert-danger"> <?php echo $fmsg; ?> </div> <?php }?>
                <!--DNS Added Expired link with disable function-->
				<?php if(isset($emsg)) { echo '<BODY onLoad="dissableForm()">'; ?>
				<div class="alert alert-danger"> <?php echo $emsg; ?> </div> 
				<?php }?>
				<!--end-->
				<?php if(isset($smsg)) { ?> <div class="alert alert-success"> <?php echo $smsg; ?> </div>
				<a href="../login/" class="btn btn-success btn-lg btn-block waves-effect waves-light">Proceed for Login</a>
                <?php }?>
                   
                    <h3 class="box-title m-b-20">Reset your password</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="password" id="pw1" required="" placeholder="New password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" name="cpassword" id="pw2" required="" placeholder="Confirm Password">
                        </div>
                    </div>
                    
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" id="reset-button">Reset password</button>
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
</body>

</html>
