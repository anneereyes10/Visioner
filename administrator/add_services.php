	<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>
		tinymce.init({selector:'textarea'});
	</script>
<?php

include("includes/db.php");
if(!isset($_SESSION['email'])){

	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
?>
<form action="" method="post" style="padding:80px;" enctype="multipart/form-data">
<b>Add a new available Service</b>
<br><br>
Name of Service <input type="text" name="new_service" placeholder="New Service Available" required /><br>
Add an Image: <input type="file" name="new_image" required />
<textarea name="new_details" cols="20" rows="10"></textarea><br>
Total Fee for Services: <input type="text" name="new_tsfee" placeholder="Input Here" required /><br>
<input type="submit" name="insert_s" class='btn btn-finish btn-primary' value="Add New Service" /> 

</form>


<?php

	if(isset($_POST['insert_s']))
	{
		$new_s = $_POST['new_service'];
		$new_d = $_POST['new_details'];
		$new_tsfee = $_POST['new_tsfee'];
		
		$temp = explode(".", $_FILES["new_image"]["name"]);
		
		$newfilename = round(microtime(true)) . '.' . end($temp);
		
		move_uploaded_file($_FILES["new_image"]["tmp_name"], "services/" . $newfilename);
		
		$insert_serv = "insert into services(service_name,service_details,serv_img,total_serv_fee) values('$new_s','$new_d','$newfilename','$new_tsfee')";
		
		$run_serv = mysqli_query($con, $insert_serv);
		
		if($run_serv)
		{
			echo "<script>alert('New Services has been added!')</script>";
			echo "<script>window.open('index.php?add_services','_self')</script>";
		}
	}
}
?>