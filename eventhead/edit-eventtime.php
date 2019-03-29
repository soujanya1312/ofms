<?php
include '../login/accesscontrolhead.php';
require('connect.php');
$ausername=$_SESSION['husername'];
$id = $_GET['id'];
$gethname="SELECT * FROM events WHERE husername='$ausername'";
$gethnameresult=mysqli_query($connection,$gethname);
$gethnamerow=mysqli_fetch_assoc($gethnameresult);
$evntname=$gethnamerow['ename'];

$query="SELECT * FROM event_time WHERE en_id='$id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
if(isset($_POST['update']))
{
	$eday=$_POST['eday'];
    $eroom=$_POST['eroom'];
    $ff= $_POST['ff'];
	$tt= $_POST['tt'];
	if($ff<=$tt)
	{
	$uquery="UPDATE event_time SET  t_from='$ff', t_to='$tt' ,eday='$eday',eroom='$eroom' WHERE en_id='$id'";
	$uresult = mysqli_query($connection, $uquery);
	if($uresult)
	{
		$squery="SELECT * FROM event_time WHERE en_id='$id'";
		$sresult = mysqli_query($connection, $squery);
		$row = mysqli_fetch_assoc($sresult);
		$smsg="Time updated successfully!";
	}
	else
	{
		$fmsg="Time updation ERROR!";
	}
	}
		else
		{
		$fmsg="Set Proper Time";
		}
	}
?>
<!--html design-->
<!DOCTYPE html>
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
      
    <!-- username check js start -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#e_eventnameLoading').hide();
		$('#e_eventname').keyup(function(){
		  $('#e_eventnameLoading').show();
	      $.post("check-eventname.php", {
	        username: $('#e_eventname').val()
	      }, function(response){
	        $('#e_eventnameResult').fadeOut();
	        setTimeout("finishAjax('e_eventnameResult', '"+escape(response)+"')", 500);
	      });
	    	return false;
		});
	});

	function finishAjax(id, response) {
	  $('#usernameLoading').hide();
	  $('#'+e_id).html(unescape(response));
	  $('#'+e_id).fadeIn();
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
                        <h4 class="page-title">Edit Scheduling Details</h4>
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
                <div class="row">
                    <div class="col-md-4 col-xs-12">
                        <div class="white-box">
                           <div class="overlay-box">
							<div class="user-bg p-l-30 m-l-10 p-t-30"> <img width="80%" height="80%"  alt="user" src="../plugins/images/users/time1.jpg">
                                  <div class="user-content">
                                       </div>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="col-md-8 col-xs-12">
                        <div class="white-box">
                            <ul class="nav customtab nav-tabs" role="tablist">
                                <!--<li role="presentation" class="nav-item"><a href="#home" class="nav-link " aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa fa-home"></i></span><span class="hidden-xs"> Activity</span></a></li>-->
                                <li role="presentation" class="nav-item"><a href="#profile" class="nav-link active" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Profile</span></a></li>
                                <li role="presentation" class="nav-item">
								<a href="#settings" class="nav-link" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Setting</span></a></li>
                                <li role="presentation" class="nav-item">
                            </ul>
                           
							<div class="tab-content">
                                <div class="tab-pane active" id="profile">
                                    <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r"> Event Name
                                            <br><br>
                                            <p><strong><?php echo $evntname ?></strong></p>
                                        </div>
                                        <div class="col-md-3 col-xs-3 b-r"> Round
                                            <br><br>
                                            <p><strong><?php echo $row["event_round"]; ?></strong></p>
                                        </div>
                                        <div class="col-md-3 col-xs-3 b-r"> Day
                                            <br><br>
                                            <p><strong><?php echo $row["eday"]; ?></strong></p>
                                        </div>
                                        <div class="col-md-3 col-xs-3 "> From :
                                            <br>
                                            <p><strong><?php echo date('h:i a',strtotime($row['t_from']))?></strong></p>
                                      	 To :
                                            <p><strong><?php echo date('h:i a',strtotime($row['t_to']))?></strong></p>
										</div>
                                          
                                        
                                    </div>
                                     <div class="row">
                                         <div class="col-md-3 col-xs-6 b-r">       
                                              <p class="text-muted"></p>
                                         </div>
                                          <div class="col-md-3 col-xs-6 b-r">       
                                              <p class="text-muted"></p>
                                         </div>
                                         <div class="col-md-3 col-xs-6 b-r">                              <p class="text-muted"></p>
                                         </div>
                                         <div class="col-md-3 col-xs-6">                                   <p class="text-muted"></p>
                                          </div>
								    </div>
                        </div>
                                
                               
                            <div class="tab-pane" id="settings">
                             <form data-toggle="validator" method="post">
                              
                              
                         		<div class="row">
                                	<div class="col-md-6">
                                       <div class="form-group">
                                        	   <div class="row">
                           				   <div class="form-group col-md-12">
											 <label class="control-label ">Event</label>
											<input type="text" id="username" name="eventname" class="form-control" value="<?php echo $evntname ?>" readonly/>  
								  			</div>   
                                              <div class="form-group col-md-12">
											 <label class="control-label ">Event Round</label>
											<input type="text" id="username" name="eventround" class="form-control" value="<?php echo $row['event_round']; ?>" readonly/>  
								  			</div>  
                                                   
                                            <div class="form-group col-md-12">
											 <label class="control-label ">Event Day</label>
											<input type="text" id="username" name="eday" class="form-control" value="<?php echo $row['eday']; ?>" >  
								  			</div>
                                            <div class="form-group col-md-12">
											 <label class="control-label ">Event Location</label>
											<input type="text" id="username" name="eroom" class="form-control" value="<?php echo $row['eroom']; ?>" >  
								  			</div>       
                                	<div class="form-group col-md-12">    
									<label for="inputName1" class="control-label">Event Time</label>
                                    <br>
									From:
									<input type="time" class="form-control" autocomplete="off" id="username" name="ff" value="<?php echo $row['t_from']; ?>" required>
								 <br>
									To:
									<input type="time" class="form-control" autocomplete="off" id="username" name="tt" value="<?php echo $row['t_to']; ?>" required>
								</div>
							</div>
								 </div>
										 <div class="form-group p-t-0">
                                       <button class="btn btn-success" name="update">Update Time </button>
										</div>
								 </div>
								</div>
                                </div>
                                
								</form>
                                
                                
								</div>
                               
                            </div>
                        </div>
                    </div>
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
</body>

</html>
