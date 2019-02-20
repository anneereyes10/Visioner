<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/PaymentType.php");
require_once ("../App_Code/Image.php");

$call = $_GET['call'];

switch ($call)
{
	case 'deleteShow':
	{
		deleteShow($_GET['Id']);
		break;
	}
	case 'deleteItem':
	{
		deleteItem($_GET['Id']);
		break;
	}
}

function deleteShow($devId)
{
	$clsPaymentType = new PaymentType();
	$mdlPaymentType = new PaymentTypeModel();
	$mdlPaymentType = $clsPaymentType->GetById($devId);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete PaymentType</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>PaymentType Details</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlPaymentType->getName(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteItem(<?php echo $mdlPaymentType->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteItem($adsId)
{
	$clsPaymentType = new PaymentType();
	$clsPaymentType->Delete($adsId);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete PaymentType</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<h4>Deleted Successfully</h4>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

?>
