<?php
include '../accesscontroladmin.php';
require('../../admin/connect.php');
if(isset($_SESSION['admin']))
{
	$ausername=$_SESSION['admin'];
}

date_default_timezone_set('Asia/Kolkata');
$now = date('Y-m-d H:i:s');

$getunread="SELECT * FROM messages WHERE (to_name='$ausername') AND (user_read='0')";
$getunreadresult=mysqli_query($connection,$getunread);
$countunread=mysqli_num_rows($getunreadresult);


if(isset($_POST['msgsubmit']))
{
	$msg=mysqli_real_escape_string($connection,$_POST['msg']);
	if(!$msg=="")
	{
		$from=$ausername;
		//$to=mysqli_real_escape_string($connection,$_POST['to_uname']);
		$subject=mysqli_real_escape_string($connection,$_POST['subject']);
		
		$user_read="0";
		//$timestamp= time();
		//$timeconverted=date('Y-m-d H:i:s',$timestamp);
		$inputmsg="INSERT INTO `messages` (from_name, msg_subject, msg_body, timestamp) VALUES ('$from','$subject','$msg','$now')";
		$inputresult=mysqli_query($connection,$inputmsg);
		if($inputresult)
		{
			$smsg="Message sent successfully";
		}
	}
	else
	{
		$fmsg="Message is empty!";
	}
	
}




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
    <?php include '../../eventhead/assets/csslink.php'; ?>
	<!-- Dropzone css -->
    <link href="../../plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />
	<!-- wysihtml5 CSS -->
    <link rel="stylesheet" href="../../plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" />
	<link href="../../plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
</head>

<body class="fix-sidebar">
     <!--header.php includes preloader, top navigarion, logo, user dropdown-->
    <!--div id wrapper in header.php-->
    <!--left-sidebar.php includes mobile search bar, user profile, menu-->
    <?php include '../../eventhead/assets/header.php';
	include '../../eventhead/assets/left-sidebar.php';
	include '../../eventhead/assets/breadcrumbs.php';
	?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <!-- .page title -->
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Compose Message</h4>
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
                <!--row -->
                <div class="row">
					
                    <!-- Left sidebar -->
                    <div class="col-md-12">
						<?php if(isset($smsg)) { ?>
									<div class="alert alert-success alert-dismissable text-uppercase font-bold">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										 <?php echo $smsg; ?>
									</div> 
							<?php } ?>
						<?php if(isset($fmsg)) { ?>
									<div class="alert alert-danger alert-dismissable text-uppercase font-bold">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										 <?php echo $fmsg; ?>
									</div> 
							<?php } ?>
                        <div class="white-box">
                            <div class="row">
                                <div class="col-lg-2 col-md-3  col-sm-4 col-xs-12 inbox-panel">
                                    <div> <a href="../../eventhead/compose-message.php" class="btn btn-custom btn-block waves-effect waves-light">Compose</a>
                                        <div class="list-group mail-list m-t-20">
											<a href="../../eventhead/inbox.php" class="list-group-item">Inbox <span class="label label-rouded label-success pull-right"><?php echo $countunread; ?></span></a>
										
											<a href="sent-message.php" class="list-group-item">Sent Messages</a> 
										</div>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 mail_listing">
                                    <h3 class="box-title">Compose New Message</h3>
									<?php
											$selectfloorG="SELECT husername FROM events ";
											
											$resultssG = mysqli_query($connection, $selectfloorG);
											
											
									?>
									<form method="post" data-toggle="validator">
                                
                                     <div class="form-group">
                                        <input maxlength="45" required name="subject" class="form-control" placeholder="Subject:">
                                    </div> 
                                    <div class="form-group">
                                        <textarea style="font-weight: normal" required class="textarea_editor form-control" rows="15" placeholder="Enter text ..." name="msg"></textarea>
                                    </div>
									
                                    <!--<h4><i class="ti-link"></i> Attachment</h4>
                                    <form action="#" class="dropzone">
                                        <div class="fallback">
                                            <input name="file" type="file" multiple />
                                        </div>
                                    </form>-->
                                    <hr>
                                    <button type="submit" name="msgsubmit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
                                    <button class="btn btn-default" type="reset"><i class="fa fa-times"></i> Clear</button>
									</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--/row -->

                
                <!-- /.row -->
                
            </div>
            <!-- /.container-fluid -->
            <!--footer.php contains footer-->
            <?php include'../../eventhead/assets/footer.php'; ?>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!--jslink has all the JQuery links-->
    <?php include'../../eventhead/assets/jslink.php'; ?>
	<script src="../../plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="../../plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
    <script src="../../plugins/bower_components/dropzone-master/dist/dropzone.js"></script>
    <script>
    $(document).ready(function() {

        $('.textarea_editor').wysihtml5();

    });
    </script>
	<script src="../../plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    
    <!--    function(){
            swal("Deleted!", "User has been deleted.", "success");
            window.location.replace("view-doctors.php");     -->
</body>

</html>
<script>
$(document).ready(function() {
  $('.deleteDoctor').click(function(){
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
			  url: 'delete.php?id='+id,
			  type: 'DELETE',
			  data: {id:id},
			  success: function(){
				swal("Deleted!", "User has been deleted.", "success");
				window.location.replace("view-doctors.php");
          }
        });   
            } else {     
                swal("Cancelled", "User data is safe :)", "error");   
            }
      });
  });

});
	
</script>
