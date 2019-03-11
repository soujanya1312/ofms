<?php
include '../accesscontrolparticipant.php';
require('../../participants/connect.php');
$ausername=$_SESSION['pusername'];
$id=$_GET['id'];

$gethname="SELECT pid FROM participants WHERE pusername='$ausername'";
$gethnameresult=mysqli_query($connection,$gethname);
$gethnamerow=mysqli_fetch_assoc($gethnameresult);
$pid=$gethnamerow['pid'];


$query="SELECT epname,epmob,epemail FROM eventparticipants WHERE pid='$pid' AND eid='$id'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
if(isset($_POST['update']))
{
	$name= mysqli_real_escape_string($connection,$_POST['name']);
	$mob= mysqli_real_escape_string($connection,$_POST['mob']);
	$mail=mysqli_real_escape_string($connection,$_POST['mail']);
	
	$uquery="UPDATE eventparticipants SET  epname='$name', epmob='$mob',epemail='$mail' ";
	$uresult = mysqli_query($connection, $uquery);
	if($uresult)
	{
		$squery="SELECT epname,epmob,epemail FROM eventparticipants";
		$sresult = mysqli_query($connection, $squery);
		$row = mysqli_fetch_assoc($sresult);
		$smsg="participants updated successfully!";
	}
	else
	{
		$fmsg="participants updation ERROR!";
	}
	
	}
?>
<!--html design-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>OFMS | EDIT</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Online Fest Management System">
    <meta name="author" content="Soujanya M">
    <!--csslink.php includes fevicon and title-->
    <?php include '../../participants/assets/csslink.php'; ?>
      
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
    <?php include '../../participants/assets/header.php';
	include '../../participants/assets/left-sidebar.php';
	include '../../participants/assets/breadcrumbs.php';
	?>
        <!-- Page Content -->
        <div id="page-wrapper" style="background-image: url(../../plugins/images/w.jpg)">
            <div class="container-fluid">
                <div class="row bg-title">
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Edit Participants Details</h4>
                    </div>
                    <!-- /.page title -->
                    <!-- .breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                       <a href="../../index.html" target="_blank" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Home</a>
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
							<div class="user-bg p-l-30 m-l-10 p-t-10"> <img width="80%" height="95%"  alt="user" src="../../plugins/images/index1.jpg">
                                  <div class="user-content">
                                      <h3>
                                       <p><strong><?php echo $gethnamerow["ename"]; ?></strong>
                                       <p><strong><?php echo $gethnamerow["edesc"]; ?></strong>
                                      </h3>
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
                                <?php foreach($result as $key=>$result) {  ?>
                                <div class="tab-pane active" id="profile">
                                    <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r"> Participants:
                                            <br><br>
                                            <p><strong><?php echo $result["epname"]; ?></strong></p>
                                        </div>
                                      
                                        <div class="col-md-6 col-xs-6 "> Email :
                                            <br>
                                            <p><strong><?php echo $result['epemail']?></strong></p>
                                      	 Mob :
                                            <p><strong><?php echo $result['epmob']?></strong></p>
										</div>
                                        
                                    </div>
                                     <div class="row">
                                         <div class="col-md-3 col-xs-6 b-r">       
                                              <p class="text-muted"></p>
                                         </div>
                                          
                                         <div class="col-md-3 col-xs-6 b-r">                              <p class="text-muted"></p>
                                         </div> 
                                         <div class="col-md-3 col-xs-6">                                   <p class="text-muted"></p>
                                          </div>
								    </div>
                        </div>
                                <?php } ?>
                                
                               
                            <div class="tab-pane" id="settings">
                             <form data-toggle="validator" method="post">
                              
                              
                         		<div class="row">
                                	<div class="col-md-6">
                                       <div class="form-group">
                                        	   <div class="row">
                           				   <div class="form-group col-md-12">
											 <label class="control-label ">Participants</label>
											<input type="text" id="username" name="name" class="form-control" value="<?php echo $row['epname']; ?>" readonly/>  
								  			</div>   
                                              <div class="form-group col-md-12">
											 <label class="control-label ">Email</label>
											<input type="text" id="username" name="mail" class="form-control" value="<?php echo $row['epemail']; ?>" readonly/>  
								  			</div>         
                                	       <div class="form-group col-md-12">
											 <label class="control-label ">Mobile Number</label>
											<input type="text" id="username" name="mob" class="form-control" value="<?php echo $row['epmob']; ?>" readonly/>  
								  			</div>  
							</div>
								 </div>
										 <div class="form-group p-t-0">
                                       <button class="btn btn-success" name="update">Update Contestants </button>
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
            <?php include'../../participants/assets/footer.php'; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!--jslink has all the JQuery links-->
    <?php include'../../participants/assets/jslink.php'; ?>
</body>

</html>
