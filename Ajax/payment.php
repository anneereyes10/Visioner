<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Payment.php");
require_once ("../App_Code/PaymentModel.php");

$call = $_GET['call'];

switch ($call){
	case 'addPayment':	{
		addPayment($_GET['Id'],$_GET['Date']);
		break;
	}
}

function addPayment($id,$date){
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
		$mdlPayment->setId($id);
		$mdlPayment->setAppointmentDate($date);
		$clsPayment->UpdateAppointmentDate($mdlPayment);
		?>
		<div class="alert alert-success">
		  <strong>Success!</strong> Date Submitted</a>.
		</div>
		<?php
	}

}
?>
