<?php
include '../login/accesscontrolparticipant.php';
require('connect.php');
$ausername=$_SESSION['pusername'];
$id=$_GET['id'];

$squery="SELECT eid,ename,edesc,hname,addname,hmob,hemail, participants FROM events WHERE eid='$id'";
$sresult = mysqli_query($connection, $squery);
$row = mysqli_fetch_assoc($sresult);
$pari= $row["participants"];

$getpidquery="SELECT pid from participants WHERE pusername='$ausername'";
$getpidres=mysqli_query($connection, $getpidquery);
$row2 = mysqli_fetch_assoc($getpidres);
$pid= $row2["pid"];

$redirectquery="SELECT * FROM eventparticipants WHERE eid='$id' and pid='$pid'";
$exeredirect=mysqli_query($connection, $redirectquery);
$redirect=mysqli_num_rows($exeredirect);
if($redirect>0)
{
	//$fmsg="WARNING ANYA DO A EDIT REGISTERED EVENT PAGE COZ PARTICIPENTS ARE ALREDY REGISTERED FOR THIS EVENT";
	//echo'<script> window.location="403.php";</script>';
}

if (isset($_POST['psubmit']))

	{
		for($y=1; $y<=$pari; $y++)
		{
            $getid=$_POST['cid'.$y.''];
			$p1=$_POST['cname'.$y.''];
			$epmob=$_POST['cmob'.$y.''];
			$epemail=$_POST['cemail'.$y.''];
			$query="UPDATE eventparticipants SET epname='$p1', epmob='$epmob', epemail='$epemail' WHERE ep_id='$getid'";
			$result = mysqli_query($connection, $query);
			if($result)
			{
				$smsg = " Participants are registered For the Event";
			}
			else
			{
				 $fmsg="Error".mysqli_error($connection);
			}
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
<!--    enable fieldset js-->
    <script>
        function undisableField() {
  document.getElementById("myFieldset").disabled = false;
document.getElementById("mybutton1").removeAttribute("hidden");
document.getElementById("mybutton").setAttribute("hidden", true);
}
    </script>
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
							<img id="theImgId" class="card-img" src="../plugins/images/cards/bg.png" height="200" alt="Card image">
				           <div class="card-img-overlay" style="padding-top: 5px">
								
								
								  <p class="card-text" id="cText">Event Name: <strong><?php echo $row["ename"]; ?></strong></p>
                               
                                  <p class="card-text" id="cText">Event Description: <strong> <?php echo $row["edesc"]; ?></strong></p>
                               
                                  <p class="card-text" id="cText">No of contestants:<strong> <?php echo $row["participants"]; ?></strong> </p>
                               
                                  <p class="card-text" id="cText">Event Heads: <strong> <?php echo $row["hname"].' '.$row["addname"]; ?></strong> </p>
                               
                                  <p class="card-text" id="cText">Mobile Number: <strong><?php echo $row["hmob"]; ?></strong></p>
                               
                                  <p class="card-text" id="cText">Email ID: <strong><?php echo $row["hemail"]; ?></strong> </p>
								  <!--<p class="card-text"><small class="text-white">~OFMS</small></p>-->
				           </div>
				     </div>
				</div>
             </div>
              
                <!--row -->
          <div class="row">
                <div class="col-md-12">
                      <div class="white-box">
                            <h3 class="box-title m-b-0">Enter Participant Details</h3><hr>
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
                                     <fieldset id="myFieldset" disabled="true">
									 <?php foreach($exeredirect as $key=>$exeredirect)  {  ?>
                                       <div class="row">
                                          <!--/span-->
                                             <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label>Contestant <?php echo $key+1; ?> Name:</label>
                                                    <input name="cname<?php echo $key+1; ?>" type="text" class="form-control" value="<?php echo $exeredirect["epname"] ?>" placeholder="Enter the name" required>
                                                  </div>
                                              </div>
                                          <!--/span-->
                                              <div class="col-md-4">
                                                   <div class="form-group">
                                                       <label>Mobile number:</label>
                                                       <input type="tel" pattern="[0-9]*" maxlength="11" minlength="10" id="example-phone" value="<?php echo $exeredirect["epmob"] ?>" name="cmob<?php echo $key+1; ?>" class="form-control" placeholder="Enter your mobile number" data-error="Invalid mobile number">
                                                       <div class="help-block with-errors"></div>
                                                   </div>
                                               </div>
                                              <div class="col-md-4">
                                                   <div class="form-group">
                                                        <label>Email ID:</label>
                                                        <input class="form-control" name="cemail<?php echo $key+1; ?>" type="email" value="<?php echo $exeredirect["epemail"] ?>" placeholder="Email" data-error="This email address is invalid">
                                                        <div class="help-block with-errors"></div>
                                                   </div>
                                              </div>
                                           </div>
                                     
                                     <input name="cid<?php echo $key+1; ?>" type="hidden" class="form-control" value="<?php echo $exeredirect["ep_id"]; ?>" >
                            <?php } ?>
                                         </fieldset>
                                          <div  class="form-group">
                                              <center>
                                                  <button id="mybutton1" hidden="true" type="submit" name="psubmit" class="btn btn-rounded btn-lg btn-info">Submit</button>
                                                  <button type="button" onClick="undisableField()" id="mybutton" class="btn btn-rounded btn-lg btn-info">Edit</button>
                                              </center>
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
