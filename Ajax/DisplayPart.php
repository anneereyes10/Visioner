<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/Upgrade.php");

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
		case 'deleteShow2':
		{
			deleteShow2($_GET['Id']);
			break;
		}
		case 'deleteItem2':
		{
			deleteItem2($_GET['Id']);
			break;
		}
}

function deleteShow($id)
{
	$cls = new Material();
	$mdl = new MaterialModel();
	$mdl = $cls->GetById($id);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Material</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>Material Details</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdl->getName(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteItem(<?php echo $mdl->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteItem($id)
{
	$cls = new Material();
	$cls->Delete($id);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Material</h5>
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



function deleteShow2($id)
{
	$cls = new Upgrade();
	$mdl = new UpgradeModel();
	$mdl = $cls->GetById($id);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Upgrade</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>Upgrade Details</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdl->getName(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteItem2(<?php echo $mdl->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteItem2($id)
{
	$cls = new Upgrade();
	$cls->Delete($id);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Upgrade</h5>
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
