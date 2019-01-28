<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Room.php");
require_once ("../App_Code/RoomModel.php");
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
	case 'deleteRoom':
	{
		deleteRoom($_GET['Id']);
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

	$clsRoom = new Room();
	$mdlRoom = new RoomModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$mdlRoom = $clsRoom->GetById($devId);
	?>
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
		<h3 class="modal-title">Room Detail</h3>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12 text-center">
				<?php
				$lstImage = $clsImage->GetByDetail("room",$mdlRoom->getId(),"original");
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
				<h4>Room Details</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlRoom->getName(); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Description
			</div>
			<div class="col-md-8">
				<?php echo $mdlRoom->getDescription(); ?>
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
	$clsRoom = new Room();
	$mdlRoom = new RoomModel();
	$mdlRoom = $clsRoom->GetById($devId);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Room</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>Room Details</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlRoom->getName(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteRoom(<?php echo $mdlRoom->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteRoom($adsId)
{
	$clsRoom = new Room();
	$clsRoom->Delete($adsId);
	?>
	<head>
		<meta http-equiv="refresh" content="5">
	</head>
	<div class="modal-header">
		<h5 class="modal-title">Delete Room</h5>
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
	$clsRoom = new Room();
	$clsRoom->Delete($adsId);
	?>
	<head>
		<meta http-equiv="refresh" content="5;url=ViewRoom.php">
	</head>
	<div class="modal-header">
		<h5 class="modal-title">Delete Room</h5>
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
