<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/FinishItem.php");
require_once ("../App_Code/FinishItemModel.php");
require_once ("../App_Code/Layout.php");
require_once ("../App_Code/LayoutModel.php");
require_once ("../App_Code/LayoutFloor.php");
require_once ("../App_Code/LayoutFloorModel.php");
require_once ("../App_Code/Floor.php");
require_once ("../App_Code/FloorModel.php");
require_once ("../App_Code/FloorRoom.php");
require_once ("../App_Code/FloorRoomModel.php");
require_once ("../App_Code/Room.php");
require_once ("../App_Code/RoomModel.php");
require_once ("../App_Code/RoomPart.php");
require_once ("../App_Code/RoomPartModel.php");
require_once ("../App_Code/Parts.php");
require_once ("../App_Code/PartsModel.php");
require_once ("../App_Code/PartMaterial.php");
require_once ("../App_Code/PartMaterialModel.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/MaterialModel.php");
require_once ("../App_Code/MaterialUpgrade.php");
require_once ("../App_Code/MaterialUpgradeModel.php");
require_once ("../App_Code/Upgrade.php");
require_once ("../App_Code/UpgradeModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

$call = $_GET['call'];

switch ($call){
	case 'layout':	{
		displayLayout($_GET['Id']);
		break;
	}
	case 'floor':	{
		displayFloor($_GET['Id']);
		break;
	}
	case 'room':	{
		displayRoom($_GET['Id']);
		break;
	}
	case 'parts':	{
		displayParts($_GET['Id']);
		break;
	}
	case 'material':	{
		displayMaterial($_GET['Id']);
		break;
	}
	case 'upgrade':	{
		displayUpgrade($_GET['Id'],$_GET['RoomPart_Id']);
		break;
	}
	case 'upgradeselect':	{
		displayUpgradeSelect($_GET['Id'],$_GET['PartMaterial_Id'],$_GET['empty']);
		break;
	}

	case 'addfloor':	{
		addFloor($_GET['LayoutId'],$_GET['FloorId']);
		break;
	}
	case 'addroom':	{
		addRoom($_GET['LayoutFloorId'],$_GET['RoomId']);
		break;
	}
	case 'addparts':	{
		addParts($_GET['FloorRoomId'],$_GET['PartsId']);
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

	case 'deletefloor':	{
		deleteFloor($_GET['LayoutFloorId']);
		break;
	}
	case 'deleteroom': {
		deleteRoom($_GET['FloorRoomId']);
		break;
	}
	case 'deleteparts': {
		deleteParts($_GET['RoomPartsId']);
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

	case 'showfloor':	{
		showFloor($_GET['Id']);
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
function displayLayout($finishId){
	$_SESSION['Finish_Id'] = $finishId;
	$clsLayout = new Layout();
	$mdlLayout = new LayoutModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$lstLayout = $clsLayout->Get();

  foreach ($lstLayout as $mdlLayout) {
    $imgLocation = "";
    $lstImage = $clsImage->GetByDetail("layout",$mdlLayout->getId(),"original");
    foreach($lstImage as $mdlImage){
      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
    }
    ?>
    <div class="col-md-2 col-sm-3 mb-10 p-0">
      <a
				href="javascript:void(0);"
				onclick="selLayout(<?php echo $mdlLayout->getId(); ?>);"
				class="card shadow featured bg-light"
				style="color:#666;"
				id="Layout_<?php echo $mdlLayout->getId(); ?>"
			>
        <div
        	class="card-img-top img-featured"
        	style="background-image: url('<?php echo $imgLocation; ?>')"
        	alt="<?php echo $mdlLayout->getName(); ?>"
				>
      	</div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $mdlLayout->getName(); ?></h5>
          <p class="card-text"><?php echo $mdlLayout->getDescription(); ?></p>
        </div>
      </a>
    </div>
  <?php
  }
  if (empty($lstLayout)) {
    echo 'No Layout Attached';
  }
}

function displayFloor($layoutId){
	$_SESSION['Layout_Id'] = $layoutId;
	$clsFloor = new Floor();
	$mdlFloor = new FloorModel();
	$clsLF = new LayoutFloor();
	$mdlLF = new LayoutFloorModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$lstLF = $clsLF->GetByLayout_Id($layoutId);

  foreach ($lstLF as $mdlLF) {
		$mdlFloor = $clsFloor->GetById($mdlLF->getFloor_Id());
    $imgLocation = "";
    $lstImage = $clsImage->GetByDetail("floor",$mdlFloor->getId(),"original");
    foreach($lstImage as $mdlImage){
      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
    }
    ?>
    <div class="col-md-2 col-sm-3 mb-10 p-0">
      <a
				href="javascript:void(0);"
				onclick="selFloor(<?php echo $mdlLF->getId(); ?>);"
				class="card shadow featured bg-light"
				style="color:#666;"
				id="LayoutFloor_<?php echo $mdlLF->getId(); ?>"
			>
        <div
        	class="card-img-top img-featured"
        	style="background-image: url('<?php echo $imgLocation; ?>')"
        	alt="<?php echo $mdlFloor->getName(); ?>"
				>
      	</div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $mdlFloor->getName(); ?></h5>
          <p class="card-text"><?php echo $mdlFloor->getDescription(); ?></p>
        </div>
      </a>
    </div>
  <?php
  }
  if (empty($lstLF)) {
    echo 'No Floor Attached';
  }
}

function displayRoom($layoutFloorId){
	$clsRoom = new Room();
	$mdlRoom = new RoomModel();
	$clsFR = new FloorRoom();
	$mdlFR = new FloorRoomModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

  $lstFR = $clsFR->GetByLayoutFloor_Id($layoutFloorId);

  foreach ($lstFR as $mdlFR) {
		$mdlRoom = $clsRoom->GetById($mdlFR->getRoom_Id());
    $imgLocation = "";
    $lstImage = $clsImage->GetByDetail("room",$mdlRoom->getId(),"original");

    foreach($lstImage as $mdlImage){
      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
    }
    ?>
    <div class="col-md-2 col-sm-3 mb-10 p-0">
      <a
				href="javascript:void(0);"
				onclick="selRoom(<?php echo $mdlFR->getId(); ?>);"
				class="card shadow featured bg-light"
				style="color:#666;"
				id="FloorRoom_<?php echo $mdlFR->getId(); ?>"
			>
        <div
	        class="card-img-top img-featured"
	        style="background-image: url('<?php echo $imgLocation; ?>')"
	        alt="<?php echo $mdlRoom->getName(); ?>"
        ></div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $mdlRoom->getName(); ?></h5>
          <p class="card-text">
            <?php echo $mdlRoom->getDescription(); ?>
          </p>
        </div>
      </a>
    </div>
  <?php
  }
  if (empty($lstFR)) {
    echo 'No Room Attached';
  }
}

function displayParts($floorRoomId){
	$clsParts = new Parts();
	$mdlParts = new PartsModel();
	$clsRP = new RoomPart();
	$mdlRP = new RoomPartModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

  $lstRP = $clsRP->GetByFloorRoom_Id($floorRoomId);

  foreach ($lstRP as $mdlRP) {
		$mdlParts = $clsParts->GetById($mdlRP->getParts_Id());
    $imgLocation = "";
    $lstImage = $clsImage->GetByDetail("parts",$mdlParts->getId(),"original");

    foreach($lstImage as $mdlImage){
      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
    }
    ?>
    <div class="col-md-2 col-sm-3 mb-10 p-0">
      <a
				href="javascript:void(0);"
				onclick="selParts(<?php echo $mdlRP->getId(); ?>);"
				class="card shadow featured bg-light"
				style="color:#666;"
				id="RoomPart_<?php echo $mdlRP->getId(); ?>"
			>
        <div
	        class="card-img-top img-featured"
	        style="background-image: url('<?php echo $imgLocation; ?>')"
	        alt="<?php echo $mdlParts->getName(); ?>"
        ></div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $mdlParts->getName(); ?></h5>
          <p class="card-text">
            <?php echo $mdlParts->getDescription(); ?>
          </p>
        </div>
      </a>
    </div>
  <?php
  }
  if (empty($lstRP)) {
    echo 'No Part Attached';
  }
}

function displayMaterial($RoomPartId){
	$clsMaterial = new Material();
	$mdlMaterial = new MaterialModel();
	$clsPM = new PartMaterial();
	$mdlPM = new PartMaterialModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

  $lstPM = $clsPM->GetByRoomPart_Id($RoomPartId);

  foreach ($lstPM as $mdlPM) {
		$mdlMaterial = $clsMaterial->GetById($mdlPM->getMaterial_Id());
    $imgLocation = "";
    $lstImage = $clsImage->GetByDetail("material",$mdlMaterial->getId(),"original");

    foreach($lstImage as $mdlImage){
      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
    }
    ?>
    <div class="col-md-2 col-sm-3 mb-10 p-0">
      <a
				href="javascript:void(0);"
				onclick="selMaterial(<?php echo $mdlPM->getId() . "," . $RoomPartId; ?>);"
				class="card shadow featured bg-light"
				style="color:#666;"
				id="PartMaterial_<?php echo $mdlPM->getId(); ?>"
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
  if (empty($lstPM)) {
    echo 'No Material Attached';
  }
}

function displayUpgrade($partMaterialId,$RoomPart_Id){
	$clsFI = new FinishItem();
	$mdlFI = new FinishItemModel();
	$clsUpgrade = new Upgrade();
	$mdlUpgrade = new UpgradeModel();
	$clsMU = new MaterialUpgrade();
	$mdlMU = new MaterialUpgradeModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$clsFI->DeleteMaterialChange($_SESSION['Finish_Id'],$RoomPart_Id);
	$mdlFI->setFinish_Id($_SESSION['Finish_Id']);
	$mdlFI->setLayout_Id($_SESSION['Layout_Id']);
	$mdlFI->setPartMaterial_Id($partMaterialId);
	$clsFI->Add($mdlFI);

  $lstMU = $clsMU->GetByPartMaterial_Id($partMaterialId);
?>
<div class="col-md-2 col-sm-3 mb-10 p-0">
	<a
		href="javascript:void(0);"
		onclick="selUpgradeE(<?php echo  $mdlMU->getId() . "," . $partMaterialId; ?>);"
		class="card shadow featured bg-light"
		style="color:#666;"
		id="MaterialUpgrade_0"
	>
		<div class="card-body">
			<h5 class="card-title">No Upgrades</h5>
			<p class="card-text">
				Set to no upgrades connected to Material
			</p>
		</div>
	</a>
</div>

<?php
  foreach ($lstMU as $mdlMU) {
		$mdlUpgrade = $clsUpgrade->GetById($mdlMU->getUpgrade_Id());
    $imgLocation = "";
    $lstImage = $clsImage->GetByDetail("upgrade",$mdlUpgrade->getId(),"original");

    foreach($lstImage as $mdlImage){
      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
    }
    ?>
    <div class="col-md-2 col-sm-3 mb-10 p-0">
      <a
				href="javascript:void(0);"
				onclick="selUpgrade(<?php echo $mdlMU->getId() . "," . $partMaterialId; ?>);"
				class="card shadow featured bg-light"
				style="color:#666;"
				id="MaterialUpgrade_<?php echo $mdlMU->getId(); ?>"
			>
        <div
	        class="card-img-top img-featured"
	        style="background-image: url('<?php echo $imgLocation; ?>')"
	        alt="<?php echo $mdlUpgrade->getName(); ?>"
        ></div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $mdlUpgrade->getName(); ?></h5>
          <p class="card-text">
            <?php echo $mdlUpgrade->getDescription(); ?>
          </p>
        </div>
      </a>
    </div>
  <?php
  }
  if (empty($lstMU)) {
    echo 'No Upgrade Attached';
  }
}

function displayUpgradeSelect($materialUpgradeId,$PartMaterial_Id,$empty){
	$clsFI = new FinishItem();
	$mdlFI = new FinishItemModel();

	$clsFI->DeleteUpgradeChange($_SESSION['Finish_Id'],$_SESSION['Layout_Id'],$PartMaterial_Id);
	if ($empty=='false') {
		$mdlFI->setFinish_Id($_SESSION['Finish_Id']);
		$mdlFI->setLayout_Id($_SESSION['Layout_Id']);
		$mdlFI->setPartMaterial_Id($PartMaterial_Id);
		$mdlFI->setMaterialUpgrade_Id($materialUpgradeId);
		$clsFI->Add($mdlFI);
			echo 'add';
	}else{
		echo 'deleted only';
	}
}


/* SHOW ----------------------------------------------------- SHOW */
function showFloor($layoutId){
	$clsLayout = new Layout();
	$mdlLayout = new LayoutModel();
	$clsLayoutFloor = new LayoutFloor();
	$mdlLayoutFloor = new LayoutFloorModel();
	$clsFloor = new Floor();
	$mdlFloor = new FloorModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$mdlLayout = $clsLayout->GetById($layoutId);

	$lstFloor = $clsFloor->GetFloorNotLayout($layoutId);
	?>
	<div class="modal-header">
		<h5 class="modal-title">Manage Floor</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<h5>Layout Details</h5>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				Name
			</div>
			<div class="col-md-8">
				<?php echo $mdlLayout->getName(); ?>
			</div>
		</div>
		<div class="row" style="margin-top:20px;">
			<div class="col-lg-6 col-md-12" style="overflow-x:auto;">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Layout Floor</h3>
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
								$lstLayoutFloor = $clsLayoutFloor->GetByLayout_Id($mdlLayout->getId());
								foreach($lstLayoutFloor as $mdlLayoutFloor)
								{
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("floor",$mdlLayoutFloor->getFloor_Id(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $clsFloor->GetNameById($mdlLayoutFloor->getFloor_Id()); ?></td>
										<td>
											<a href="JavaScript:void(0);" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Remove" onclick="deleteFloor(<?php echo $mdlLayoutFloor->getId().",".$mdlLayout->getId(); ?>);">
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
						<h3 class="panel-title">Floor</h3>
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
								$lstFloor = $clsFloor->GetFloorNotLayout($mdlLayout->getId());
								foreach($lstFloor as $mdlFloor)
								{
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("floor",$mdlFloor->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlFloor->getName(); ?></td>
										<td>
											<a href="JavaScript:void(0);" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Add"  onclick="addFloor(<?php echo  $mdlLayout->getId() . "," . $mdlFloor->getId(); ?>);showFloor(<?php echo $layoutId; ?>);">
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

function showRoom($layoutfloorId){
	$clsLF = new LayoutFloor();
	$clsFloor = new Floor();
	$mdlFloor = new FloorModel();
	$clsFR = new FloorRoom();
	$mdlFR = new FloorRoomModel();
	$clsRoom = new Room();
	$mdlRoom = new RoomModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$mdlLF = $clsLF->GetById($layoutfloorId);
	$mdlFloor = $clsFloor->GetById($mdlLF->getFloor_Id());
	$lstRoom = $clsRoom->GetNotFloor_Id($mdlFloor->getId());
	?>
	<div class="modal-header">
		<h5 class="modal-title">Manage Room</h5>
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
		<div class="row" style="margin-top:20px;">
			<div class="col-lg-6 col-md-12" style="overflow-x:auto;">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Floor Room</h3>
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
								$lstFR = $clsFR->GetByLayoutFloor_Id($mdlLF->getId());
								foreach($lstFR as $mdlFR)
								{
									$mdlRoom = $clsRoom->GetById($mdlFR->getRoom_Id());
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("room",$mdlRoom->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlRoom->getName(); ?></td>
										<td>
											<a
												href="JavaScript:void(0);"
												class="btn btn-sm btn-icon btn-pure btn-default"
												data-toggle="tooltip"
												title="Remove"
												onclick="deleteRoom(<?php echo $mdlFR->getId().",".$mdlLF->getId(); ?>);"
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
						<h3 class="panel-title">Room</h3>
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
								$lstRoom = $clsRoom->GetNotFloor_Id($mdlFloor->getId());
								foreach($lstRoom as $mdlRoom)
								{
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("room",$mdlRoom->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlRoom->getName(); ?></td>
										<td>
											<a
												href="JavaScript:void(0);"
												class="btn btn-sm btn-icon btn-pure btn-default"
												data-toggle="tooltip" title="Add"
												onclick="addRoom(<?php echo  $mdlLF->getId().",".$mdlRoom->getId(); ?>);"
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

function showPart($floorroomId){
	$clsFR = new FloorRoom();
	$clsRoom = new Room();
	$mdlRoom = new RoomModel();
	$clsRP = new RoomPart();
	$mdlRP = new RoomPartModel();
	$clsParts = new Parts();
	$mdlParts = new PartsModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$mdlFR = $clsFR->GetById($floorroomId);
	$mdlRoom = $clsRoom->GetById($mdlFR->getRoom_Id());
	$lstParts = $clsParts->GetNotRoom_Id($mdlRoom->getId());
	?>
	<div class="modal-header">
		<h5 class="modal-title">Manage Parts</h5>
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
						<h3 class="panel-title">Room Parts</h3>
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
								$lstRP = $clsRP->GetByFloorRoom_Id($mdlFR->getId());
								foreach($lstRP as $mdlRP)
								{
									$mdlParts = $clsParts->GetById($mdlRP->getParts_Id());
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("parts",$mdlParts->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlParts->getName(); ?></td>
										<td>
											<a
												href="JavaScript:void(0);"
												class="btn btn-sm btn-icon btn-pure btn-default"
												data-toggle="tooltip"
												title="Remove"
												onclick="deleteParts(<?php echo $mdlRP->getId().",".$mdlFR->getId(); ?>);"
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
						<h3 class="panel-title">Parts</h3>
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
								$lstParts = $clsParts->GetNotRoom_Id($mdlRoom->getId());
								foreach($lstParts as $mdlParts)
								{
									?>
									<tr>
										<td>
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("parts",$mdlParts->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
											}
											?>
										</td>
										<td><?php echo $mdlParts->getName(); ?></td>
										<td>
											<a
												href="JavaScript:void(0);"
												class="btn btn-sm btn-icon btn-pure btn-default"
												data-toggle="tooltip" title="Add"
												onclick="addParts(<?php echo  $mdlFR->getId().",".$mdlParts->getId(); ?>);"
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
	$clsParts = new Parts();
	$mdlParts = new PartsModel();
	$clsPM = new PartMaterial();
	$mdlPM = new PartMaterialModel();
	$clsMaterial = new Material();
	$mdlMaterial = new MaterialModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$mdlRP = $clsRP->GetById($roompartId);
	$mdlParts = $clsParts->GetById($mdlRP->getParts_Id());
	$lstMaterial = $clsMaterial->GetNotParts_Id($mdlParts->getId());
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
		<div class="row" style="margin-top:20px;">
			<div class="col-lg-6 col-md-12" style="overflow-x:auto;">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Floor Room</h3>
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
								$lstMaterial = $clsMaterial->GetNotParts_Id($mdlParts->getId());
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

function addFloor($layoutId,$floorId){
	$cls = new LayoutFloor();
	$mdl = new LayoutFloorModel();
	$mdl->setLayout_Id($layoutId);
	$mdl->setFloor_Id($floorId);
	$cls->Add($mdl);
	displayFloor($layoutId);
}

function addRoom($layoutFloorId,$roomId){
	$cls = new FloorRoom();
	$mdl = new FloorRoomModel();
	$mdl->setLayoutFloor_Id($layoutFloorId);
	$mdl->setRoom_Id($roomId);
	$cls->Add($mdl);
	displayRoom($layoutFloorId);
}

function addParts($floorRoomId,$partId){
	$cls = new RoomPart();
	$mdl = new RoomPartModel();
	$mdl->setFloorRoom_Id($floorRoomId);
	$mdl->setParts_Id($partId);
	$cls->Add($mdl);
	displayParts($floorRoomId);
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

function deleteFloor($id){
	$cls = new LayoutFloor();
	$rId = $cls->GetLayout_IdById($id);
	$cls->Delete($id);
	displayFloor($rId);
}

function deleteRoom($id){
	$cls = new FloorRoom();
	$rId = $cls->GetLayoutFloor_IdById($id);
	$cls->Delete($id);
	displayRoom($rId);
}

function deleteParts($id){
	$cls = new RoomPart();
	$rId = $cls->GetFloorRoom_IdById($id);
	$cls->Delete($id);
	displayParts($rId);
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
