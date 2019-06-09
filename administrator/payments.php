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
<div>
<form method="get" action="edit_payment.php" enctype="multipart/form-data">
<b>Payments Available to Customers</b>
					<select name="payment_type" required>
						<option>Select a Category</option>
						<?php
						$get_type = "select * from payment_type";
						$run_type = mysqli_query($con, $get_type);
	
						while($row_type=mysqli_fetch_array($run_type))
						{
							$p_type=$row_type['type'];
							echo "<option value='$p_type'>$p_type</option>";
						}
						?>
					</select>
<input type="submit" class='btn btn-finish btn-primary' name="edit" value="Edit Details" />
</form>
</div>
<div>				
<form action="" method="post" style="padding:80px;">
<b>Post a New Payment Type</b>
<br><br>
Payment Name: <input type="text" name="new_payment" placeholder="New Payment Type" required />
<textarea name="new_details" cols="20" rows="10"></textarea>
<input type="submit" name="insert_p" class='btn btn-finish btn-primary' value="Post New Payment Type" /> 

</form>
</div>

<?php

	if(isset($_POST['insert_p']))
	{
		$new_p = $_POST['new_payment'];
		$new_d = $_POST['new_details'];
		
		$insert_pay = "insert into payment_type(type,details) values('$new_p','$new_d')";
		
		$run_pay = mysqli_query($con, $insert_pay);
		
		if($run_pay)
		{
			echo "<script>alert('New Payment has been inserted!')</script>";
			echo "<script>window.open('index.php?payments','_self')</script>";
		}
	}

}?>