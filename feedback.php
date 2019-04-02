<?php
require("admin/connect.php");
if(isset($_GET['id']))
{
    $id = $_GET['id'];
}
if(isset($_POST['fbsubmit'])){
    
    if(!isset($_GET['id'])){
           $id=$_POST['fest'];
       }
    $name=mysqli_real_escape_string($connection,$_POST['name']);
    $email=mysqli_real_escape_string($connection,$_POST['email']);
    $mob=mysqli_real_escape_string($connection,$_POST['mob']);
    $fest=mysqli_real_escape_string($connection,$_POST['fest']);
    $fbmsg=mysqli_real_escape_string($connection,$_POST['fb']);
    
    $query="INSERT INTO `feedback`(fid,pname,f_name,f_email,f_mob,f_msg)VALUES('$id','$name','$fest','$email','$mob','$fbmsg')";
     $result2 = mysqli_query($connection,$query);
        if($result2)
           {
             $smsg="1";
          }
     else{
         $fmsg="error".mysqli_error($connection);
     }
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
<title>Feedback</title>
<link rel="stylesheet" type="text/css" href="lp-plugins/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="lp-plugins/css/bootstrap-slider.min.css">
<link rel="stylesheet" type="text/css" href="lp-plugins/css/fontawesome-all.min.css">
<link rel="stylesheet" type="text/css" href="lp-plugins/css/slick.css">
<link rel="stylesheet" type="text/css" href="lp-plugins/css/style-darkblue.css">
<link rel="stylesheet" type="text/css" href="lp-plugins/css/custom.css">
</head>

<body background="plugins/images/login-register.jpg" class="fullpage">
<div id="form-section" class="container-fluid signup">
    <div class="website-logo hidden-xs">
        <a href="index.php">
            <div class="logo" style="width:246px;height:68px"></div>
        </a>
    </div>
    <div class="website-logo visible-xs" style="top: 15px; left: 15px">
        <a href="index.php">
            <div class="logo" style="width:170px;height:50px"></div>
        </a>
    </div>
    <div class="row">
        <!-- <div class="info-slider-holder">
            <div class="info-holder">
                <h6>A Service you can anytime modify.</h6>
                <div class="bold-title">it’s not that hard to get<br>
    a website <span>anymore.</span></div>
                <div class="mini-testimonials-slider">
                    <div>
                        <div class="details-holder">
                            <img class="photo" src="images/person1.jpg" alt="">
                            <img src="plugins/images/invoice-logo.png">
                        </div>
                    </div>
                    <div>
                        <div class="details-holder">
                            <img class="photo" src="images/person2.jpg" alt="">
                            <img src="plugins/images/invoice-logo.png">
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="form-holder">
            <div class="menu-holder">
                <ul class="main-links">
                    <li><a class="normal-link hidden-xs" href="login/register-user.php">Planning to host a fest?</a></li>
                    <li><a class="sign-button" href="login/register-user.php">Sign up</a></li>
                </ul>
            </div>
            <div class="signin-signup-form">
                <div class="form-items">
                    
                    <div class="form-title">Please provide your valuable feedback</div>
                    <?php if(isset($smsg)){ ?>
                    <div style="color: greenyellow ; background-color: rgba(63,63,63,0.77); padding: 10px; font-size: 15px; font-weight: bold; border-radius: 15px; margin-bottom: 10px ">Thank you for your feedback <a class="ybtn ybtn-accent-color" style="color: greenyellow; font-weight: bold;" href="index.php">go back</a></div>
                    <?php } ?>
                    <?php if(isset($fmsg)){ ?>
                    <div style="color: orangered; background-color: rgba(63,63,63,0.77); padding: 10px; font-size: 15px; font-weight: bold; border-radius: 15px; margin-bottom: 10px">There was some problem<?php echo "error".mysqli_error($connection); ?></div>
                    <?php } ?>
                    <form method="post" id="signupform">
                        <!-- <div class="row">
                            <div class="col-md-6 form-text">
                                <input type="text" name="firstname" placeholder="First name" required>
                            </div>
                            <div class="col-md-6 form-text">r
                                <input type="text" name="lastname" placeholder="Last name" required>
                            </div>
                        </div> -->
                        <div class="form-text">
                            <input type="text" name="name" placeholder="Name" autocomplete="off" required>
                        </div>
                        <div class="form-text">
                            <input type="text" name="email" placeholder="E-mail Address" autocomplete="off"  required>
                        </div>
                        <div class="form-text">
                            <input type="text" name="mob" placeholder="Mobile number" autocomplete="off"  required>
                        </div>
                        <?php if(!isset($_GET['id'])) { ?>
                        <div class="form-text">
                            <select required name="fest">
                                <option disabled hidden selected>Select Fest</option>
                                <?php $getfestquery="SELECT * FROM fests";                                            $getfestresult=mysqli_query($connection,$getfestquery); while($getfests=mysqli_fetch_assoc($getfestresult))
														{ 
                                                   ?>
                                <option value="<?php echo $getfests['fid']; ?>"><?php echo $getfests['fname'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php } ?>
                        <?php if(isset($_GET['id'])) { 
                         $getfestquery="SELECT * FROM fests WERE fid='$id'";                                $getfestresult=mysqli_query($connection,$getfestquery); $getfests=mysqli_fetch_assoc($getfestresult); ?>
                        <div class="form-text">
                            <input disabled type="text" value="<?php echo $getfests['fname'] ?>" name="fest" placeholder="Mobile number" autocomplete="off" required>
                        </div>
                        <?php } ?>
                        <div class="form-text">
                            <textarea name="fb" placeholder="Enter your feedback" required></textarea>
                        </div>
<!--
                        <div class="form-text">
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
-->
                        <!-- <div class="form-text text-holder">
                            <span class="text-only">Preferred method of payment.</span>
                            <input type="radio" name="pmethod" class="hno-radiobtn" id="rad1"><label for="rad1">Paypal</label>
                            <input type="radio" name="pmethod" class="hno-radiobtn" id="rad2"><label for="rad2">Credit Card</label>
                        </div> -->
                        <div class="form-button">
                            <button id="submit" type="submit" name="fbsubmit" class="ybtn ybtn-accent-color">Submit Feedback</button>
							<button id="submit" onClick="window.location.href='index.php'" type="button" class="ybtn ybtn-accent-color">Go back</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="lp-plugins/js/jquery.min.js"></script>
<script src="lp-plugins/js/bootstrap.min.js"></script>
<script src="lp-plugins/js/bootstrap-slider.min.js"></script>
<script src="lp-plugins/js/slick.min.js"></script>
<script src="lp-plugins/js/main.js"></script>
</body>
</html>
