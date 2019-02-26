<?php
include '../login/accesscontrolparticipant.php';
require('connect.php');
$ausername=$_SESSION['pusername'];
$id=$_GET['id'];
//$squery="SELECT *,eventparticipants.epname,eventparticipants.epmob,eventparticipants.epemail FROM eventparticipants INNER JOIN events ON eventparticipants.eid = eventseid WHERE ep_id='$id'";
 $squery="SELECT eid,ename,edesc,participants FROM events WHERE eid='$id'";
 $sresult = mysqli_query($connection, $squery);
$row = mysqli_fetch_assoc($sresult);



if (isset($_POST['psubmit']))

	{
		$p1= mysqli_real_escape_string($connection,$_POST['cname']);
		$epmob=mysqli_real_escape_string($connection,$_POST['cmob']);
        $epemail=mysqli_real_escape_string($connection,$_POST['cemail']);
		$query="INSERT INTO `eventparticipants`(epname,epmob,epemail) VALUES ('$p1', '$epmob',' $epemail') ";
		$result = mysqli_query($connection, $query);
		if($result)
		{
			$smsg = " Participants are Selected For the Event";
		}
        else
        {
             $fmsg="Error".mysqli_error($connection);
        }
	}
	


?>
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
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Events Participants</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <a href="../index.php" target="_blank" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Home</a>
                        <?php echo breadcrumbs(); ?>
                    </div>
                    <!-- /.breadcrumb -->
                </div>
                <!--DNS added Dashboard content-->
                <!--DNS Added Model-->
                <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                     <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title">EDIT Instructions</h4>
                              </div>
                              <div class="modal-body">
                                   To Edit Admin information or to delete Admin account you need to login to that admin account.
				              </div>
                              <div class="modal-footer">
                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                    <a href="logout.php" class="btn btn-danger waves-effect waves-light">Proceed for login</a>
                              </div>
                          </div>
                    </div>
             </div>
                         <!--DNS model END-->
    
             <div class="row p-b-10">
				  <div class="col-md-12 col-sm-10 hvr-wobble-horizontal">
				       <div class="card card-inverse">
							<img id="theImgId" class="card-img" src="../plugins/images/cards/bg.png" height="120" alt="Card image">
				           <div class="card-img-overlay" style="padding-top: 5px">
								
								  <p class="card-text" id="cText">Event Name: <?php echo $row["ename"]; ?></p>
                                  <p class="card-text" id="cText">Event Description:<?php echo $row["edesc"]; ?></p>
                                  <p class="card-text" id="cText">No of contestants: <?php echo $row["participants"]; ?></p>
							
								  <p class="card-text"><small class="text-white">~OFMS</small></p>
				           </div>
				     </div>
				</div>
             </div>
              
                <!--row -->
          <div class="row">
                <div class="col-md-12">
                      <div class="white-box">
                            <h3 class="box-title m-b-0">Participant Details</h3><hr>
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
                                       <div class="row">
                                          <!--/span-->
                                             <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label>Contestant Name:</label>
                                                    <input name="cname" type="text" class="form-control" placeholder="Enter the name" required>
                                                  </div>
                                              </div>
                                          <!--/span-->
                                              <div class="col-md-4">
                                                   <div class="form-group">
                                                       <label>Mobile number:</label>
                                                       <input type="tel" pattern="[0-9]*" maxlength="11" minlength="10" required id="example-phone" name="cmob" class="form-control" placeholder="Enter your mobile number" data-error="Invalid mobile number">
                                                       <div class="help-block with-errors"></div>
                                                   </div>
                                               </div>
                                              <div class="col-md-4">
                                                   <div class="form-group">
                                                        <label>Email ID:</label>
                                                        <input class="form-control" name="cemail" type="email" required placeholder="Email" data-error="This email address is invalid">
                                                        <div class="help-block with-errors"></div>
                                                   </div>
                                              </div>
                                           </div>
                            
                                          <div  class="form-group">
                                              <center><button type="submit" name="psubmit" class="btn btn-rounded btn-lg btn-info">Submit</button></center>
                                         </div>
                                  </form>
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
    
    <!--    function(){
            swal("Deleted!", "User has been deleted.", "success");
            window.location.replace("view-doctors.php");     -->
</body>

</html>
<script>
$(document).ready(function() {
  $('.deleteStaff').click(function(){
    id = $(this).attr('data-id');
      swal({
          title: "Are you sure?",
          text: "You will not be able to recover this data!",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, delete it!",
          closeOnConfirm: false,
		  closeOnCancel: false
      },function(isConfirm)
		 {   
           if (isConfirm) {
			   $.ajax({
			  url: 'deletestaff.php?id='+id,
			  type: 'DELETE',
			  data: {id:id},
			  success: function(){
				swal("Deleted!", "User has been deleted.", "success");
				window.location.replace("view-staffs.php");
          }
        });   
            } else {     
                swal("Cancelled", "User data is safe :)", "error");   
            }
      });
  });

});
	
</script>
