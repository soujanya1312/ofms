<?php
include '../login/accesscontrolparticipant.php';
require('connect.php');
$ausername=$_SESSION['pusername'];
$id=$_GET['id'];
$squery="SELECT eid,ename,edesc,hname,addname,hmob,hemail,participants,erounds FROM events WHERE eid='$id'";
$sresult = mysqli_query($connection, $squery);
$row = mysqli_fetch_assoc($sresult);
$pari= $row["erounds"];

$rquery="SELECT teamcode from participants WHERE pusername='$ausername'";
$tresult=mysqli_query($connection,$rquery);
$prow=mysqli_fetch_assoc($tresult);
$team=$prow["teamcode"];
//echo $team;
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
             <?php
                for($x=1; $x<=$pari; $x++){ 
				$getresq="SELECT DISTINCT pname FROM results JOIN participants ON results.pname=participants.teamcode JOIN eventparticipants ON results.eid=eventparticipants.eid JOIN events ON results.eid=events.eid WHERE results.eid='$id' AND results.eround='$x' AND results.pname='$team'"; 
                $result = mysqli_query($connection, $getresq);
				$count = mysqli_num_rows($result);
                    $checkrundquery="SELECT * FROM results WHERE eround='$x' AND eid='$id'";
                    $checkrundqueryresult = mysqli_query($connection, $checkrundquery);
				    $count2 = mysqli_num_rows($checkrundqueryresult);
				?>
                 <div class="col-md-4 col-sm-4">
                        <div class="white-box <?php if($count2==0) echo 'bg-warning'; else { if($count>=1) echo 'bg-success'; else echo 'bg-danger'; }  ?> text-white">
                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                   	<img src="../plugins/images/users/event.png" class="img-circle img-responsive"> 
                                </div>
                              
                                <div class="col-md-8 col-sm-8">
                                    <h2>Round: <?php echo $x; ?></h2>
                                     <?php foreach($result as $key=>$result) { ?>
                                    <h4><span class="label label-dark"  style="padding-bottom: 1px">Qualified</span></h4>
                                     <?php }?>
                                   <?php if($count2==0) echo '<h4><span class="label label-dark"  style="padding-bottom: 1px" align:"left">Round not started</span></h4>'; else { if($count<1) echo '<h4><span class="label label-dark"  style="padding-bottom: 1px">Disqualified</span></h4>'; } ?>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                
                <?php } ?>
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
