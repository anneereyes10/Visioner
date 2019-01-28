
<?php 
	include("includes/db.php"); 
	
	if(isset($_GET['user_id'])){
	
	$deny_id = $_GET['user_id'];
	
	$deny_upload = "update bd_upload set upload_status='Denied', upload_fee = '0' where user_id='$deny_id'"; 
	
	$run_deny = mysqli_query($con, $deny_upload); 

	
	if($run_deny){
	
	echo "<script>alert('House Plan of the user has been denied!')</script>";
	echo "<script>window.open('index.php?user_uploads','_self')</script>";
	}
	
	}





?>