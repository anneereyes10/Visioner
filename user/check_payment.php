<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Payment.php");

$msg = "";
$err = "";

if(isset($_POST['Project'])){

	$err .= $clsFn->setForm('Payment',$mdlPayment,true);
	// $err .= $clsFn->setForm('Description',$mdlLayout,true);

	if($err == ""){
		$duplicate = $clsPayment->IsExist($mdlPayment);
		if($duplicate['val']){
			$msg .= '
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Duplicate of Information Detected. </h4>
			'.$duplicate['msg'].'
			</div>';
		}else{
			$paymentId = $clsPayment->Add($mdlPayment);
			$msg .= '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h6>
					Successfully Added New Layout.
				</h6>
				</div>
			     ';
			$imgResult = $clsPayment->SetImage($_FILES["fileToUpload"],$paymentId);
			if($imgResult['msg'] != ""){
				$msg .= '
				<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h4>Image Upload Failed </h4>
				'.$imgResult['msg'].'
				</div>';
			}
			// Clear all data if success
			$mdlPayment = new PaymentModel();
		}
	}else{
		$msg .= '
		<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
		<span class="sr-only">Close</span>
		</button>
		<h4>Please Complete All Required Fields. </h4>
		'.$err.'
		</div>';
	}
}
 ?>

<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>





	<div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 profiel-container">
<br>



 <form action="" method="post" enctype="multipart/form-data">
                            <div class="profiel-header">
                                <h3>
									<b>MY</b> PAYMENTS</b></h4></ul>
								<br>
								</h3>
                                <hr>
                            </div>



<?php
$user = $_SESSION['user_email'];
$select_pay = "select * from payment_status where user_email = '$user'";
$run_select = mysqli_query($con,$select_pay);
$row_select= mysqli_fetch_array($run_select);

$status=$row_select['type_selected'];
$img=$row_select['payment_image'];
$approval=$row_select['pay_status'];
$admin_comm=$row_select['admin_comments'];
if($status == "None")
{
?>
<form method="post" action="" enctype="multipart/form-data">
<b>Select mode of payment: </b> <br>
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
					</select><br><br>
<button type="submit" class='btn btn-primary btn-sm' name="sel_p"/>Confirm </button>
</form>
<?php

	if(isset($_POST['sel_p']))
	{
		$user = $_SESSION['user_email'];

		$sel_p = $_POST['payment_type'];
		$update_p = "update payment_status set type_selected='$sel_p', pay_status='Pending' where user_email='$user'";

		$run_update = mysqli_query($con, $update_p);

		if($run_update)
		{
			echo "<script>alert('Payment type has been updated!')</script>";
			echo "<script>window.open('user_account.php?check_payment','_self')</script>";
		}
	}
	?>
<?php
}else if($approval == "Declined")
{
?>
<h4 align="center">Your payment was declined! Please try again or contact us.</h4>
<p align="center"><b>Admin's Note : </b><?php echo $admin_comm; ?></p><br><br>
<form method="post" action="" enctype="multipart/form-data">
<b>Select mode of payment</b>
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
					</select><br><br>
<input type="submit" class='btn btn-finish btn-primary' name="sel_p" value="Confirm" />
</form>

<?php

	if(isset($_POST['sel_p']))
	{
		$user = $_SESSION['user_email'];

		$sel_p = $_POST['payment_type'];
		$update_p = "update payment_status set type_selected='$sel_p',pay_status='Pending' where user_email='$user'";

		$run_update = mysqli_query($con, $update_p);

		if($run_update)
		{
			echo "<script>alert('Payment type has been updated!')</script>";
			echo "<script>window.open('user_account.php?check_payment','_self')</script>";
		}
	}
	?>


<?php
}else if($approval == "Approved")
{
?>
<h4 align="center">Your payment is accepted! Please continue to make your apppointments with us by clicking <a href="user_account.php?check_date"><b>this link</b></a>.</h4>
<p align="center">If there are problems, please contact us.  - Visioneri</p>
<p align="center"><b>Admin's Note : </b><?php echo $admin_comm; ?></p><br><br>
<?php
}else
{
	$select_details= "select * from payment_type where type='$status'";
	$run_details = mysqli_query($con,$select_details);
	$row_details= mysqli_fetch_array($run_details);
	$details=$row_details['details'];
?>

</p>



<br>
<form method="post" action="" enctype="multipart/form-data" autocomplete="off">
	 			<div class="panel-body">
					<div class="row">
						<div class="form-group col-md-12">
							<label class="form-control-label" for="inputPayment">Payment</label>
							<input type="text" class="form-control" id="inputPayment" name="Payment" placeholder="Payment" value="<?php echo $mdlPayment->getPayment(); ?>" onblur="checkInput('inputPayment')">
							<small id="notif-inputPayment" class="invalid-feedback">This is required</small>
						</div>
					</div>
				</div>
</form>

<b>Upload Picture:</b>
<input type="file" name="p_image" required />
<b>Comments:</b>
<textarea name="u_comments" cols="10" rows="5"></textarea>
<br>
<input type="submit" class='btn btn-finish btn-primary' name="send_payment" value="Submit Image" />
</form>

<?php } ?>

<?php
	if(isset($_POST['send_payment'])){

		$user = $_SESSION['user_email'];
		$comments = $_POST['u_comments'];
		$temp = explode(".", $_FILES["p_image"]["name"]);

		$newfilename = round(microtime(true)) . '.' . end($temp);

		move_uploaded_file($_FILES["p_image"]["tmp_name"], "../administrator/payments/" . $newfilename);

		$payment = "update payment_status set pay_status='Pending', payment_image='$newfilename',image_date=NOW(),user_comments='$comments' where user_email='$user'";

		$run_upload= mysqli_query($con, $payment);

		if($run_upload)
		{

			echo "<script>alert('You have successfully submitted the image!')</script>";
			echo "<script>window.open('user_account.php?check_payment','_self')</script>";

		}
	}
?>
</div>
									</div></div>
									</div>
