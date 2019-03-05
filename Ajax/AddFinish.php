<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/FinishItem.php");
require_once ("../App_Code/Plan.php");
require_once ("../App_Code/Category.php");
require_once ("../App_Code/Part.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/Upgrade.php");
require_once ("../App_Code/Image.php");

$call = $_GET['call'];

switch ($call){
	case 'plan':	{
		displayPlan($_GET['Id']);
		break;
	}
	case 'category':	{
		displayCategory($_GET['Id']);
		break;
	}
	case 'part':	{
		displayPart($_GET['Id']);
		break;
	}
	case 'material':	{
		displayMaterial($_GET['Id']);
		break;
	}
	case 'upgrade':	{
		displayUpgrade($_GET['Id']);
		break;
	}
	case 'upgradeselect':	{
		displayUpgradeSelect($_GET['Id'],$_GET['PartMaterial_Id'],$_GET['empty']);
		break;
	}
	case 'selectMaterial': {
		selectMaterial($_GET['Id']);
		break;
	}
	case 'selectUpgrade': {
		selectUpgrade($_GET['Id']);
		break;
	}

	case 'addcategory':	{
		addCategory($_GET['PlanId'],$_GET['CategoryId']);
		break;
	}
	case 'addroom':	{
		addRoom($_GET['PlanCategoryId'],$_GET['RoomId']);
		break;
	}
	case 'addpart':	{
		addPart($_GET['CategoryRoomId'],$_GET['PartId']);
		break;
	}
	case 'addmaterial':	{
		addMaterial($_GET['RoomPartId'],$_GET['MaterialId']);
		break;
	}
	case 'addupgrade':	{
		addUpgrade($_GET['PartMaterialId'],$_GET['UpgradeId']);
		break;
	}

	case 'deletecategory':	{
		deleteCategory($_GET['PlanCategoryId']);
		break;
	}
	case 'deleteroom': {
		deleteRoom($_GET['CategoryRoomId']);
		break;
	}
	case 'deletepart': {
		deletePart($_GET['RoomPartId']);
		break;
	}
	case 'deletematerial': {
		deleteMaterial($_GET['PartMaterialId']);
		break;
	}
	case 'deleteupgrade': {
		deleteUpgrade($_GET['MaterialUpgradeId']);
		break;
	}

	case 'showcategory':	{
		showCategory($_GET['Id']);
		break;
	}
	case 'showroom':	{
		showRoom($_GET['Id']);
		break;
	}
	case 'showpart':	{
		showPart($_GET['Id']);
		break;
	}
	case 'showmaterial':	{
		showMaterial($_GET['Id']);
		break;
	}
	case 'showupgrade':	{
		showUpgrade($_GET['Id']);
		break;
	}
}


/* DISPLAY----------------------------------------------------- DISPLAY */
function displayPlan($finishId){
	$_SESSION['Finish_Id'] = $finishId;
	$clsPlan = new Plan();
	$mdlPlan = new PlanModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$lstPlan = $clsPlan->Get();

  foreach ($lstPlan as $mdlPlan) {
    $imgLocation = "";
    $lstImage = $clsImage->GetByDetail("plan",$mdlPlan->getId(),"original");
    foreach($lstImage as $mdlImage){
      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
    }
    ?>
    <div class="col-md-2 col-sm-3 mb-10 p-0">
      <a
				href="javascript:void(0);"
				onclick="selPlan(<?php echo $mdlPlan->getId(); ?>);"
				class="card shadow featured bg-light"
				style="color:#666;"
				id="Plan_<?php echo $mdlPlan->getId(); ?>"
			>
        <div
        	class="card-img-top img-featured"
        	style="background-image: url('<?php echo $imgLocation; ?>')"
        	alt="<?php echo $mdlPlan->getName(); ?>"
				>
      	</div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $mdlPlan->getName(); ?></h5>
          <p class="card-text"><?php echo $mdlPlan->getDescription(); ?></p>
        </div>
      </a>
    </div>
  <?php
  }
  if (empty($lstPlan)) {
    echo 'No Plan Attached';
  }
}

function displayCategory($planId){
	$_SESSION['Plan_Id'] = $planId;
	$clsCategory = new Category();
	$mdlCategory = new CategoryModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$lstCategory = $clsCategory->GetByPlan_Id($planId);

  if (empty($mdlCategory)) {
    echo 'No Category Attached';
  }else{
		foreach ($lstCategory as $mdlCategory) {
			?>
			<div class="col-md-2 col-sm-3 mb-10 p-0">
				<a
				href="javascript:void(0);"
				onclick="selCategory(<?php echo $mdlCategory->getId(); ?>);"
				class="card shadow featured bg-light"
				style="color:#666;"
				id="Category_<?php echo $mdlCategory->getId(); ?>"
				>
					<div class="card-body">
						<h5 class="card-title"><?php echo $mdlCategory->getName(); ?></h5>
					</div>
				</a>
			</div>
			<?php
		}
	}
}

function displayPart($categoryId){
	$clsPart = new Part();
	$mdlPart = new PartModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

  $lstPart = $clsPart->GetByCategory_Id($categoryId);

  if (empty($lstPart)) {
    echo 'No Part Attached';
  }else{
		foreach ($lstPart as $mdlPart) {
			?>
			<div class="col-md-2 col-sm-3 mb-10 p-0">
				<a
				href="javascript:void(0);"
				onclick="selPart(<?php echo $mdlPart->getId(); ?>);"
				class="card shadow featured bg-light"
				style="color:#666;"
				id="Part_<?php echo $mdlPart->getId(); ?>"
				>
					<div class="card-body">
						<h5 class="card-title"><?php echo $mdlPart->getName(); ?></h5>
					</div>
				</a>
			</div>
			<?php
		}
	}
}

function displayMaterial($PartId){
	$clsMaterial = new Material();
	$mdlMaterial = new MaterialModel();
	$clsFI = new FinishItem();
	$mdlFI = new FinishItemModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

  $lstMaterial = $clsMaterial->GetByPart_Id($PartId);

  if (empty($lstMaterial)) {
    echo 'No Material Attached';
  }else{
		foreach ($lstMaterial as $mdlMaterial) {
			$imgLocation = "";
			$lstImage = $clsImage->GetByDetail("material",$mdlMaterial->getId(),"original");

			foreach($lstImage as $mdlImage){
				$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
			}

			$mdlFI->setFinish_Id($_SESSION['Finish_Id']);
			$mdlFI->setPlan_Id($_SESSION['Plan_Id']);
			$mdlFI->setMaterial_Id($mdlMaterial->getId());
			$mdlFI->setUpgrade_Id('0');
			$addedCss = ' bg-light';
			if ($clsFI->IsExist($mdlFI)) {
				$addedCss = ' text-white bg-info';
			}
			?>
			<div class="col-md-2 col-sm-3 mb-10 p-0">
				<a
				href="javascript:void(0);"
				onclick="selMaterial(<?php echo $mdlMaterial->getId() . "," . $PartId; ?>);"
				class="card shadow featured <?php echo $addedCss;?>"
				style="color:#666;"
				id="Material_<?php echo $mdlMaterial->getId(); ?>"
				>
					<div
					class="card-img-top img-featured"
					style="background-image: url('<?php echo $imgLocation; ?>')"
					alt="<?php echo $mdlMaterial->getName(); ?>"
					></div>
					<div class="card-body">
						<h5 class="card-title"><?php echo $mdlMaterial->getName(); ?></h5>
						<p class="card-text">
							<?php echo $mdlMaterial->getDescription(); ?>
						</p>
					</div>
				</a>
			</div>
			<?php
		}
	}
}


function displayUpgradeSelect($materialUpgradeId,$PartMaterial_Id,$empty){
	$clsFI = new FinishItem();
	$mdlFI = new FinishItemModel();

	$clsFI->DeleteUpgradeChange($_SESSION['Finish_Id'],$_SESSION['Plan_Id'],$PartMaterial_Id);
	if ($empty=='false') {
		$mdlFI->setFinish_Id($_SESSION['Finish_Id']);
		$mdlFI->setPlan_Id($_SESSION['Plan_Id']);
		$mdlFI->setPartMaterial_Id($PartMaterial_Id);
		$mdlFI->setMaterialUpgrade_Id($materialUpgradeId);
		$clsFI->Add($mdlFI);
			echo 'add';
	}else{
		echo 'deleted only';
	}
}

function selectMaterial($Material_Id){
	$clsFI = new FinishItem();
	$mdlFI = new FinishItemModel();
	$clsM = new Material();
	$mdlFI->setFinish_Id($_SESSION['Finish_Id']);
	$mdlFI->setPlan_Id($_SESSION['Plan_Id']);
	$mdlFI->setMaterial_Id($Material_Id);
	$mdlFI->setUpgrade_Id('0');

	$clsFI->DeleteMaterialChange($_SESSION['Finish_Id'],$_SESSION['Plan_Id'],$clsM->GetPart_IdById($Material_Id));

	$clsFI->Add($mdlFI);
}

function selectUpgrade($Upgrade_Id){
	$clsFI = new FinishItem();
	$mdlFI = new FinishItemModel();
	$clsU = new Upgrade();
	$mdlFI->setFinish_Id($_SESSION['Finish_Id']);
	$mdlFI->setPlan_Id($_SESSION['Plan_Id']);
	$mdlFI->setMaterial_Id('0');
	$mdlFI->setUpgrade_Id($Upgrade_Id);

	$clsFI->DeleteUpgradeChange($_SESSION['Finish_Id'],$_SESSION['Plan_Id'],$clsU->GetPart_IdById($Upgrade_Id));

	$clsFI->Add($mdlFI);
}

/* SHOW ----------------------------------------------------- SHOW */
function showCategory($planId){
	$clsPlan = new Plan();
	$mdlPlan = new PlanModel();
	$clsPlanCategory = new PlanCategory();
	$mdlPlanCategory = new PlanCategoryModel();
	$clsCategory = new Category();
	$mdlCategory = new CategoryModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$mdlPlan = $clsPlan->GetById($planId);

	$lstCategory = $clsCategory->GetCategoryNotPlan($planId);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Manage Category</h5>
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
		<div class="row" style="margin-top:20px;">
			<div class="col-lg-6 col-md-12" style="overflow-x:auto;">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Plan Category</h3>
					</div>
					<div class="panel-body">
						<table id="table1" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</tfoot>
							<tbody>
								<?php
								$lstPlanCategory = $clsPlanCategory->GetByPlan_Id($mdlPlan->getId());
								foreach($lstPlanCategory as $mdlPlanCategory)
								{
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("category",$mdlPlanCategory->getCategory_Id(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $clsCategory->GetNameById($mdlPlanCategory->getCategory_Id()); ?></td>
										<td>
											<a href="JavaScript:void(0);" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Remove" onclick="deleteCategory(<?php echo $mdlPlanCategory->getId().",".$mdlPlan->getId(); ?>);">
												<i class="fa fa-trash" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
									<?php
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>


			<div class="col-lg-6 col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Category</h3>
					</div>
					<div class="panel-body" style="overflow-x:auto;">
						<table id="table2" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</tfoot>
							<tbody>
								<?php
								$lstCategory = $clsCategory->GetCategoryNotPlan($mdlPlan->getId());
								foreach($lstCategory as $mdlCategory)
								{
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("category",$mdlCategory->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlCategory->getName(); ?></td>
										<td>
											<a href="JavaScript:void(0);" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Add"  onclick="addCategory(<?php echo  $mdlPlan->getId() . "," . $mdlCategory->getId(); ?>);showCategory(<?php echo $planId; ?>);">
												<i class="fa fa-plus" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
									<?php
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function showPart($categoryroomId){
	$clsFR = new CategoryRoom();
	$clsRoom = new Room();
	$mdlRoom = new RoomModel();
	$clsRP = new RoomPart();
	$mdlRP = new RoomPartModel();
	$clsPart = new Part();
	$mdlPart = new PartModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$mdlFR = $clsFR->GetById($categoryroomId);
	$mdlRoom = $clsRoom->GetById($mdlFR->getRoom_Id());
	$lstPart = $clsPart->GetNotRoom_Id($mdlRoom->getId());
	?>
	<div class="modal-header">
		<h5 class="modal-title">Manage Part</h5>
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
		<div class="row" style="margin-top:20px;">
			<div class="col-lg-6 col-md-12" style="overflow-x:auto;">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Room Part</h3>
					</div>
					<div class="panel-body">
						<table id="table1" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</tfoot>
							<tbody>
								<?php
								$lstRP = $clsRP->GetByCategoryRoom_Id($mdlFR->getId());
								foreach($lstRP as $mdlRP)
								{
									$mdlPart = $clsPart->GetById($mdlRP->getPart_Id());
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("part",$mdlPart->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlPart->getName(); ?></td>
										<td>
											<a
												href="JavaScript:void(0);"
												class="btn btn-sm btn-icon btn-pure btn-default"
												data-toggle="tooltip"
												title="Remove"
												onclick="deletePart(<?php echo $mdlRP->getId().",".$mdlFR->getId(); ?>);"
											>
												<i class="fa fa-trash" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
									<?php
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>


			<div class="col-lg-6 col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Part</h3>
					</div>
					<div class="panel-body" style="overflow-x:auto;">
						<table id="table2" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</tfoot>
							<tbody>
								<?php
								$lstPart = $clsPart->GetNotRoom_Id($mdlRoom->getId());
								foreach($lstPart as $mdlPart)
								{
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("part",$mdlPart->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlPart->getName(); ?></td>
										<td>
											<a
												href="JavaScript:void(0);"
												class="btn btn-sm btn-icon btn-pure btn-default"
												data-toggle="tooltip" title="Add"
												onclick="addPart(<?php echo  $mdlFR->getId().",".$mdlPart->getId(); ?>);"
											>
												<i class="fa fa-plus" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
									<?php
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function showMaterial($roompartId){
	$clsRP = new RoomPart();
	$clsPart = new Part();
	$mdlPart = new PartModel();
	$clsPM = new PartMaterial();
	$mdlPM = new PartMaterialModel();
	$clsMaterial = new Material();
	$mdlMaterial = new MaterialModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$mdlRP = $clsRP->GetById($roompartId);
	$mdlPart = $clsPart->GetById($mdlRP->getPart_Id());
	$lstMaterial = $clsMaterial->GetNotPart_Id($mdlPart->getId());
	?>
	<div class="modal-header">
		<h5 class="modal-title">Manage Material</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>Part Details</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlPart->getName(); ?>
			</div>
		</div>
		<div class="row" style="margin-top:20px;">
			<div class="col-lg-6 col-md-12" style="overflow-x:auto;">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Category Room</h3>
					</div>
					<div class="panel-body">
						<table id="table1" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</tfoot>
							<tbody>
								<?php
								$lstPM = $clsPM->GetByRoomPart_Id($mdlRP->getId());
								foreach($lstPM as $mdlPM)
								{
									$mdlMaterial = $clsMaterial->GetById($mdlPM->getMaterial_Id());
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("material",$mdlMaterial->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlMaterial->getName(); ?></td>
										<td>
											<a
												href="JavaScript:void(0);"
												class="btn btn-sm btn-icon btn-pure btn-default"
												data-toggle="tooltip"
												title="Remove"
												onclick="deleteMaterial(<?php echo $mdlPM->getId().",".$mdlRP->getId(); ?>);"
											>
												<i class="fa fa-trash" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
									<?php
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>


			<div class="col-lg-6 col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Material</h3>
					</div>
					<div class="panel-body" style="overflow-x:auto;">
						<table id="table2" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</tfoot>
							<tbody>
								<?php
								$lstMaterial = $clsMaterial->GetNotPart_Id($mdlPart->getId());
								foreach($lstMaterial as $mdlMaterial)
								{
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("material",$mdlMaterial->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlMaterial->getName(); ?></td>
										<td>
											<a
												href="JavaScript:void(0);"
												class="btn btn-sm btn-icon btn-pure btn-default"
												data-toggle="tooltip" title="Add"
												onclick="addMaterial(<?php echo $mdlRP->getId().",".$mdlMaterial->getId(); ?>);"
											>
												<i class="fa fa-plus" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
									<?php
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

function showUpgrade($partmaterialId){
	$clsPM = new PartMaterial();
	$clsMaterial = new Material();
	$mdlMaterial = new MaterialModel();
	$clsMU = new MaterialUpgrade();
	$mdlMU = new MaterialUpgradeModel();
	$clsUpgrade = new Upgrade();
	$mdlUpgrade = new UpgradeModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$mdlPM = $clsPM->GetById($partmaterialId);
	$mdlMaterial = $clsMaterial->GetById($mdlPM->getMaterial_Id());
	$lstUpgrade = $clsUpgrade->GetNotMaterial_Id($mdlMaterial->getId());
	?>
	<div class="modal-header">
		<h5 class="modal-title">Manage Upgrade</h5>
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
				<?php echo $mdlMaterial->getName(); ?>
			</div>
		</div>
		<div class="row" style="margin-top:20px;">
			<div class="col-lg-6 col-md-12" style="overflow-x:auto;">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Material Upgrade</h3>
					</div>
					<div class="panel-body">
						<table id="table1" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</tfoot>
							<tbody>
								<?php
								$lstMU = $clsMU->GetByPartMaterial_Id($mdlPM->getId());
								foreach($lstMU as $mdlMU)
								{
									$mdlUpgrade = $clsUpgrade->GetById($mdlMU->getUpgrade_Id());
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("upgrade",$mdlUpgrade->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlUpgrade->getName(); ?></td>
										<td>
											<a
												href="JavaScript:void(0);"
												class="btn btn-sm btn-icon btn-pure btn-default"
												data-toggle="tooltip"
												title="Remove"
												onclick="deleteUpgrade(<?php echo $mdlMU->getId().",".$mdlPM->getId(); ?>);"
											>
												<i class="fa fa-trash" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
									<?php
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>


			<div class="col-lg-6 col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Upgrade</h3>
					</div>
					<div class="panel-body" style="overflow-x:auto;">
						<table id="table2" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Image</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</tfoot>
							<tbody>
								<?php
								$lstUpgrade = $clsUpgrade->GetNotMaterial_Id($mdlMaterial->getId());
								foreach($lstUpgrade as $mdlUpgrade)
								{
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("upgrade",$mdlUpgrade->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlUpgrade->getName(); ?></td>
										<td>
											<a
												href="JavaScript:void(0);"
												class="btn btn-sm btn-icon btn-pure btn-default"
												data-toggle="tooltip" title="Add"
												onclick="addUpgrade(<?php echo  $mdlPM->getId().",".$mdlUpgrade->getId(); ?>);"
											>
												<i class="fa fa-plus" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
									<?php
								} ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
	<?php
}

/* ADD ----------------------------------------------------- ADD */

function addCategory($planId,$categoryId){
	$cls = new PlanCategory();
	$mdl = new PlanCategoryModel();
	$mdl->setPlan_Id($planId);
	$mdl->setCategory_Id($categoryId);
	$cls->Add($mdl);
	displayCategory($planId);
}

function addPart($categoryRoomId,$partId){
	$cls = new RoomPart();
	$mdl = new RoomPartModel();
	$mdl->setCategoryRoom_Id($categoryRoomId);
	$mdl->setPart_Id($partId);
	$cls->Add($mdl);
	displayPart($categoryRoomId);
}

function addMaterial($roomPartId,$materialId){
	$cls = new PartMaterial();
	$mdl = new PartMaterialModel();
	$mdl->setRoomPart_Id($roomPartId);
	$mdl->setMaterial_Id($materialId);
	$cls->Add($mdl);
	displayMaterial($roomPartId);
}

function addUpgrade($partMaterialId,$upgradeId){
	$cls = new MaterialUpgrade();
	$mdl = new MaterialUpgradeModel();
	$mdl->setPartMaterial_Id($partMaterialId);
	$mdl->setUpgrade_Id($upgradeId);
	$cls->Add($mdl);
	displayUpgrade($partMaterialId);
}

/* DELETE ----------------------------------------------------- DELETE */

function deleteCategory($id){
	$cls = new PlanCategory();
	$rId = $cls->GetPlan_IdById($id);
	$cls->Delete($id);
	displayCategory($rId);
}

function deletePart($id){
	$cls = new RoomPart();
	$rId = $cls->GetCategoryRoom_IdById($id);
	$cls->Delete($id);
	displayPart($rId);
}

function deleteMaterial($id){
	$cls = new PartMaterial();
	$rId = $cls->GetRoomPart_IdById($id);
	$cls->Delete($id);
	displayMaterial($rId);
}

function deleteUpgrade($id){
	$cls = new MaterialUpgrade();
	$rId = $cls->GetPartMaterial_IdById($id);
	$cls->Delete($id);
	displayUpgrade($rId);
}

?>
