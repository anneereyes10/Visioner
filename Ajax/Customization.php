<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Project.php");
require_once ("../App_Code/ProjectModel.php");
require_once ("../App_Code/Finish.php");
require_once ("../App_Code/FinishModel.php");
require_once ("../App_Code/FinishItem.php");
require_once ("../App_Code/FinishItemModel.php");
require_once ("../App_Code/UserProject.php");
require_once ("../App_Code/UserProjectModel.php");
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

switch ($call)
{
	case 'filterLayout':
	{
		filterLayout($_GET['Size_Min'],$_GET['Size_Max'],$_GET['Price_Min'],$_GET['Price_Max'],$_GET['Bedroom_Min'],$_GET['Bedroom_Max'],$_GET['Bathroom_Min'],$_GET['Bathroom_Max'],$_GET['Parking_Min'],$_GET['Parking_Max']);
		break;
	}
	case 'addProject':
	{
		addProject($_GET['Name']);
		break;
	}
	case 'finish':	{
		setFinish($_GET['Finish_Id'],$_GET['Project_Id']);
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
		displayUpgrade($_GET['Id'],$_GET['rp']);
		break;
	}
	case 'upgradeselect':	{
		UpgradeSelect($_GET['Id'],$_GET['PartMaterial_Id']);
		break;
	}
	case 'Delete':	{
		Delete($_GET['Id']);
		break;
	}
	case 'projectItem':	{
		ProjectItem();
		break;
	}
}

function filterLayout($Size_Min,$Size_Max, $Price_Min,$Price_Max, $Bedroom_Min,$Bedroom_Max, $Bathroom_Min,$Bathroom_Max, $Parking_Min,$Parking_Max){
	$clsProject = new Project();
	$clsLayout = new Layout();
	$mdlLayoutMin = new LayoutModel();
	$mdlLayoutMax = new LayoutModel();
	$clsImage = new Image();

	$mdlLayoutMin->setSize($Size_Min);
	$mdlLayoutMax->setSize($Size_Max);
	$mdlLayoutMin->setPrice($Price_Min);
	$mdlLayoutMax->setPrice($Price_Max);
	$mdlLayoutMin->setBedroom($Bedroom_Min);
	$mdlLayoutMax->setBedroom($Bedroom_Max);
	$mdlLayoutMin->setBathroom($Bathroom_Min);
	$mdlLayoutMax->setBathroom($Bathroom_Max);
	$mdlLayoutMin->setParking($Parking_Min);
	$mdlLayoutMax->setParking($Parking_Max);

	$lstLayout = $clsLayout->SearchByMinMax($mdlLayoutMin,$mdlLayoutMax);

	foreach ($lstLayout as $mdlLayout) {
		$imgLocation = "";
		$lstImage = $clsImage->GetByDetail("layout",$mdlLayout->getId(),"original");
		foreach($lstImage as $mdlImage){
			$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
		}
		?>
			<div class="thumbnail col-md-3">
				<a href="#plan<?php echo $mdlLayout->getId(); ?>" data-toggle="modal">
					<div class="img-featured" style="background-image: url('<?php echo $imgLocation; ?>');" alt="<?php echo $mdlLayout->getName(); ?>"></div>
				</a>
				<div class="dot-hr"></div>
				<!-- <div class="caption" click="alert('hello')"> -->
				<div class="caption">
					<center>
						<label class="radio-jumee">
							<input
								type="radio"
								style="margin:0px;"
								name="plan"
								onchange="selLayout(<?php echo $mdlLayout->getId(); ?>);getItems();"
								<?php echo ($mdlLayout->getId() == $clsProject->GetLayout_IdById($_SESSION['projectId']))?'checked':''; ?>
							/>
							<br>
							<strong>
								<?php echo $mdlLayout->getName(); ?>
							</strong>
						</label>
					</center>
				</div>

			</div>


			<div class="modal fade" id="plan<?php echo $mdlLayout->getId(); ?>" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><?php echo $mdlLayout->getName(); ?></h4>
						</div>
						<div class="modal-body text-center">
							<img src="<?php echo $imgLocation; ?>" alt="plan" style="width:50%">
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<?php
		}
}

function addProject($name){
  $clsProject = new Project();
  $mdlProject = new ProjectModel();
  $msg = "";

  $mdlProject->setName($name);
  $mdlProject->setUser_Id($_SESSION['uid']);

  $duplicate = $clsProject->IsExist($mdlProject);
  if($name != ''){
	  if($duplicate){
	    $msg .= '
	    <div class="alert alert-danger alert-dismissible" role="alert">
	    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">×</span>
	    <span class="sr-only">Close</span>
	    </button>
	    <h4>Duplicate of Information Detected. </h4>
	    '.$duplicate['msg'].'
	    </div>';
	  }else{
	    $ProjectName = $clsProject->Add($mdlProject);
	    $msg .= '
	      <div class="alert alert-success alert-dismissible" role="alert">
	      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	      <span aria-hidden="true">×</span>
	      <span class="sr-only">Close</span>
	      </button>
	      <h6>
	        Successfully Added New Layout.
	      </h6>
	      </div>
	         ';
	  }
	}else{
	$msg .= '
		<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
		<span class="sr-only">Close</span>
		</button>
		<h6>
			Name missing.
		</h6>
		</div>
			 ';
	}

  echo $msg;

}

function setFinish($Finish_Id,$Project_Id){
	$clsProject = new Project();
	$clsUP = new UserProject();
	$mdlUP = new UserProjectModel();
	$clsFI = new FinishItem();

	$mdlProject = $clsProject->GetById($Project_Id);
	$lstFI = $clsFI->GetByFinish_IdLayout_Id($Finish_Id,$mdlProject->getLayout_Id());

	$clsUP->DeleteByProjectId($Project_Id);
	foreach ($lstFI as $mdlFI) {
		$mdlUP->setProject_Id($Project_Id);
		$mdlUP->setPartMaterial_Id($mdlFI->getPartMaterial_Id());
		$mdlUP->setMaterialUpgrade_Id($mdlFI->getMaterialUpgrade_Id());
		$clsUP->Add($mdlUP);
	}
}

/* DISPLAY----------------------------------------------------- DISPLAY */
function displayFloor($layoutId){
	$clsFloor = new Floor();
	$mdlFloor = new FloorModel();
	$clsLF = new LayoutFloor();
	$mdlLF = new LayoutFloorModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$clsProject = new Project();

	$clsProject->UpdateLayout_Id($_SESSION['projectId'],$layoutId);
	$lstLF = $clsLF->GetByLayout_Id($layoutId);

  foreach ($lstLF as $mdlLF) {
		$mdlFloor = $clsFloor->GetById($mdlLF->getFloor_Id());
    $imgLocation = "";
    $lstImage = $clsImage->GetByDetail("floor",$mdlFloor->getId(),"original");
    foreach($lstImage as $mdlImage){
      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
    }
    ?>
			<div class="thumbnail col-md-3">
				<a href="#layoutfloor<?php echo $mdlLF->getId(); ?>" data-toggle="modal">
					<div
						class="img-featured"
						style="background-image: url('<?php echo $imgLocation; ?>');"
						alt="<?php echo $mdlFloor->getName(); ?>"
					></div>
				</a>
				<div class="dot-hr"></div>
				<div class="caption">
					<center>
						<label class="radio-jumee">
							<input type="radio" style="margin:0px;" name="floor" onchange="selFloor(<?php echo $mdlLF->getId(); ?>);"><br>
							<strong>
								<?php echo $mdlFloor->getName(); ?>
							</strong>
						</label>
					</center>
				</div>
			</div>


      <div class="modal fade" id="layoutfloor<?php echo $mdlLF->getId(); ?>" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><?php echo $mdlFloor->getName(); ?></h4>
            </div>
            <div class="modal-body text-center">
              <img src="<?php echo $imgLocation; ?>" alt="floor" style="width:50%">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
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
		<div class="thumbnail col-md-3">
			<a href="#floorroom<?php echo $mdlFR->getId(); ?>" data-toggle="modal">
				<div
					class="img-featured"
					style="background-image: url('<?php echo $imgLocation; ?>');"
					alt="<?php echo $mdlRoom->getName(); ?>"
				></div>
			</a>
			<div class="dot-hr"></div>
			<div class="caption">
				<center>
					<label class="radio-jumee">
						<input type="radio" style="margin:0px;" name="room" onchange="selRoom(<?php echo $mdlFR->getId(); ?>);"><br>
						<strong>
							<?php echo $mdlRoom->getName(); ?>
						</strong>
					</label>
				</center>
			</div>
		</div>


		<div class="modal fade" id="floorroom<?php echo $mdlFR->getId(); ?>" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><?php echo $mdlRoom->getName(); ?></h4>
					</div>
					<div class="modal-body text-center">
						<img src="<?php echo $imgLocation; ?>" alt="room" style="width:50%">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
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
		<div class="thumbnail col-md-3">
			<a href="#roompart<?php echo $mdlRP->getId(); ?>" data-toggle="modal">
				<div
					class="img-featured"
					style="background-image: url('<?php echo $imgLocation; ?>');"
					alt="<?php echo $mdlParts->getName(); ?>"
				></div>
			</a>
			<div class="dot-hr"></div>
			<div class="caption">
				<center>
					<label class="radio-jumee">
						<input type="radio" style="margin:0px;" name="part" onchange="selParts(<?php echo $mdlRP->getId(); ?>);"><br>
						<strong>
							<?php echo $mdlParts->getName(); ?>
						</strong>
					</label>
				</center>
			</div>
		</div>


		<div class="modal fade" id="roompart<?php echo $mdlRP->getId(); ?>" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><?php echo $mdlParts->getName(); ?></h4>
					</div>
					<div class="modal-body text-center">
						<img src="<?php echo $imgLocation; ?>" alt="part" style="width:50%">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
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
	$clsUP = new UserProject();
	$mdlUP = new UserProjectModel();

  $lstPM = $clsPM->GetByRoomPart_Id($RoomPartId);
	?>


<div class="well well-lg col-md-12">
	<strong>Material Options</strong><br><br>
	<div>

		<?php
		  foreach ($lstPM as $mdlPM) {
				$mdlMaterial = $clsMaterial->GetById($mdlPM->getMaterial_Id());
		    $imgLocation = "";
		    $lstImage = $clsImage->GetByDetail("material",$mdlMaterial->getId(),"original");

		    foreach($lstImage as $mdlImage){
		      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
		    }
		    ?>
				<div class="thumbnail col-md-3">
					<a href="#partmaterial<?php echo $mdlPM->getId(); ?>" data-toggle="modal">
						<div
							class="img-featured"
							style="background-image: url('<?php echo $imgLocation; ?>');"
							alt="<?php echo $mdlMaterial->getName(); ?>"
						></div>
					</a>
					<div class="dot-hr"></div>
					<div class="caption">
						<center>
							<label class="radio-jumee">
								<input
									type="radio"
									style="margin:0px;"
									name="material"
									onchange="selMaterial(<?php echo $mdlPM->getId().','.$RoomPartId; ?>);"
									<?php
										$mdlUP->setProject_Id($_SESSION['projectId']);
										$mdlUP->setPartMaterial_Id($mdlPM->getId());
										$mdlUP->setMaterialUpgrade_Id('0');
										if ($clsUP->IsExist($mdlUP)) {
											echo 'checked';
										}
									?>
								><br>
								<strong>
									<?php echo $mdlMaterial->getName(); ?>
								</strong>
							</label>
						</center>
					</div>
				</div>


				<div class="modal fade" id="partmaterial<?php echo $mdlPM->getId(); ?>" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><?php echo $mdlMaterial->getName(); ?></h4>
							</div>
							<div class="modal-body text-center">
								<img src="<?php echo $imgLocation; ?>" alt="material" style="width:50%">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
		  <?php
		  }
		  if (empty($lstPM)) {
		    echo 'No Material Attached';
		  }
			?>

      </div>
    </div>

		<div class="well well-lg col-md-12">
			<strong>Upgrade Options</strong><br><br>
			<div id="Upgrade">
				<?php
				displayUpgrade($mdlPM->getId(),$RoomPartId,false);
				?>
			</div>
		</div>
	<?php
}

function displayUpgrade($partMaterialId,$RoomPartId,$add = true){
	$clsUpgrade = new Upgrade();
	$mdlUpgrade = new UpgradeModel();
	$clsMU = new MaterialUpgrade();
	$mdlMU = new MaterialUpgradeModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$clsUP = new UserProject();
	$mdlUP = new UserProjectModel();

	if ($add) {
		$clsUP->DeleteMaterialChange($_SESSION['projectId'],$RoomPartId);
		$mdlUP->setProject_Id($_SESSION['projectId']);
		$mdlUP->setPartMaterial_Id($partMaterialId);
		$mdlUP->setMaterialUpgrade_Id('');
		$clsUP->Add($mdlUP);
	}

  $lstMU = $clsMU->GetByPartMaterial_Id($partMaterialId);

  foreach ($lstMU as $mdlMU) {
		$mdlUpgrade = $clsUpgrade->GetById($mdlMU->getUpgrade_Id());
    $imgLocation = "";
    $lstImage = $clsImage->GetByDetail("upgrade",$mdlUpgrade->getId(),"original");

    foreach($lstImage as $mdlImage){
      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
    }
    ?>
		<div class="thumbnail col-md-3">
			<a href="#materialupgrade<?php echo $mdlMU->getId(); ?>" data-toggle="modal">
				<div
					class="img-featured"
					style="background-image: url('<?php echo $imgLocation; ?>');"
					alt="<?php echo $mdlUpgrade->getName(); ?>"
				></div>
			</a>
			<div class="dot-hr"></div>
			<div class="caption">
				<center>
					<label class="radio-jumee">
						<input
							type="radio"
							style="margin:0px;"
							name="upgrade"
							onchange="selUpgrade(<?php echo $mdlMU->getId().",".$partMaterialId; ?>);"
							<?php

								$mdlUP->setProject_Id($_SESSION['projectId']);
								$mdlUP->setPartMaterial_Id($partMaterialId);
								$mdlUP->setMaterialUpgrade_Id($mdlMU->getId());
								if ($clsUP->IsExist($mdlUP)) {
									echo 'checked';
								}else{
									echo $_SESSION['projectId'].",".$mdlMU->getId().",".$partMaterialId;
								}
							?>
						><br>
						<strong>
							<?php echo $mdlUpgrade->getName(); ?>
						</strong>
					</label>
				</center>
			</div>
		</div>


		<div class="modal fade" id="materialupgrade<?php echo $mdlMU->getId(); ?>" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><?php echo $mdlUpgrade->getName(); ?></h4>
					</div>
					<div class="modal-body text-center">
						<img src="<?php echo $imgLocation; ?>" alt="upgrade" style="width:50%">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
  <?php
  }
  if (empty($lstMU)) {
    echo 'No Upgrade Attached';
  }
}


function UpgradeSelect($materialUpgradeId,$PartMaterial_Id){
	$clsUP = new UserProject();
	$mdlUP = new UserProjectModel();

	$clsUP->DeleteUpgradeChange($_SESSION['projectId'],$PartMaterial_Id);
	$mdlUP->setProject_Id($_SESSION['projectId']);
	$mdlUP->setPartMaterial_Id($PartMaterial_Id);
	$mdlUP->setMaterialUpgrade_Id($materialUpgradeId);
	$clsUP->Add($mdlUP);
}

function Delete($pid)
{
	$clsProject = new Project();
	$clsProject->Delete($pid);
}

function ProjectItem()
{
	$totalPrice = 0;
	$txtout = '';
	$clsProject 	= new Project();
	$mdlProject 	= new ProjectModel();
	$clsUP 				= new UserProject();
	$mdlUP 				= new UserProjectModel();

	$clsL 				= new Layout();
	$mdlL 				= new LayoutModel();
	$clsLF 				= new LayoutFloor();
	$mdlLF 				= new LayoutFloorModel();
	$clsF 				= new Floor();
	$mdlF 				= new FloorModel();
	$clsFR 				= new FloorRoom();
	$mdlFR 				= new FloorRoomModel();
	$clsR 				= new Room();
	$mdlR		 			= new RoomModel();
	$clsRP 				= new RoomPart();
	$mdlRP 				= new RoomPartModel();
	$clsP 				= new Parts();
	$mdlP 				= new PartsModel();
	$clsPM 				= new PartMaterial();
	$mdlPM 				= new PartMaterialModel();
	$clsM 				= new Material();
	$mdlM					= new MaterialModel();
	$clsMU 				= new MaterialUpgrade();
	$mdlMU 				= new MaterialUpgradeModel();
	$clsU 				= new Upgrade();
	$mdlU 				= new UpgradeModel();

	$lstUP = $clsUP->GetByProject_Id($_SESSION['projectId']);
	$layoutId = $clsProject->GetLayout_IdById($_SESSION['projectId']);
	$txtout .= '<ul>';
	$mdlL = $clsL->GetById($layoutId);
	$txtout .= '<li>'.$mdlL->getName().'</li>';

	$lstLF = $clsLF->GetByLayout_Id($layoutId);
	foreach ($lstLF as $mdlLF) {
		$txtout .= '<ul>';
		$mdlF = $clsF->GetById($mdlLF->getFloor_Id());
		$txtout .= '<li>'.$mdlF->getName().'</li>';

		$lstFR = $clsFR->GetByLayoutFloor_Id($mdlLF->getId());
		foreach ($lstFR as $mdlFR) {
			$txtout .= '<ul>';
			$mdlR = $clsR->GetById($mdlFR->getRoom_Id());
			$txtout .= '<li>'.$mdlR->getName().'</li>';

			$lstRP = $clsRP->GetByFloorRoom_Id($mdlFR->getId());
			foreach ($lstRP as $mdlRP) {
				$txtout .= '<ul>';
				$mdlP = $clsP->GetById($mdlRP->getParts_Id());
				$txtout .= '<li>'.$mdlP->getName().'</li>';

				$lstPM = $clsPM->GetByRoomPart_Id($mdlRP->getId());
				foreach ($lstPM as $mdlPM) {

					$mdlUP->setProject_Id($_SESSION['projectId']);
					$mdlUP->setPartMaterial_Id($mdlPM->getId());
					$mdlUP->setMaterialUpgrade_Id('0');
					if ($clsUP->IsExist($mdlUP)) {
						$mdlM = $clsM->GetById($mdlPM->getMaterial_Id());
						$totalPrice += $mdlM->getPrice();
						$txtout .= '<ul>';
						$txtout .= '<li>
													<div class="col-sm-6" style="padding:0px;">'.$mdlM->getName().'</div>
													<div class="col-sm-6 text-right" style="padding:0px;">'.$mdlM->getPrice().'Php</div>
												</li>';

						$lstMU = $clsMU->GetByPartMaterial_Id($mdlPM->getId());
						foreach ($lstMU as $mdlMU) {

							$mdlUP->setProject_Id($_SESSION['projectId']);
							$mdlUP->setPartMaterial_Id($mdlPM->getId());
							$mdlUP->setMaterialUpgrade_Id($mdlMU->getId());
							if ($clsUP->IsExist($mdlUP)) {
								$txtout .= '<ul>';
								$mdlU = $clsU->GetById($mdlMU->getUpgrade_Id());
								$totalPrice += $mdlU->getPrice();
								$txtout .= '<li>
															<div class="col-sm-6" style="padding:0px;">'.$mdlU->getName().'</div>
															<div class="col-sm-6 text-right" style="padding:0px;">'.$mdlU->getPrice().'Php</div>
														</li>';

								$txtout .= '</ul>';
							}
						}
						$txtout .= '</ul>';
					}

				}

				$txtout .= '</ul>';
			}

			$txtout .= '</ul>';
		}

		$txtout .= '</ul>';
	}

		$txtout .= '</ul>';
			$txtout .= '<hr>';
	$txtout .= '
							<div class="col-sm-6" style="padding:0px;">Estimated Price: </div>
							<div class="col-sm-6 text-right" style="padding:0px;">'.$totalPrice.'Php</div>
							';
	echo $txtout;
}

function InList() {

}
