<?php
$user = $_SESSION['user_email'];

$select_trans = "select * from transaction_type where user_email = '$user'";

$run_select = mysqli_query($con,$select_trans);

$row_select= mysqli_fetch_array($run_select);
$transaction=$row_select['transaction_type'];

if($transaction=="None")
{
?>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>
		tinymce.init({selector:'textarea'});
	</script>
<form method="post" action="" enctype="multipart/form-data">
<h4 class="info-text">Upload your own house plan.</h4>



				<label><b>Upload Your Image:</b></label>

				<input type="file" name="upload_image" required />
				<label><b>Insert Comments:</b></label>
				<textarea name="upload_comments" cols="10" rows="5"></textarea>
							<label><b>Select a meeting location</b></label>
							<small>*Fees may vary depending on location</small><br>
		<select name="select_loc" required>
		<option> </option>
		<?php 
			$get_loc = "select * from available_location";
						$run_loc = mysqli_query($con, $get_loc);
	
						while($row_loc=mysqli_fetch_array($run_loc))
						{
							$loc_name = $row_loc['loc_city'];
							echo "<option value='$loc_name'>$loc_name</option>";
						}
					?>
			</select>
		<br>
		<br>
                                                    <p>
                                                        <label><strong>Terms and Conditions</strong></label><br>
                                                        By accessing or using <strong>Visioner Design and Builders services</strong>, such as 
                                                        posting your personal information on our website you agree to the
                                                        collection, use and disclosure of your personal information 
                                                        in the legal proper manner.
                                                    </p>

												<div class="col-sm-offset-4">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" required /> <strong>I Accept the terms and conditions.</strong>
                                                        </label>
                                                    </div> 
												</div>
								<p>
                                                        <label><strong>Agreement</strong></label><br>
                                                        By uploading your house plan and upon Visioner's agreement on attending an appointment with you, <strong>you will be charged our appointment fee</strong>.
                                                    </p>
								<div class="col-sm-offset-4">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" required /> <strong>I Understand and Accept</strong>
                                                        </label>
                                                    </div> 
												</div>
												<br>
<?php
if(isset($_SESSION['user_email']))
{
	$user = $_SESSION['user_email'];
	$select_trans = "select * from transaction_type where user_email = '$user'";
	$run_select = mysqli_query($con,$select_trans);
	$row_select= mysqli_fetch_array($run_select);
	$type = $row_select['transaction_type'];
	
	if ($type == "None")
	{
?>
	<input type="submit" class='btn btn-finish btn-primary' name="apply" value="Apply for our Services" />

<?php
	}
	else
	{
?>
<p>Your currently have an ongoing transaction. Please check your transaction in your profile by clicking <a href="../user/user_account.php?check_transaction">here</a>.
<input type="submit" disabled class='btn btn-finish btn-primary' name="apply" value="Apply for our Services" />
<?php
	}
}
else
{ 
?>
<p> You Must be Logged In First! </p>
<input type="submit" disabled class='btn btn-finish btn-primary' name="apply" value="Apply for our Services" />
<?php 
} 
?>
</form>
<?php
}else
{?>
<p>Your transaction is currently being reviewed. Please check your transaction in your profile by clicking <a href="../user/user_account.php?check_transaction">here</a>.
<?php
}
	if(isset($_POST['upload']))
	{
		$user = $_SESSION['user_email'];
		$select_id = "select * from user_account where user_email = '$user'";
		$run_id = mysqli_query($con,$select_id);
		$row_id= mysqli_fetch_array($run_id);
		$user_id = $row_id['user_id'];
		
		$temp = explode(".", $_FILES["upload_image"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		move_uploaded_file($_FILES["upload_image"]["tmp_name"], "../administrator/user_house_plans/" . $newfilename);
		$u_comm = $_POST['upload_comments'];
		$u_loc = $_POST['select_loc'];
		
		$insert_upload= "insert into bd_upload(user_id,user_email,upload_img,upload_details,upload_location,upload_status,upload_date,upload_fee) values('$user_id','$user','$newfilename','$u_comm','$u_loc','Pending',NOW(),'TBD')";
		
		$update_transaction = "update transaction_type set transaction_type='Upload' where user_email ='$user'";
		
		$update_payment = "update payment_status set pay_status='Unpaid' where user_email = '$user'";
		
		$run_upload = mysqli_query($con, $insert_upload);
		$run_payment = mysqli_query($con, $update_payment);
		$run_update = mysqli_query($con, $update_transaction);
		if($run_upload and $run_update and $run_payment)
		{
			echo "<script>alert('Upload is successful! Please wait for our review on your house plan!')</script>";
			echo "<script>window.open('../user/user_account.php?check_transaction','_self')</script>";
		}
	}
?>



