<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Plan.php");
require_once ("../App_Code/Image.php");

$call = $_GET['call'];

switch ($call)
{
	case 'display':
	{
		display($_GET['Id']);
		break;
	}
	case 'deleteShow':
	{
		deleteShow($_GET['Id']);
		break;
	}
	case 'deletePlan':
	{
		deletePlan($_GET['Id']);
		break;
	}
	case 'deleteDisplay':
	{
		deleteDisplay($_GET['Id']);
		break;
	}
}

function display($devId)
{

	$clsPlan = new Plan();
	$mdlPlan = new PlanModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$mdlPlan = $clsPlan->GetById($devId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Plan Detail</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
				$lstImage = $clsImage->GetByDetail("layout",$mdlPlan->getId(),"original");
				foreach($lstImage as $mdlImage){
					?>
					<img src="../<?php echo $clsImage->ToLocation($mdlImage); ?>" class="img-fluid h-100 img-bordered" />
					<?php
				}
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4>Plan Details</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlPlan->getName(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Description
			</div>
			<div class="col-md-8">
				<?php echo $mdlPlan->getDescription(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}


function deleteShow($devId)
{
	$clsPlan = new Plan();
	$mdlPlan = new PlanModel();
	$mdlPlan = $clsPlan->GetById($devId);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Plan</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>Plan Details</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlPlan->getName(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deletePlan(<?php echo $mdlPlan->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deletePlan($adsId)
{
	$clsPlan = new Plan();
	$clsPlan->Delete($adsId);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Plan</h5>
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


function deleteDisplay($adsId)
{
	$clsPlan = new Plan();
	$clsPlan->Delete($adsId);
	?>
	<head>
		<meta http-equiv="refresh" content="5;url=ViewPlan.php">
	</head>
	<div class="modal-header">
		<h5 class="modal-title">Delete Plan</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<h4>Deleted Successfully</h4>
		<p>page auto refreshes in 5 sec.</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}
?>
