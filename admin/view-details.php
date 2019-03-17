<?php
include '../login/accesscontroladmin.php';
require('connect.php');
$ausername=$_SESSION['admin'];

//$squery="SELECT *,eventparticipants.epname,eventparticipants.epmob,eventparticipants.epemail FROM eventparticipants INNER JOIN events ON eventparticipants.eid = eventseid WHERE ep_id='$id'";
$squery="SELECT eid,ename,edesc,hname,addname,hmob,hemail, participants FROM events";
$sresult = mysqli_query($connection, $squery);
$row = mysqli_fetch_assoc($sresult);
$pari= $row["participants"];
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
                                    <?php
                                      $getpidquery="SELECT fid,fname,fdate,ftype,fdesc from fests ";
					                  $getpidres=mysqli_query($connection, $getpidquery);
					                  $row2 = mysqli_fetch_assoc($getpidres);
                                                ?>
                    
                                <div class="row">
                                	 <div class="col-md-6" >
                                          <div class="form-group">
                                               <label class="control-label">Fest Name</label>
								                       <div class="col-sm-12 p-l-0">
								                            <div class="input-group">
								                                 <input type="text" name="dname" class="form-control" placeholder="Fest Name" disabled value="<?php echo $row2["fname"];?>">
								                            </div>
				                                       </div>
                                         </div>
                                    </div>
                                     
                                       <div class="col-md-6" >
                                            <div class="form-group">                                   
                                                 <label class="control-label">Fest Date</label>
                                                      <div class="input-group">
								                         <input onChange="checkDate();" onKeyUp="checkDate();" data-date-format="dd-mm-yyyy" type="text" class="form-control" data-mask="99-99-9999" id="datepicker" name="fdate" placeholder="dd-mm-yyyy" required   disabled value="<?php echo $row2["fdate"];?>">
								               </div>
								                     <div id="datewarn"></div>
                                                              <!--<span class="font-13 text-muted">dd-mm-yyyy</span>-->
                                             </div>
                                        </div>
                                   </div>

                                   <div class="form-group">
                                    <label class="col-sm-12 p-l-0">Fest Type</label>
                                    <div class="col-sm-12 p-l-0">
                                        <select class="form-control" name="ftype"  disabled value="<?php echo $row2["ftype"];?>">
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
                                          <textarea input type="text" name="fdesc" class="form-control" disabled placeholder="Tell us about your fest">  <?php echo $row2["fdesc"];?></textarea>
                                     </div>
                                </div>

                    <h3 class="box-title m-b-0">Event Details</h3><hr>
                    
                       <div class="row">
                <?php
                   $getidquery="SELECT fests.fid FROM admin JOIN fests ON admin.aid=fests.aid WHERE ausername='$ausername'";
                   $getidresult = mysqli_query($connection, $getidquery);
                  $getidrow = mysqli_fetch_assoc($getidresult);
                    $fid=$getidrow['fid'];


					$query = "SELECT eid,ename,edesc,erounds,participants,hemail,hmob FROM events WHERE fid='$fid'";
					$result = mysqli_query($connection, $query);
				foreach($result as $key=>$result)
				{ ?>
                <div class="col-md-4 col-sm-4">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center">
                                        <img src="../plugins/images/index4.jpg" class="img-square img-responsive"> 
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h2 class="box-title m-b-0"><?php echo $result["ename"]; ?></h2>
                                   <strong> Event description:</strong><?php echo $result["edesc"]; ?><br>
                                    <strong> Event Rounds:</strong> <?php echo $result["erounds"]; ?><br>
                                    <strong> Event participants:</strong> <?php echo $result["participants"]; ?>
                                    
                                    <p calss="p-0">
										<a href="mailto:<?php echo $result["hemail"]; ?>"> <font size="-1"> <?php echo $result["hemail"]; ?> </font> </a> <br>
                                        <a href="mailto:<?php echo $result["hemail"]; ?>"> <font size="-1"> <?php echo $result["hmob"]; ?> </font> </a>
										
										
                                    </p>
									
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php
					}
				  ?>

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
