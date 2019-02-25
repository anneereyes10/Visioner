<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Plan.php");
require_once ("../App_Code/Category.php");
require_once ("../App_Code/Image.php");

$call = $_GET['call'];

switch ($call)
{
	case 'deleteShowImage':
	{
		deleteShowImage($_GET['Id']);
		break;
	}
	case 'deleteImage':
	{
		deleteImage($_GET['Id']);
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
	case 'deleteShowCat':
	{
		deleteShowCat($_GET['Id']);
		break;
	}
	case 'deleteCategory':
	{
		deleteCategory($_GET['Id']);
		break;
	}
}

function deleteShowImage($id)
{
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$mdlImage = $clsImage->GetById($id);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Image</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>Image Details</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?php
				$mdlImage = $clsImage->GetById($id);
				?>
					<img src="../<?php echo $clsImage->ToLocation($mdlImage); ?>" style="max-height:300px;">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteImage(<?php echo $mdlImage->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}


function deleteImage($id)
{
	$clsImage = new Image();
	$clsImage->Delete($id);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Image</h5>
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



function deleteShowCat($devId)
{
	$clsCategory = new Category();
	$mdlCategory = new CategoryModel();
	$mdlCategory = $clsCategory->GetById($devId);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Category</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>Category Details</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlCategory->getName(); ?>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-danger" onclick="deleteCategory(<?php echo $mdlCategory->getId(); ?>);">Delete</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function deleteCategory($id)
{
	$clsCategory = new Category();
	$clsCategory->Delete($id);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Delete Category</h5>
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
