<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
	<script>
		tinymce.init({selector:'textarea'});
	</script>
	
	<div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 profiel-container">
<br>



 <form action="" method="post" enctype="multipart/form-data">
                            <div class="profiel-header">
                                <h3>
									<b>MY</b> TRANSACTIONS</b></h4></ul>
								<br>
								</h3>
                                <hr>
                            </div>



<?php
$user = $_SESSION['user_email'];
$select_trans = "select * from transaction_type where user_email = '$user'";
$select_upload = "select * from bd_upload where user_email = '$user'";
$select_pay = "select * from payment_status where user_email = '$user'";
$select_app = "select * from appointment where user_email = '$user'";
$select_serv = "select * from user_service where user_email = '$user'";

$run_select = mysqli_query($con,$select_trans);
$run_up = mysqli_query($con,$select_upload);
$run_pay = mysqli_query($con,$select_pay);
$run_app = mysqli_query($con,$select_app);
$run_serv = mysqli_query($con,$select_serv);

$row_up= mysqli_fetch_array($run_up);
$row_select= mysqli_fetch_array($run_select);
$row_pay = mysqli_fetch_array($run_pay);
$row_app = mysqli_fetch_array($run_app);
$row_serv = mysqli_fetch_array($run_serv);

$type = $row_select['transaction_type'];
$upstatus = $row_up['upload_status'];
$uploc = $row_up['upload_location'];
$upimg = $row_up['upload_img'];
$uploaddate = $row_up['upload_date'];
$uploaddate = date('F d, Y',strtotime($uploaddate));
$updet = $row_up['upload_details'];
$upfee = $row_up['upload_fee'];
$paystat = $row_pay['pay_status'];
$appdatee = $row_app['appointment_date'];

$serv_name = $row_serv['service_name'];
$serv_loc = $row_serv['service_location'];
$serv_fee = $row_serv['service_fee'];
$serv_date = $row_serv['service_date'];

if($appdatee == "0000-00-00")
{
	$appdate = "Not Set";
}
else
{
	$appdate = date('F d, Y',strtotime($appdatee));
}

$appstat = $row_app['appointment_status'];
if($type == "None")
{
?>
<p> You have not made any transactions with us yet. Click <a href="../builddesign/start.php">here</a> to start. </p>
<?php
}
else if($type == "Upload" and $upstatus == "Pending")
{
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<tr align="center">
<td><b>Service Type</b></td>
 <td><b><?php echo $type ?></b></td>
</tr>
<tr align="center">
<td><b>Status</b></td>
 <td><?php echo $upstatus ?></td>
</tr>
<tr align="center">
<td><b>Transaction Date</b></td>
 <td><?php echo $uploaddate ?></td>
</tr>
<tr align="center">
<td><b>Image Included</b></td>
<td>Show</td>
</tr>

<tr align="center">
<td><b>Details Included</b></td>
<td><?php echo $updet ?></td>
</tr>

<tr align="center">
<td><b>Payment Pending</b></td>
<td>
<?php 
if($upfee == "TBD")
{
echo "TBD";
}
else
{
echo " Php $upfee.00 ";
}
?></td>
</tr>

<tr align="center">
<td><b>Payment Status</b></td>
<td><?php echo $paystat ?></td>
</tr>

<tr align="center">
<td><b>Appointment Date</b></td>
<td><?php echo $appdate ?></td>
</tr>
<tr align="center">
<td><b>Appointment Location</b></td>
<td><?php echo $uploc ?></td>
</tr>
<tr align="center">
<td><b>Appointment Status</b></td>
<td><?php echo $appstat ?></td>
</tr>
</table>

<p>Your upload is currently being reviewed by us. Please wait. </p>

<?php
} 
else if($type == "Upload" and $upstatus == "Denied")
{?>
<form method="post" action="" enctype="multipart/form-data">
<p> Sorry, but we seem to have problems with your submission. We may be unable to give you our services on your given house plan. How about checking out our house plans?</p>
<input type="submit" class='btn btn-finish btn-primary' name="new_trans" value="Click here if you want to start another transaction." />
</form>
<?php 
if(isset($_POST['new_trans']))
{
$update_trans = "update transaction_type set transaction_type = 'None' where user_email = '$user'";
$delete_upload = "delete from bd_upload where user_email = '$user'";
$run_delete = mysqli_query($con, $delete_upload);
$run_update = mysqli_query($con, $update_trans); 

if($run_update and $run_delete)
{
	echo "<script>alert('Redirecting you to our services')</script>";
	echo "<script>window.open('../builddesign/start.php','_self')</script>";
}
}
?>
<?php 
}
else if($type == "Upload" and $upstatus == "Accepted")
{
?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<tr align="center">
<td><b>Service  Type</b></td>
 <td><b><?php echo $type ?></b></td>
</tr>
<tr align="center">
<td><b>Status</b></td>
 <td><?php echo $upstatus ?></td>
</tr>
<tr align="center">
<td><b>Transaction Date</b></td>
 <td><?php echo $uploaddate ?></td>
</tr>
<tr align="center">
<td><b>Image Included</b></td>
<td>Show</td>
</tr>

<tr align="center">
<td><b>Details Included</b></td>
<td><?php echo $updet ?></td>
</tr>

<tr align="center">
<td><b>Payment Pending</b></td>
<td>
<?php 
if($upfee == "TBD")
{
echo "TBD";
}
else
{
echo " Php $upfee.00 ";
}
?></td>
</tr>

<tr align="center">
<td><b>Payment Status</b></td>
<td><?php echo $paystat ?></td>
</tr>

<tr align="center">
<td><b>Appointment Date</b></td>
<td><?php echo $appdate ?></td>
</tr>
<tr align="center">
<td><b>Appointment Location</b></td>
<td><?php echo $uploc ?></td>
</tr>
<tr align="center">
<td><b>Appointment Status</b></td>
<td><?php echo $appstat ?></td>
</tr>
</table>
<p> Your upload has been checked and approved by Visioner, continue by going to our payments. Click <a href="user_account.php?check_payment">here</a>. </p>
<?php }
else if($type == "Service")
{	?>
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<tr align="center">
<td><b>Transaction Type</b></td>
 <td><b><?php echo $type ?></b></td>
</tr>
<tr align="center">
<td><b>Service Name</b></td>
 <td><?php echo $serv_name ?></td>
</tr>
<tr align="center">
<td><b>Transaction Date</b></td>
 <td><?php echo $serv_date ?></td>
</tr>

<tr align="center">
<td><b>Payment Pending</b></td>
<td>
Php <?php echo $serv_fee ?>.00
</td>
</tr>

<tr align="center">
<td><b>Payment Status</b></td>
<td><?php echo $paystat ?></td>
</tr>

<tr align="center">
<td><b>Appointment Date</b></td>
<td><?php echo $appdate ?></td>
</tr>
<tr align="center">
<td><b>Appointment Location</b></td>
<td><?php echo $serv_loc ?></td>
</tr>
<tr align="center">
<td><b>Appointment Status</b></td>
<td><?php echo $appstat ?></td>
</tr>
</table>
<p> Continue by going to our payments. Click <a href="user_account.php?check_payment">here</a>. </p>
<?php }?>