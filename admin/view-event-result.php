<?php
include '../login/accesscontroladmin.php';
require('connect.php');
$ausername=$_SESSION['admin'];
$id=$_GET['id'];
$squery="SELECT eid,ename,edesc,hname,addname,hmob,hemail,participants,erounds FROM events WHERE eid='$id'";
$sresult = mysqli_query($connection, $squery);
$row = mysqli_fetch_assoc($sresult);
$pari= $row["erounds"];
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
                        <h4 class="page-title">Qualified Teams</h4>
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
                <!--row -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- <h4 class="box-title m-b-20">Qualified Teams</h4> -->
                        <div class="panel-group" role="tablist" aria-multiselectable="true">
                            <?php for($x=1; $x<=$pari; $x++) { ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading<?php echo $x ?>">
                                    <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $x ?>" aria-expanded="false" aria-controls="collapse<?php echo $x ?>" class="collapsed font-bold"> Round <?php echo $x ?> </a> </h4>
                                </div>
                                <div id="collapse<?php echo $x ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?php echo $x ?>">
                                    <div class="panel-body"> <?php $getresq="SELECT *, participants.pclgname FROM results JOIN participants ON results.pname=participants.teamcode WHERE eround='$x' AND eid='$id' "; $result = mysqli_query($connection, $getresq);     ?>
                        <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Team Name</th>
                                            <th>College</th>
                                            <!-- <th>Role</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($result as $key=>$result) { ?>
                                        <tr>
                                            <td><?php echo $key+1 ?></td>
                                            <td><span class="label label-success"><?php echo $result['pname'] ?></span></td>
                                            <td><?php echo $result['pclgname'] ?></td>
                                            <!-- <td>@Genelia</td> -->
                                            <!-- <td><span class="label label-danger">admin</span> </td> -->
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                     </div>
                                </div>
                            </div>
                            <?php } ?>
                        
                        </div>
                    </div>
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
