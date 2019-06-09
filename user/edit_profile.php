<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Payment.php");
require_once ("../App_Code/PaymentType.php");
require_once ("../App_Code/Place.php");
require_once ("../App_Code/UploadPlace.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/Project.php");
include("../functions/functions.php");
include("../includes/db.php");

if (empty($_SESSION['uid'])) {
  header("Location: ../index.php?login");
  die();
}

$user = $_SESSION['user_email'];

$get_pro = "select * from user_account where user_email='$user'";

$run_pro=mysqli_query($con,$get_pro);

$row_pro=mysqli_fetch_array($run_pro);

$u_id=$row_pro['user_id'];
$name=$row_pro['full_name'];
$add=$row_pro['address'];
$date=$row_pro['birthdate'];
$cont=$row_pro['contact'];
$gend=$row_pro['gender'];
?>

<!DOCTYPE>
<html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Visioner Design and Builders | My Profile</title>
	<meta name="description" content="Visioner Design and Builders">
	<meta name="author" content="Visioner">
	<meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , bootstrap template">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	<link rel="icon" href="../favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="../assets/css/normalize.css">
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/css/fontello.css">
	<link href="../assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
	<link href="../assets/fonts/icon-7-stroke/css/helper.css" rel="stylesheet">
	<link href="../assets/css/animate.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="../assets/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/icheck.min_all.css">
	<link rel="stylesheet" href="../assets/css/price-range.css">
	<link rel="stylesheet" href="../assets/css/owl.carousel.css">
	<link rel="stylesheet" href="../assets/css/owl.theme.css">
	<link rel="stylesheet" href="../assets/css/owl.transitions.css">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="stylesheet" href="../assets/css/responsive.css">
	<!-- Page level plugin CSS-->
	<link href="styles/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<script type="text/javascript" src="../JumEE/js/payment.js"></script>


	<!-- Page level plugin CSS-->


	<!-- <link rel="stylesheet" href="../assets/user-area.css" media="all" />
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker3.css" rel="stylesheet" id="bootstrap-css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
	<style>
		.isError {
			border: 1px solid red;
		}
	</style>
</head>

<body>

	<div id="preloader">
		<div id="status">&nbsp;</div>
	</div>
	<!-- Body content -->

	<div class="header-connect">
		<div class="container">
			<div class="row">
				<div class="col-md-5 col-sm-8  col-xs-12">
					<div class="header-half header-call">
						<p>
							<span><i class="pe-7s-call"></i> (02) 423 4351 </span>
							<span><i class="pe-7s-mail"></i> visioneridesign@gmail.com</span>
						</p>
					</div>
				</div>
				<div class="col-md-2 col-md-offset-5  col-sm-3 col-sm-offset-1  col-xs-12">
					<div class="header-half header-social">
						<ul class="list-inline">
							<li><a href="https://www.facebook.com/Visioner-Design-and-Builders-432801973461175/"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--End top header -->

	<nav class="navbar navbar-default ">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="../index.php?home"><img src="../assets/img/logo.png" alt=""></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse yamm" id="navigation">
				<div class="button navbar-right">

					<?php
			          if(isset($_SESSION['user_email']))
			          {
			          ?>
					<div class="btn-group">
						<button class="navbar-btn nav-button wow bounceInRight login" onclick="window.open('logout.php', '_self')" data-wow-delay="0.4s">Logout</button>
					</div>
					<div class="btn-group">
						<button class="main-nav navbar-btn nav-button wow bounceInRight login dropdown-toggle active" data-toggle="dropdown" data-hover="dropdown" data-wow-delay="0.5s">Account<b class="caret"></b></button>
						<ul class="dropdown-menu">
							<li><a href="edit_profile.php">Edit Information</a></li>
							<li><a href="payment.php">Check Transaction</a></li>
							
							<li><a href="change_password.php">Change Password</a></li>
							<li><a href="logout.php">Logout</a></li>
						</ul>
					</div>
					<?php
			          }else{
			          ?>
					<div class="btn-group">
						<button class="navbar-btn nav-button wow bounceInRight login" onclick="window.open('../index.php?login', '_self')" data-wow-delay="0.4s">Login</button>
					</div>
					<div class="btn-group">
						<button class="navbar-btn nav-button wow bounceInRight login" onclick=" window.open('../index.php?login', '_self')" data-wow-delay="0.5s">Account</button>
					</div>
					<?php
			          }
			          ?>
					<div class="btn-group">
						<button class="navbar-btn nav-button wow fadeInRight" onclick=" window.open('../builddesign/customization.php', '_self')" data-wow-delay="0.5s">Start Design & Build</button>
					</div>
				</div>
				<ul class="main-nav nav navbar-nav navbar-right">
					<li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="../index.php?about">About</a></li>
					<li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="../services.php">Services</a></li>
					<li class="wow fadeInDown" data-wow-delay="0.1s"><a class="" href="../index.php?gallery">Gallery</a></li>
					<li class="wow fadeInDown" data-wow-delay="0.4s"><a href="../index.php?contact">Contact</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	<!-- End of nav bar -->


	<div class="page-head">
		<div class="container">
			<div class="row">
				<div class="page-head-content">
					<h1 class="page-title">My Account</h1>
				</div>
			</div>
		</div>
	</div>
	<!--paayos part na to -->
	<div class="properties-area recent-property" style="background-color: #FFF;">
		<div class="container">


			<div>
				<!--laman ng icclick sa sidebar-->


				<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>





				<div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-offset-1 profiel-container">

				<form action="" method="post" enctype="multipart/form-data">
					<div class="profiel-header">
						<h3>
							<b>UPDATE</b> YOUR INFORMATION <br>
							<small>This information will let us know more about you.</small>
						</h3>
						<hr>
					</div>
					<div class="clear">
						<br>
						<hr>
						<br>
						<div class="col-sm-5 col-sm-offset-1">

							<div class="form-group">
								<label>Full Name :</label>
								<input type="text" class="form-control" name="fullname" required placeholder="Full Name" value="<?php echo $name; ?>" />
							</div>
							<div class="form-group">
								<label>Birthdate :</label>
									<input type='date' class="form-control" name="birthday" required value="<?php echo $date; ?>" />
							</div>
							<div class="form-group">
								<label>Address:</label>
								<input type="text" class="form-control" placeholder="Address" required name="address" value="<?php echo $add;?>" />
							</div>
						</div>

						<div class="col-sm-5">
							<div class="form-group">
								<label>Contact Number : (+63) </label>
								<input type="number" class="form-control" placeholder="Contact Number" required name="contact" value="<?php echo $cont; ?>">
							</div>
							<div class="form-group">
								<label>Gender: </label>
								<br><div class="well">
								<input type="radio" name="gender" <?php if (isset($gend) && $gend=="female" ) echo "checked" ;?>
								value="female">Female
								<input type="radio" name="gender" <?php if (isset($gend) && $gend=="male" ) echo "checked" ;?>
								value="male">Male
								<input type="radio" name="gender" <?php if (isset($gend) && $gend=="other" ) echo "checked" ;?>
								value="other">Other
							</div></div>
						</div>


					</div>

					<div class="col-sm-5 col-sm-offset-5">
						<br>
						<input type="submit" class='btn btn-finish btn-primary' name="edit" value="Edit Information" />
					</div>
					<br>
				</form>

			</div>
		</div><!-- end row -->

	</div>
</div>
			</div>
		</div>
	</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content" id="modalContent">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

	<?php include 'footer.php'; ?>
	<script src="../assets/js/modernizr-2.6.2.min.js"></script>

	<script src="../assets/js/jquery-1.10.2.min.js"></script>
	<script src="../bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/js/bootstrap-select.min.js"></script>
	<script src="../assets/js/bootstrap-hover-dropdown.js"></script>

	<script src="../assets/js/easypiechart.min.js"></script>
	<script src="../assets/js/jquery.easypiechart.min.js"></script>

	<script src="../assets/js/owl.carousel.min.js"></script>
	<script src="../assets/js/wow.js"></script>

	<script src="../assets/js/icheck.min.js"></script>
	<script src="../assets/js/price-range.js"></script>

	<script src="../assets/js/main.js"></script>

	<script type="text/javascript" src="../JumEE/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="../JumEE/js/dataTables.bootstrap4.min.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
	<script>
		$(function() {
			$('#datepicker').datepicker({
				format: "yyyy-mm-dd",
				autoclose: true,
				todayHighlight: true,
				showOtherMonths: true,
				selectOtherMonths: true,
				autoclose: true,
				changeMonth: true,
				changeYear: true,
				orientation: "button"
			});
		});
	</script>

	<script>
		$(document).ready(function() {
			$('#example').DataTable();

		});
	</script>

</body>

</html>

<?php

	if(isset($_POST['edit']))
	{
		$ip = getIP();
		$id = $u_id;

		$new_name= $_POST['fullname'];
		$new_add= $_POST['address'];
		$new_date= $_POST['birthday'];
		$new_cont= $_POST['contact'];
		$new_gend= $_POST['gender'];

		 $update_user = "update user_account set full_name='$new_name',birthdate='$new_date',contact='$new_cont',address='$new_add',gender='$new_gend' where user_id='$id'";

		 $run_user = mysqli_query($con, $update_user);

		 if($run_user){

		 echo "<script>alert('Account has been updated!')</script>";

		 echo "<script>window.open('edit_profile.php','_self')</script>";

		 }
	}

?>

