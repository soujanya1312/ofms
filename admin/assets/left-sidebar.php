<!-- Left navbar-sidebar -->
<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse slimscrollsidebar">
		<ul class="nav" id="side-menu">
			<li class="sidebar-search hidden-sm hidden-md hidden-lg">
				<!-- Search input-group this is only view in mobile -->
				<!--<div class="input-group custom-search-form">
					<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
				<button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
				</span>
				</div>-->
				<!-- / Search input-group this is only view in mobile-->
			</li>
			<!-- User profihle-->
			<li class="user-pro">
				<a href="#" class="waves-effect"><img src="../plugins/images/users/user(2).png" alt="user-img" class="img-circle"> <span class="hide-menu"><?php echo $ausername; ?><span class="fa arrow"></span></span>
				</a>
				<ul class="nav nav-second-level">
					<li><a href="my-profile1.php"><i class="ti-user"></i> My Profile</a></li>
					<!-- <li><a href="javascript:void(0)"><i class="ti-wallet"></i> My Balance</a></li>
					<li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
					<li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li> -->
					<li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
				</ul>
			</li>
			<!-- User profile-->
			<li class="nav-small-cap m-t-0 m-b-0"><!----- Main Menu--></li>
			<!---DNS Added Dashboard menu --->
			<li> <a href="index.php" class="waves-effect text-white"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu">Dashboard</span></a> </li>

			<!---DNS Added Staff menu 
			<li> <a href="javascript:void(0);" class="waves-effect text-white"><i class="fa fa-group p-r-10"></i> <span class="hide-menu"> Staffs <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li> <a href="add-staff.php">Add Staff</a> </li>
					<li> <a href="view-staffs.php">View Staff</a> </li>
				</ul>
			</li>

			<!---PNB Added Doctors menu --->
			<li> <a href="javascript:void(0);" class="waves-effect text-white"><i class="fa fa-id-badge p-r-10"></i> <span class="hide-menu"> Event Heads <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li> <a href="add-events.php">Add Event heads </a> </li>
					<li> <a href="view-eventheads.php">View Event heads </a> </li>
                    
				</ul>
			</li>
			<!---PNB Added Patient menu --->
			<li> <a href="javascript:void(0);" class="waves-effect text-white"><i class="fa fa-id-badge p-r-10"></i> <span class="hide-menu"> College Registered<span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
                   
					<li> <a href="view-colleges.php">Colleges Registered</a> </li>	
				</ul>
			</li>
            
            <li> <a href="javascript:void(0);" class="waves-effect text-white"><i class="fa fa-id-badge p-r-10"></i> <span class="hide-menu">Messages<span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li> <a href="view-schedule.php">Inbox</a> </li>
					<li> <a href="send-message.php">Compose</a> </li>
				</ul>
			</li>
			<li> <a href="javascript:void(0);" class="waves-effect text-white"><i class="fa fa-id-badge p-r-10"></i> <span class="hide-menu">Event Schedule<span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li> <a href="view-schedule.php">View Schedule</a> </li>
					
				</ul>
			</li>
            
			<li> <a href="javascript:void(0);" class="waves-effect text-white"><i class="fa fa-id-badge p-r-10"></i> <span class="hide-menu">Results<span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li> <a href="result1.php">add-results</a> </li>
					<li><a href="view-result.php">view-results</a></li>
				</ul>
			</li>
            
            <li> <a href="javascript:void(0);" class="waves-effect text-white"><i class="fa fa-id-badge p-r-10"></i> <span class="hide-menu">Feedback<span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li> <a href="view-feedback.php">view-feedback</a> </li>
				
				</ul>
			</li>
            <li> <a href="javascript:void(0);" class="waves-effect text-white"><i class="fa fa-id-badge p-r-10"></i> <span class="hide-menu"> Admin <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li> <a href="view-admin.php">view admin</a> </li>
				    <li> <a href="add-admin.php">add admin</a> </li>
				</ul>
			</li>
           
			<!--<li> <a href="view-appointments.php" class="waves-effect text-white"><i class="fa fa-calendar-o p-r-10"></i> <span class="hide-menu"> INDOX <span class="fa arrow"></span></a>
			</li>
			<li> <a href="javascript:void(0);" class="waves-effect text-white"><i class="fa fa-file-text p-r-10"></i> <span class="hide-menu">INDOX <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li> <a href="view-ip-bills.php">Send Message</a> </li>
					<li> <a target="_blank" href="op-invoice.php">Delete Message</a></li>
				</ul>
			</li>
		  <!--DNS Added Admin menu-->
		   <!--<li> <a href="javascript:void(0);" class="waves-effect text-white"><i class="fa fa-user p-r-10"></i> <span class="hide-menu"> Admin <span class="fa arrow"></span></span></a>
				<ul class="nav nav-second-level">
					<li> <a href="add-admin.php">Add Admin</a> </li>
					<li> <a href="view-admin.php">View Admins</a> </li>
				</ul>
			</li>-->
		   <!---PNB Added logout menu --->
			<li><a href="logout.php" class="waves-effect text-white"><i class="fa fa-spin fa-cog"></i> <span class="hide-menu p-l-10">BETA v 1.0</span></a></li>

		</ul>
	</div>
</div>
<!-- Left navbar-sidebar end --> 