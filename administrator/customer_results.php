<?php 
//all of these codes are needed to secure the website that the user is logged in

if(!isset($_SESSION['email'])){

	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator Account for Visioner Design and Builders</title>

    <!-- Bootstrap core CSS-->
    <link href="styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="styles/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="styles/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="styles/css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Administrator Panel</a>
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
<div class="input-group-append"> </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
         <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          </a>
          
        </li>
		
		<!-- //////////// -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
       <ul class="sidebar navbar-nav">
	  
        <!-- Start Dropdown Menu for Payments -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Payments</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Pending Payments</h6>
            <a class="dropdown-item" href="index.php?new_payments">New Payments</a>
			<a class="dropdown-item" href="index.php?pending_payments">Unpaid Customers</a>
			<div class="dropdown-divider"></div>
			<h6 class="dropdown-header">Finished Payments</h6>
			<a class="dropdown-item" href="index.php?paid_payments">Paid Customers</a>
            <div class="dropdown-divider"></div>
			<h6 class="dropdown-header">Manage Payments</h6>
            <a class="dropdown-item" href="index.php?payments">Modify Payments</a>
          
          </div>
        </li>
		<!-- End Dropdown Menu for Payments -->
		
		<!-- Start Dropdown Menu for Appointments -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Appointments</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Pending Appointments</h6>
            <a class="dropdown-item" href="index.php?new_appointments">New Appointments</a>
            <a class="dropdown-item" href="index.php?pending_appointments">Pending Appointments</a>
			 <div class="dropdown-divider"></div>
			<h6 class="dropdown-header">Finished Appointments</h6>
			<a class="dropdown-item" href="index.php?fin_appointments">Finished Appointments</a>
            <div class="dropdown-divider"></div>
			<h6 class="dropdown-header">Manage Appointments</h6>
            <a class="dropdown-item" href="index.php?modify_calendar">Modify Appointments</a>
          
          </div>
        </li>
		<!-- menu for services -->
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Services</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Manage</h6>
			<a class="dropdown-item" href="index.php?add_services">Add Services</a>
			
          </div>
        </li>
		<!--  Dropdown Menu for D&B -->
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Design & Build</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Builds</h6>
			<div class="dropdown-divider"></div>
			<h6 class="dropdown-header">User Submissions</h6>
			<a class="dropdown-item" href="index.php?new_uploads">New Uploads</a>
			<a class="dropdown-item" href="index.php?user_uploads">All Uploads</a>
          </div>
        </li>
		<!--  Dropdown Menu for Customers -->
		 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Customers</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Manage Customers</h6>
            <a class="dropdown-item" href="index.php?view_customers">View All Customers</a>
            <a class="dropdown-item" href="index.php?search_customers">Search for a Customer</a>
          </div>
        </li>
		</ul>
      <div id="content-wrapper">

        
        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Search Results</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<tr align="right">
						<td colspan="6"><h4>Search for a Customer:</h4>
						<form method="get" action="customer_results.php" enctype="multipart/form-data">
						<input type="text" class="form-control" placeholder="Name/Email" name="query"/>
						<br>
						<input type="submit" class='btn btn-finish btn-primary' name="search" value="Search" />
						</form>
						</td> 
					</tr>

                    <tr align="center">
                      <th>Name</th>
					  <th>Email</th>
					  <th>Contact No.</th>
					  <th>Other Details </th>
					  <th>Payment Status</th>
					  <th>Appointment Status</th>
                    </tr>

					<?php 
						include("includes/db.php");
						$search_query = $_GET['query'];
						$get_c = "select * from 
								  user_account
								  inner join payment_status
								  on user_account.user_id = payment_status.user_id
								  inner join appointment 
								  on payment_status.user_id = appointment.user_id 
								  where user_account.user_email like '%$search_query%'";
						$run_c = mysqli_query($con, $get_c); 
	
	$i = 0;
	while ($row_c=mysqli_fetch_array($run_c)){
		

		$c_id=$row_c['user_id'];
		$c_name = $row_c['full_name'];
		$c_email = $row_c['user_email'];
		$c_cont = $row_c['contact'];
		$c_gend = $row_c['gender'];
		$c_bd = $row_c['birthdate'];
		$c_add = $row_c['address'];
		$p_id=$c_id;
		$p_type=$row_c['type_selected'];
		$p_status=$row_c['pay_status'];
		$p_dp=$row_c['date_paid'];
		$a_id=$c_id;
		$a_status=$row_c['appointment_status'];
		$a_ds=$row_c['appointment_date'];
		$a_dm=$row_c['appointment_made'];
		$i++;

	
	?>
	<tr align="center">

		<td><?php echo $c_name;?></td>
		<td><?php echo $c_email;?></td>
		<td><?php echo $c_cont;?></td>
		<td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#userModal<?php echo $i ?>">Show</button></td>
		<td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#payModal<?php echo $i ?>">View</button></td>
		<td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#appointModal<?php echo $i ?>">View</button></td>
	</tr>
		<div class="modal fade" id="userModal<?php echo $i ?>" role="dialog">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Info for <?php echo $c_name ?></h4>
		</div>
		<div class="modal-body">
		  <p>
		  Name: <?php echo $c_name ?>
		  </p>
		  <p>
		  Email: <?php echo $c_email ?>
		  </p>
		  <p>
		  Contact #: <?php echo $c_cont ?>
		  </p>
		  <p>
		  Gender: <?php echo $c_gend ?>
		  </p>
		  <p>
		  Birthdate: <?php echo $c_bd ?>
		  </p>
		  <p>
		  Address: <?php echo $c_add ?>
		  </p>
		</div>
		<div class="modal-footer">
		  <button type="button' class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	</div>
</div>
<div class="modal fade" id="payModal<?php echo $i ?>" role="dialog">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Info for <?php echo $c_email ?></h4>
			</div>
			<div class="modal-body">
				<p>
				Payment Type Selected: <?php echo $p_type ?>
				</p>
				<p>
				Payment Status: <?php echo $p_status ?>
				</p>
				<p>
				Date Paid: <?php echo $p_dp ?>
				</p>
			</div>
		<div class="modal-footer">
		  <button type="button' class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	</div>
</div>
<div class="modal fade" id="appointModal<?php echo $i ?>" role="dialog">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title">Info for <?php echo $c_email ?></h4>
			</div>
			<div class="modal-body">
				<a href="user_appointments.php?user_id=<?php echo $user_id?>">Change Status</a>
				<p>
				<strong>Appointment Made on: </strong><br><?php echo $a_dm ?>
				</p>
				<p>
				Appointment Date Selected: <?php echo $a_ds ?>
				</p>
				<p>
				Appointment Status: <?php echo $a_status ?>
				</p>
			</div>
		<div class="modal-footer">
		  <button type="button' class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	</div>
</div>
<?php } ?>
</table>
              </div>
            </div>
          </div>

          

        </div>
        <!-- /.container-fluid -->




        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="styles/vendor/jquery/jquery.min.js"></script>
    <script src="styles/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="styles/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="styles/js/sb-admin.min.js"></script>

  </body>

</html>

<?php  }?>