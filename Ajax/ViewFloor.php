<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Floor.php");
require_once ("../App_Code/FloorModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

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
	case 'deleteFloor':
	{
		deleteFloor($_GET['Id']);
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

	$clsFloor = new Floor();
	$mdlFloor = new FloorModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$mdlFloor = $clsFloor->GetById($devId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Floor Detail</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
				$lstImage = $clsImage->GetByDetail("floor",$mdlFloor->getId(),"original");
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
				<h4>Floor Details</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlFloor->getName(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Description
			</div>
			<div class="col-md-8">
				<?php echo $mdlFloor->getDescription(); ?>
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
	$clsFloor = new Floor();
	$mdlFloor = new FloorModel();
	$mdlFloor = $clsFloor->GetById($devId);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Floor</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>Floor Details</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlFloor->getName(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteFloor(<?php echo $mdlFloor->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteFloor($adsId)
{
	$clsFloor = new Floor();
	$clsFloor->Delete($adsId);
	?>
	<head>
		<meta http-equiv="refresh" content="5">
	</head>
	<div class="modal-header">
		<h5 class="modal-title">Delete Floor</h5>
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


function deleteDisplay($adsId)
{
	$clsFloor = new Floor();
	$clsFloor->Delete($adsId);
	?>
	<head>
		<meta http-equiv="refresh" content="5;url=ViewFloor.php">
	</head>
	<div class="modal-header">
		<h5 class="modal-title">Delete Floor</h5>
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
