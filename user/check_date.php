<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>
		tinymce.init({selector:'textarea'});
	</script>
	
	<div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 profiel-container">

                            <div class="profiel-header">
                                <h3>
									<b>MY</b> APPOINTMENTS</b></h4></ul>
								<br>
								</h3>
                                <hr>
                            </div>



<?php
$user = $_SESSION['user_email'];
$select_pay = "select * from payment_status where user_email = '$user'";
$select_app = "select *from appointment where user_email = '$user'";
$run_select = mysqli_query($con,$select_pay);
$row_select= mysqli_fetch_array($run_select);
$run_app = mysqli_query($con,$select_app);
$row_app= mysqli_fetch_array($run_app);

$approved_date=$row_app['appointment_date'];
$app_status=$row_app['appointment_status'];
$msg=$row_app['admin_msg'];
$status=$row_select['type_selected'];
$approval=$row_select['pay_status'];
if($approval == "Approved" and $app_status == "None")
{
?>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
	<label>Please select a date for an appointment with us: </label>
		<div class='input-group date' id='datepicker'>
			<input type='text' class="form-control" name = "selected_date" placeholder="Select a reservation date" required />
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
</div>
<b>Write a message alongside your appointment:</b> 
<textarea name="user_msg" cols="10" rows="5"></textarea><br>
<input type="submit" class='btn btn-finish btn-primary' name="make_appointment" value="Submit" />
</form>
<?php  

	if(isset($_POST['make_appointment']))
	{
		$user = $_SESSION['user_email'];

		$sel_date = $_POST['selected_date'];
		$u_msg = $_POST['user_msg'];
		$update_app = "update appointment set appointment_date='$sel_date', appointment_status='Pending',appointment_made=NOW(),user_msg='$u_msg' where user_email='$user'";
		
		$run_update = mysqli_query($con, $update_app); 
		
		if($run_update)
		{
			echo "<script>alert('Appointment has been made!')</script>";
			echo "<script>window.open('user_account.php?check_payment','_self')</script>";
		}
	}
	?>
<?php
}else if($approval == "None" or $approval == "Pending" or $approval == "Declined")
{
?>
<h4 align="center">Please settle your payment first!</h4>
<p align="center">Go to Payments by clicking this <a href="user_account.php?check_payment">link</a>.</p>
<?php 
}else if($approval=="Approved" and $app_status == "Pending")
{?>
<h4 align="center">Your selected date is currently being checked to fit our schedules. Please wait for our feedback!</h4>
<p align="center"><b>Admin's Note : </b><?php echo $msg; ?></p>
<?php 
}else if($approval=="Approved" and $app_status == "Approved")
{?>
<h4 align="center">Hello, your selected date: <b><?php echo $approved_date; ?></b>is accepted, see you!</h4>
<p align="center">If there are problems, please contact us.  - Visioneri</p>
<p align="center"><b>Admin's Note : </b><?php echo $msg; ?></p>
<?php 
}else if($approval=="Approved" and $app_status == "Declined")
{?>
<h4 align="center">Your chosen appointment date was declined! Please try again or contact us.</h4>
<p align="center"><b>Admin's Note : </b><?php echo $msg; ?></p><br><br>
<form action="" method="post" enctype="multipart/form-data">
<div class="form-group">
	<label>Please select a date for an appointment with us: </label>
		<div class='input-group date' id='datepicker'>
			<input type='text' class="form-control" name = "selected_date" placeholder="Select a reservation date" required />
			<span class="input-group-addon">
				<span class="glyphicon glyphicon-calendar"></span>
			</span>
		</div>
</div>
<b>Write a message alongside your appointment:</b> 
<textarea name="user_msg" cols="10" rows="5"></textarea><br>
<input type="submit" class='btn btn-finish btn-primary' name="make_appointment" value="Submit" />
</form>
<?php  

	if(isset($_POST['make_appointment']))
	{
		$user = $_SESSION['user_email'];

		$sel_date = $_POST['selected_date'];
		$u_msg = $_POST['user_msg'];
		$update_app = "update appointment set appointment_date='$sel_date', appointment_status='Pending',appointment_made=NOW(),user_msg='$u_msg' where user_email='$user'";
		
		$run_update = mysqli_query($con, $update_app); 
		
		if($run_update)
		{
			echo "<script>alert('Appointment has been made!')</script>";
			echo "<script>window.open('user_account.php?check_payment','_self')</script>";
		}
	}
	?>
<?php }?>
</div></div></div></div>

