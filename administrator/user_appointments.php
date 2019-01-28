<?php 
//all of these codes are needed to secure the website that the user is logged in

session_start(); 

if(!isset($_SESSION['email'])){
	
	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {

?>
<!DOCTYPE html>
<html lang="en">

  <head>
	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>
		tinymce.init({selector:'textarea'});
	</script>
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
		<?php
			if(isset($_GET['user_id']))
			{
				
				include("../functions/functions.php");
				$u_id = $_GET['user_id'];
				
				$get_app = "select * from appointment where user_id='$u_id'";
				
				$run_app = mysqli_query($con, $get_app);

				while($row_app=mysqli_fetch_array($run_app))
				{
					$app_email=$row_app['user_email'];
					$app_stat=$row_app['appointment_status'];
					$app_date=$row_app['appointment_date'];
					$app_made=$row_app['appointment_made'];
					$u_msg=$row_app['user_msg'];
					

					?>
				Appointment Details for - <b><?php echo $app_email ?></b><br><br>
				Appointment Date Selected: <b><?php echo $app_date ?></b><br>
				Date Appointment was made: <b><?php echo $app_made ?></b><br><br>
				Appointment Status: <b><?php echo $app_stat ?><br></b><br>
				<b>User Comments: </b><?php echo $u_msg ?>
				<br>
				
				<form method="post" action="" enctype="multipart/form-data">
				<br><br><b>Change Status to: </b>
					<select name="app_change">
						<option>Change Status</option>
						<option>Approved</option>
						<option>Pending</option>
						<option>Declined</option>
					</select>
				<br><b>Comments:</b> <textarea name="a_msg" cols="10" rows="5"></textarea>
				<br><input type="submit" class='btn btn-finish btn-primary' name="app_post" value="Update" />
				</form>
				<?php
				if(isset($_POST['app_post']))
				{
					$u_id = $_GET['user_id'];
					$new_status=$_POST['app_change'];
					$new_comment=$_POST['a_msg'];

					$update_app = "update appointment set appointment_status='$new_status',admin_msg='$new_comment', user_msg=' ' where user_id='$u_id'";
					
					$run_update = mysqli_query($con, $update_app); 
					
					if($run_update)
					{
						echo "<script>alert('Appointment status has been updated!')</script>";
						echo "<script>window.open('index.php?view_customers','_self')</script>";
					}
				}
				?>
			<?php 
				}
			}
			?>
        </div>
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


<?php } ?>