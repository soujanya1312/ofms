<?php
include '../accesscontroladmin.php';
require('../../admin/connect.php');
$ausername=$_SESSION['admin'];
$id=$_GET['id'];
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
    <?php include '../../admin/assets/csslink.php'; ?>
</head>

<body class="fix-sidebar">
     <!--header.php includes preloader, top navigarion, logo, user dropdown-->
    <!--div id wrapper in header.php-->
    <!--left-sidebar.php includes mobile search bar, user profile, menu-->
    <?php include '../../admin/assets/header.php';
	include '../../admin/assets/left-sidebar.php';
	include '../../admin/assets/breadcrumbs.php';
	?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Qualified Teams</h4>
                    </div>
                    <!-- /.page title -->
                    <!-- .breadcrumb -->
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                       <a href="../../index.php" target="_blank" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Home</a>
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
                                            <a href="../../admin/logout.php" class="btn btn-danger waves-effect waves-light">Proceed for login</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         <!--DNS model END-->


                <!--row -->
                <div class="row">
                <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingOne">
                                                    <h5 class="mb-0">
                                            <a data-toggle="collapse" data-parent="#accordion2" href="#collapse1" aria-expanded="true" aria-controls="collapseOne">
                                              Collapsible Group Item #1
                                            </a>
                                          </h5>
                                                </div>
                                                <div id="collapse1" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingTwo">
                                                    <h5 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse2" aria-expanded="false" aria-controls="collapseTwo">
                                              Collapsible Group Item #2
                                            </a>
                                          </h5>
                                                </div>
                                                <div id="collapse2" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingThree">
                                                    <h5 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse3" aria-expanded="false" aria-controls="collapseThree">
                                              Collapsible Group Item #3
                                            </a>
                                          </h5>
                                                </div>
                                                <div id="collapse3" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                                    <div class="card-body">
                                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
</div>
                <div class="row">
                <?php
//                    $getidquery="SELECT events.eid FROM admin JOIN events ON admin.eid=events.eid WHERE ausername='$ausername'";
//                     $getidresult = mysqli_query($connection, $getidquery);
//                     $getidrow = mysqli_fetch_assoc($getidresult);
//                     $eid=$getidrow['eid'];
                    
					$query = "SELECT r_id,pname,eround, events.ename FROM results JOIN events ON results.eid=events.eid WHERE events.eid='$id'";
					$result = mysqli_query($connection, $query);
					foreach($result as $key=>$result)
				{ ?>
                <div class="col-md-4 col-sm-4">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 text-center">
                                    <a href="../../admin/edit-staff-profile.php?id=<?php echo $result["r_id"]; ?>"> <img src="../../plugins/images/sdmlogo.png" class="img-square img-responsive"> </a>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <h3 class="box-title m-b-0"><?php echo $result["ename"]; ?></h3>
                                    <big>Round: <?php echo $result["eround"]; ?></big><br>
                                    <big>teamname: <?php echo $result["pname"]; ?></big>
                                   
									
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
            <?php include'../../admin/assets/footer.php'; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!--jslink has all the JQuery links-->
    <?php include'../../admin/assets/jslink.php'; ?>
    
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
			  url: 'delete-schedule.php?id='+id,
			  type: 'DELETE',
			  data: {id:id},
			  success: function(){
				swal("Deleted!", "User has been deleted.", "success");
				window.location.replace("view-schedule.php");
          }
        });   
            } else {     
                swal("Cancelled", "User data is safe :)", "error");   
            }
      });
  });

});
	
</script>
