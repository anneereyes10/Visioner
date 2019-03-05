<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Project.php");
require_once ("../App_Code/Place.php");
require_once ("../App_Code/Functions.php");

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

function deleteShow($id)
{
	$cls = new Place();
	$mdl = new PlaceModel();
	$mdl = $cls->GetById($id);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Service</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>Service Details</h5>
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
	$cls = new Place();
	$cls->Delete($id);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Place</h5>
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
