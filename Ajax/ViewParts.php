<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Parts.php");
require_once ("../App_Code/PartsModel.php");
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
	case 'deleteParts':
	{
		deleteParts($_GET['Id']);
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

	$clsParts = new Parts();
	$mdlParts = new PartsModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$mdlParts = $clsParts->GetById($devId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Parts Detail</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
				$lstImage = $clsImage->GetByDetail("parts",$mdlParts->getId(),"original");
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
				<h4>Parts Details</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlParts->getName(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Description
			</div>
			<div class="col-md-8">
				<?php echo $mdlParts->getDescription(); ?>
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
	$clsParts = new Parts();
	$mdlParts = new PartsModel();
	$mdlParts = $clsParts->GetById($devId);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Parts</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>Parts Details</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlParts->getName(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteParts(<?php echo $mdlParts->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteParts($adsId)
{
	$clsParts = new Parts();
	$clsParts->Delete($adsId);
	?>
	<head>
		<meta http-equiv="refresh" content="5">
	</head>
	<div class="modal-header">
		<h5 class="modal-title">Delete Parts</h5>
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
	$clsParts = new Parts();
	$clsParts->Delete($adsId);
	?>
	<head>
		<meta http-equiv="refresh" content="5;url=ViewParts.php">
	</head>
	<div class="modal-header">
		<h5 class="modal-title">Delete Parts</h5>
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
