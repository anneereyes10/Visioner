<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Payment.php");
require_once ("../App_Code/PaymentModel.php");

$call = $_GET['call'];

switch ($call){
	case 'addPayment':	{
		addPayment($_GET['Id'],$_GET['Date'],$_GET['Place_Id']);
		break;
	}
}

function addPayment($id,$date,$place){
	$clsPayment = new Payment();
	$mdlPayment = new PaymentModel();
	if ($clsPayment->IsDateTaken($id,$date)) {
		?>
		<div class="alert alert-danger">
			Date Already Taken.
		</div>
		<input type='date' class='form-control' id='inputAppointmentDate<?php echo $id;?>' name='AppointmentDate' value=''>
		<button class="btn btn-primary w-full" onclick="setAppointment(<?php echo $id;?>)">Set Appointment</button>
		<?php
	}else{
		$clsPayment->UpdateAppointmentDate($id,$date);
		$clsPayment->UpdatePlace_Id($id,$place);
		$clsPayment->UpdateAppointmentStatus($id,'0');
		?>
		<div class="alert alert-success">
		  <strong>Success!</strong> Date Submitted</a>.
		</div>
		<?php
	}

}
?>
