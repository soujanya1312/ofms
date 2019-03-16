<?php
include '../login/accesscontrolhead.php';
require('connect.php');
$ausername=$_SESSION['husername'];

$gethname="SELECT eid,ename FROM events WHERE husername='$ausername'";
$gethnameresult=mysqli_query($connection,$gethname);
$gethnamerow=mysqli_fetch_assoc($gethnameresult);
$hid=$gethnamerow['eid'];

$geteventname="SELECT ename FROM events  where eid='$hid'";
$getfestnameresul1=mysqli_query($connection,$geteventname);
$getfestnamero1=mysqli_fetch_assoc($getfestnameresul1);
$festid=$getfestnamero1['ename'];

$geteventname1="SELECT teamcode FROM events  where eid='$hid'";
$getfestnameresul11=mysqli_query($connection,$geteventname1);
//$getfestnamero2=mysqli_fetch_assoc($getfestnameresul11);
$festid=$getfestnameresul11['teamcode'];

if (isset($_POST['psubmit']))
	{
		$getfid=mysqli_query($connection,"SELECT * FROM fests where fid='$festid'");
		$get=mysqli_fetch_assoc($getfid);
		$fest=$get['fid'];
		$eventname= $getfestnamero1['ename'];
		$round=mysqli_real_escape_string($connection,$_POST['erounds']);
		$college=mysqli_real_escape_string($connection,$_POST['teamcode']);
		$query="INSERT INTO `results`(eventname,r_id,pname,eround) VALUES ('$eventname','$fest','$college','$round')";
				$result = mysqli_query($connection, $query);
	
				if($result)
				{
					$smsg = "Result Updated Succesfully";
				}
				else
				{
					$fmsg = "Result Updating Failed".mysqli_error($connection);
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
                        <h4 class="page-title">Add Result</h4>
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
                            <h3 class="box-title m-b-0">Result Information</h3>
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
									<label for="inputEmail" class="control-label">EVENT</label>
								     <div class="form-group">
									 <?php
									 $selectevent="SELECT ename FROM events WHERE eid='$hid'";
									 $resultevent = mysqli_query($connection, $selectevent);
									?>
									 <!-- <select onChange="disableDrop" required class="form-control action" id="country" name="ename"> -->
								   	 <!--<option disabled hidden selected>Select Event
									 </option>-->
									 <?php while($rowevent = mysqli_fetch_assoc($resultevent)) { ?>
   									  <option value="<?php echo $rowevent['eid']; ?>"></option>
										 
								     
									 <input type="text" class="form-control" disabled value="<?php echo $rowevent['ename']; ?>">
									 <?php } ?>
									 </select>
                                          
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
									 <label for="inputEmail" class="control-label">Round</label>
								<select required class="form-control" name="erounds">
									<option disabled hidden selected>SELECT ROUND</option>
									<?php while($countid <= $totrows) { ?>
									<option value="<?php echo $countid ?>"> <?php echo 'Round '.$countid; ?></option>
									<?php $countid++; } ?>
								</select> 
								</div>
								<?php
									 $college="SELECT teamcode FROM participants WHERE teamcode<>'Cancelled' ";
									 $colres=mysqli_query($connection, $college);
                                     
                                    // $teamname=$getfestnameresul11['teamcode'];
									//$i="SELECT * FROM events WHERE teamcode='$teamname'";
									//$res=mysqli_query($connection, $i);
									//$rowevent = mysqli_fetch_assoc($res);
									//$totrows=$rowevent['teamcode'];
									//$countid=1;
									 ?>
								 <div class="form-group">
									 <label for="inputEmail" class="control-label">SELECTED TEAM</label>
				                     <select required class="form-control" name="teamcode">
									<option disabled hidden selected>SELECT TEAM</option>
                                    <?php while($rowcollege = mysqli_fetch_assoc($colres)) { ?>
									<option value= "<?php echo $rowcollege['teamcode'];?>"> <?php echo $rowcollege['teamcode'];?></option>
									<?php }?>
									</select> 
								</div>
								                                                      
							    <div class="form-group">
                                    <button type="submit" name="psubmit" class="btn btn-info waves-effect waves-light">Submit</button>
                                </div>
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
<?php include'assets/jslink.php'; ?>
</body>

</html>
