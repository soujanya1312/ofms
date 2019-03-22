<?php
include '../login/accesscontrolhead.php';
require('connect.php');
$ausername=$_SESSION['husername'];
$gethname="SELECT eid FROM events WHERE husername='$ausername'";
$gethnameresult=mysqli_query($connection,$gethname);
$gethnamerow=mysqli_fetch_assoc($gethnameresult);
$eid=$gethnamerow['eid'];
$geteventname="SELECT ename,erounds FROM events where eid='$eid'";
$getfestnameresul1=mysqli_query($connection,$geteventname);
$getfestnamero1=mysqli_fetch_assoc($getfestnameresul1);

if (isset($_POST['submit']))
	{
		$eventname= mysqli_real_escape_string($connection,$_POST['event']);
        $rname=mysqli_real_escape_string($connection,$_POST['erounds']);
		$ff= $_POST['ff'];
		$tt= $_POST['tt'];
		if($ff <= $tt)
	{	
				$query="INSERT INTO `event_time`(eventid,event_round,t_from,t_to) VALUES ('$eid','$rname','$ff','$tt')";
				$result = mysqli_query($connection, $query);
	
				if($result)
				{
					$smsg = "Time Added Succesfully";
                    echo'<script> window.location="view-eventtime.php";</script>';
				}
				else
				{
					//$fmsg = "error!".mysqli_error($connection);
                    $fmsg = "Round ".$rname." is already Scheduled";
				}
		}
			else
			{
			$fmsg = "Avoid overlapping of From and To time";
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
    <!--csslink.php includes fevicon and title-->
    <?php include 'assets/csslink.php'; ?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>
	<link href="../plugins/bower_components/colorpicker/bootstrap-colorpicker.js" rel="stylesheet" type="text/css"/>
      <!-- username check js start -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#usernameLoading').hide();
		$('#username').keyup(function(){
		  $('#usernameLoading').show();
	      $.post("check-eventheadname.php", {
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
        <div id="page-wrapper" style="background-image: url(../plugins/images/w.jpg)">
            <div class="container-fluid">
                <div class="row bg-title">
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Event Scheduling</h4>
                    </div>
                    <!-- /.page title -->
                    <!-- .breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                      <a href="../index.html" target="_blank" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Home</a>
                      <?php echo breadcrumbs(); ?>
                    </div>
                    <!-- /.breadcrumb -->
                </div>
                <!--DNS added Dashboard content-->
                <!--row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Event Information</h3>
                            <form data-toggle="validator" method="post">
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
								<div class="form-group">
									 <label for="inputEmail" class="control-label ">Event Name</label>
									       <input type="text" id="username" name="event" class="form-control" value="<?php echo $getfestnamero1['ename']; ?>"  readonly/>  
								</div>
                          
                                
                                <?php
									$eventname=$getfestnamero1['ename'];
									$i="SELECT * FROM events WHERE ename='$eventname'";
									$res=mysqli_query($connection, $i);
									$rowevent = mysqli_fetch_assoc($res);
									$totrows=$rowevent['erounds'];
									$countid=1;
									?>
                                
                                        <div class="form-group">
                                    <label class="control-label">No of Days</label>
                                                
                                        <select class="form-control" name="nodays">
                                            <option selected hidden disabled>Select the day</option>
                                            <option value="1"> Day 1</option>
                                            <option value="2"> Day 2</option>
                                            <option value="3"> Day 3</option>
                                            <option value="4"> Day 4</option>
                                            <option value="5"> Day 5</option>
                                        </select>
                                   
                                </div>
                       
								 <div class="form-group">
									 <label for="inputEmail" class="control-label">Round</label>
								<select required class="form-control" name="erounds">
									<option disabled hidden selected>SELECT ROUND</option>
									<?php while($countid <= $totrows) { ?>
									<option value="<?php echo $countid ?>"> <?php echo 'Round '.$countid; ?></option>
									<?php $countid++; } ?>
								</select> 
								</div>
								<div class="form-group">
                                    <label for="inputName1" class="control-label">Enter Time</label>
                                    <div class="row">
                                    <div class="col-sm-6">
                                    
                                    
                                    
									From:
									<input id="time" type="time" name="ff" 
                                           class="form-control clockpicker" required >
                                        </div>
                                    <div class="col-sm-6"> 
                                        
                                    To:
									<input id="time" type="time" name="tt" 
									class="form-control clockpicker" required >
								</div>
                                   </div>
                                    </div>
                                <div class="form-group">
                                    <button type="submit" name="submit" class="btn btn-info waves-effect waves-light">Submit</button>
                                </div>
                                     
                            </form>
                        </div>
                    </div>
				</div>
            </div>
            <!--footer.php contains footer-->
            <?php include'assets/footer.php'; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!--jslink has all the JQuery links-->
	<script src="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
	<script src="js/mask.js"></script>
    <?php include'assets/jslink.php'; ?>
</body>

</html>
