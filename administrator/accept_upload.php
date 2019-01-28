
<?php 
	include("includes/db.php"); 
	
	if(isset($_GET['accept'])){
	
	$accept_email = $_GET['accmail'];
	$fee = $_GET['accfee'];
	
	$accept_upload = "update bd_upload set upload_status='Accepted', upload_fee = '$fee' where user_email='$accept_email'"; 
	
	$run_accept = mysqli_query($con, $accept_upload); 
	
	if($run_accept){
	
	echo "<script>alert('House Plan of the user has been approved!')</script>";
	echo "<script>window.open('index.php?user_uploads','_self')</script>";
	}
	
	}





?>