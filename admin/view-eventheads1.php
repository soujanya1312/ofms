<?php
include '../login/accesscontroladmin.php';
require('connect.php');
$ausername=$_SESSION['admin'];

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
                        <h4 class="page-title">View Event Heads</h4>
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
                                            <h4 class="modal-title">Important Instruction</h4>
                                        </div>
                                        <div class="modal-body">
                                       	 To Edit Admin information or to delete Admin account you need to login to that admin account and go to "My Profile".
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
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Event Head Information</h3>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL NO</th>
                                            <th>Event NAME</th>
                                            <th>Event Head Name</th>
                                            <th>Mobile Number</th>
                                            <th>Email</th>
                                            <th>Event Head Username</th>
                                            <th>Actions</th>
                                           <!-- <th class="text-nowrap">Team Code</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
										<?php
												$sql = "SELECT eid,ename,addname,hname,hmob,hemail,husername  FROM events";
												$result = mysqli_query($connection,$sql);
												foreach($result as $key=>$result)
												{ ?>
													<tr> 
														<td> <?php echo $key+1; ?> </td>
														<td> <?php echo $result["ename"]; ?> </td>
                                                       <td> <?php echo $result["hname"]." ".$result["addname"]; ?> </td>
														<td> <?php echo $result["hmob"]; ?> </td>
                                                        <td> <?php echo $result["hemail"]; ?> </td>
                                                         <td> <?php echo $result["husername"]; ?> </td>
														<td><a class="btn btn-info btn-rounded" href="edit-eventhead-profile.php?id=<?php echo $result['eid']; ?>" target="_blank">Edit</a></td>
													</tr>
                                        <?php 
												}
										  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--/row -->
                
                <!--DNS End-->
                
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
</body>

</html>