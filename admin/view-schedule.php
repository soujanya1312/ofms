<?php
include '../login/accesscontroladmin.php';
require('connect.php');
$ausername=$_SESSION['admin'];
//$getfestidq="SELECT fid FROM admin WHERE ausername='$ausername'";
$getidquery="SELECT fests.fid FROM admin JOIN fests ON admin.aid=fests.aid WHERE ausername='$ausername'";
$getfestidr=mysqli_query($connection,$getidquery);
$getfestid = mysqli_fetch_assoc($getfestidr);
$fid=$getfestid['fid'];
?>

    
    

<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
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
                        <h4 class="page-title">Event Results</h4>
                    </div>
                    <!-- /.page title -->
                    <!-- .breadcrumb -->
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


                <!--row -->
                
                <div class="row">
                <?php
					$query = "SELECT * FROM events WHERE fid='$fid'";
					$result = mysqli_query($connection, $query);
					foreach($result as $key=>$result)
				{ 
					$eid=$result["eid"];
						
					$getpidquery="SELECT pid from participants WHERE pusername='$ausername'";
					$getpidres=mysqli_query($connection, $getpidquery);
					$row2 = mysqli_fetch_assoc($getpidres);
					$pid= $row2["pid"];

					$redirectquery="SELECT * FROM eventparticipants WHERE eid='$eid' and pid='$pid'";
					$exeredirect=mysqli_query($connection, $redirectquery);
					$redirect=mysqli_num_rows($exeredirect);
					
				?>
                <div class="col-md-4 col-sm-4">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                   	<img src="../plugins/images/sdmlogo.png" class="img-square img-responsive"> 
                                </div>
                              
                                <div class="col-md-8 col-sm-8">
                                    <b></b><h2 class="box-title m-b-0"><?php echo $result["ename"]; ?></h2></b>
                                    <p style="padding-bottom: 1px" > Rounds:<?php echo ' '.$result["erounds"]; ?> </p> 
									<div class="p-t-5 align-bottom:10px;">
                                        <a href="view-event-schedule.php?id=<?php echo $result["eid"]; ?>" class="btn btn-info btn-rounded">view schedule</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                  <?php
					}
				  ?>
                </div>
                
                <!--/row -->

                <!--DNS End-->
                <!-- .row -->
                <!--<div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title">Blank Starter page</h3>
                        </div>
                    </div>
                </div>-->
                <!-- /.row -->
                <!-- .right-sidebar -->
                 <!-- Removed Service Panel DNS-->
                <!-- /.right-sidebar -->
            </div>
            <!-- /.container-fluid -->
            <!--footer.php contains footer-->
            <?php include'assets/footer.php'; ?>
        </div>
        <!-- /#page-wrapper -->
   
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
			  url: 'delete-ehead.php?id='+id,
			  type: 'DELETE',
			  data: {id:id},
			  success: function(){
				swal("Deleted!", "User has been deleted.", "success");
				window.location.replace("view-eventheads.php");
          }
        });   
            } else {     
                swal("Cancelled", "User data is safe :)", "error");   
            }
      });
  });

});
	
</script>
