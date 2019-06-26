<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Project.php");
require_once ("../App_Code/Finish.php");
require_once ("../App_Code/FinishItem.php");
require_once ("../App_Code/UserProject.php");
require_once ("../App_Code/Plan.php");
require_once ("../App_Code/Category.php");
require_once ("../App_Code/Part.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/Upgrade.php");
require_once ("../App_Code/Unit.php");
require_once ("../App_Code/Image.php");

$call = $_GET['call'];

switch ($call)
{
	case 'filterPlan':	{
		filterPlan($_GET['Size_Min'],$_GET['Size_Max'],$_GET['Price_Min'],$_GET['Price_Max'],$_GET['Bedroom_Min'],$_GET['Bedroom_Max'],$_GET['Bathroom_Min'],$_GET['Bathroom_Max'],$_GET['Parking_Min'],$_GET['Parking_Max']);
		break;
	}
	case 'addProject':	{
		addProject($_GET['Name']);
		break;
	}
	case 'addMaterial':	{
		addMaterial($_GET['Id'],$_GET['PartId']);
		break;
	}
	case 'addUpgrade':	{
		addUpgrade($_GET['Id'],$_GET['PartId']);
		break;
	}
	case 'finish':	{
		setFinish($_GET['Finish_Id'],$_GET['Project_Id']);
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
		displayUpgrade($_GET['Id'],$_GET['rp']);
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

function filterPlan($Size_Min,$Size_Max, $Price_Min,$Price_Max, $Bedroom_Min,$Bedroom_Max, $Bathroom_Min,$Bathroom_Max, $Parking_Min,$Parking_Max){
	$clsProject = new Project();
	$clsPlan = new Plan();
	$mdlPlanMin = new PlanModel();
	$mdlPlanMax = new PlanModel();
	$clsImage = new Image();

	$mdlPlanMin->setSize($Size_Min);
	$mdlPlanMax->setSize($Size_Max);
	$mdlPlanMin->setPrice($Price_Min);
	$mdlPlanMax->setPrice($Price_Max);
	$mdlPlanMin->setBedroom($Bedroom_Min);
	$mdlPlanMax->setBedroom($Bedroom_Max);
	$mdlPlanMin->setBathroom($Bathroom_Min);
	$mdlPlanMax->setBathroom($Bathroom_Max);
	$mdlPlanMin->setParking($Parking_Min);
	$mdlPlanMax->setParking($Parking_Max);

	$lstPlan = $clsPlan->SearchByMinMax($mdlPlanMin,$mdlPlanMax);

	if (count($lstPlan) <= 0) {
		echo "No Plans Found";
	}

	foreach ($lstPlan as $mdlPlan) {
		$imgLocation = "";
		$lstImage = $clsImage->GetByDetail("plan",$mdlPlan->getId(),"original");
		foreach($lstImage as $mdlImage){
			$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
		}
		?>
			<div class="thumbnail col-md-3">
				<a href="#plan<?php echo $mdlPlan->getId(); ?>" data-toggle="modal">
					<div class="img-featured" style="background-image: url('<?php echo $imgLocation; ?>');" alt="<?php echo $mdlPlan->getName(); ?>"></div>
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
								onchange="selPlan(<?php echo $mdlPlan->getId(); ?>);getItems();"
								<?php echo ($mdlPlan->getId() == $clsProject->GetPlan_IdById($_SESSION['projectId']))?'checked':''; ?>
							/>
							<br>
							<strong>
								<?php echo $mdlPlan->getName(); ?>
							</strong>
						</label>
					</center>
				</div>

			</div>


			<div class="modal fade" id="plan<?php echo $mdlPlan->getId(); ?>" role="dialog">
				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title"><?php echo $mdlPlan->getName(); ?></h4>
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
	  if($duplicate['val']){
	    $msg = 'duplicate';
	  }else{
	    $projectId = $clsProject->Add($mdlProject);
	    $msg = $projectId;
	  }
	}else{
	$msg = 'missing';
	}

  echo $msg;

}

function addMaterial($Material_Id,$Part_Id){
  $clsProject = new Project();
  $mdlProject = new ProjectModel();
  $clsUP = new UserProject();
  $mdlUP = new UserProjectModel();
  $clsMaterial = new Material();

	$clsUP->DeleteMaterialChange($_SESSION['projectId'],$Part_Id);
	if ($Material_Id != '0') {
		$mdlUP->setProject_Id($_SESSION['projectId']);
		$mdlUP->setMaterial_Id($Material_Id);
		$mdlUP->setUpgrade_Id('0');
		$clsUP->Add($mdlUP);
	}

}


function addUpgrade($Upgrade_Id,$Part_Id){
  $clsProject = new Project();
  $mdlProject = new ProjectModel();
  $clsUP = new UserProject();
  $mdlUP = new UserProjectModel();
  $clsUpgrade = new Upgrade();
	$clsUP->DeleteUpgradeChange($_SESSION['projectId'],$Part_Id);
	if ($Upgrade_Id != '0') {
		$mdlUP->setProject_Id($_SESSION['projectId']);
		$mdlUP->setMaterial_Id('0');
		$mdlUP->setUpgrade_Id($Upgrade_Id);
		$clsUP->Add($mdlUP);
	}

}

function setFinish($Finish_Id,$Project_Id){
	$clsProject = new Project();
	$clsUP = new UserProject();
	$mdlUP = new UserProjectModel();
	$clsFI = new FinishItem();
	$mdlFI = new FinishItemModel();

	$mdlProject = $clsProject->GetById($Project_Id);
	$lstFI = $clsFI->GetByFinish_IdPlan_Id($Finish_Id,$mdlProject->getPlan_Id());

	$clsUP->DeleteByProject_Id($Project_Id);
	foreach ($lstFI as $mdlFI) {
		$mdlUP->setProject_Id($Project_Id);
		$mdlUP->setMaterial_Id($mdlFI->getMaterial_Id());
		$mdlUP->setUpgrade_Id($mdlFI->getUpgrade_Id());
		$clsUP->Add($mdlUP);
	}
}

/* DISPLAY----------------------------------------------------- DISPLAY */
function displayCategory($Plan_Id){
	$clsCategory = new Category();
	$mdlCategory = new CategoryModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$clsProject = new Project();
	if (empty($clsProject->GetPlan_IdById($_SESSION['projectId']))) {
		$clsProject->UpdatePlan_Id($_SESSION['projectId'],$Plan_Id);
		setFinish('1',$_SESSION['projectId']);
	}else {
		$clsProject->UpdatePlan_Id($_SESSION['projectId'],$Plan_Id);
	}
	$lstCategory = $clsCategory->GetByPlan_Id($Plan_Id);

	  if (empty($lstCategory)) {
	    echo 'No Category Attached';
	  }else{

			?>
			<select id="selcategory" name="category" onchange="selCategory()" class="form-control">
				<option selected disabled>Choose Category</option>
				<?php
			  foreach ($lstCategory as $mdlCategory) {
			    ?>
						<option value="<?php echo $mdlCategory->getId(); ?>">
							<?php echo $mdlCategory->getName(); ?>
						</option>
			  <?php
			  }
				?>
			</select>
			<?php
		}
}


function displayPart($Category_Id){
	$clsPart = new Part();
	$mdlPart = new PartModel();
	$clsMaterial = new Material();
	$mdlMaterial = new MaterialModel();
	$clsUpgrade = new Upgrade();
	$mdlUpgrade = new UpgradeModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

  $lstPart = $clsPart->GetByCategory_Id($Category_Id);

  if (empty($lstPart)) {
    echo 'No Part Attached';
  }else{
		foreach ($lstPart as $mdlPart) {
			?>
			<div class="row">
				<div class="col-sm-12">
					<h6><?php echo $mdlPart->getName(); ?></h6>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<?php displayMaterial($mdlPart->getId()); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="row">
						<div class="col-sm-12">
							<h6>Upgrades</h6>
						</div>
					</div>
						<div class="row">
							<div class="col-sm-12">
								<?php displayUpgrade($mdlPart->getId()); ?>
							</div>
						</div>
				</div>
			</div>
			<?php
		}
	}
}

function displayMaterial($Part_Id){
	$clsMaterial = new Material();
	$mdlMaterial = new MaterialModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$clsUP = new UserProject();
	$mdlUP = new UserProjectModel();

  $lstMaterial = $clsMaterial->GetByPart_Id($Part_Id);

  if (empty($lstMaterial)) {
    echo 'No Material Attached';
  }else{
		foreach ($lstMaterial as $mdlMaterial) {
			$imgLocation = "";
			$lstImage = $clsImage->GetByDetail("material",$mdlMaterial->getId(),"original");

			foreach($lstImage as $mdlImage){
				$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
			}
			?>
			<div class="thumbnail col-md-3">
				<a href="#material<?php echo $mdlMaterial->getId(); ?>" data-toggle="modal">
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
							name="material<?php echo $Part_Id; ?>"
							onchange="selMaterial(<?php echo $mdlMaterial->getId().','.$Part_Id; ?>);"
							<?php
							$mdlUP->setProject_Id($_SESSION['projectId']);
							$mdlUP->setMaterial_Id($mdlMaterial->getId());
							$mdlUP->setUpgrade_Id('0');
							if ($clsUP->IsExist($mdlUP)) {
								echo 'checked';
							}
							?>
							><br>
							<strong>
								<?php echo $mdlMaterial->getName(); ?>
							</strong>
							<p>
								+ <?php echo $mdlMaterial->getPrice(); ?> Php
							</p>
						</label>
					</center>
				</div>
			</div>


			<div class="modal fade" id="material<?php echo $mdlMaterial->getId(); ?>" role="dialog">
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

	}
}

function displayUpgrade($Part_Id){
	$clsUpgrade = new Upgrade();
	$mdlUpgrade = new UpgradeModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();
	$clsUP = new UserProject();
	$mdlUP = new UserProjectModel();


  $lstUpgrade = $clsUpgrade->GetByPart_Id($Part_Id);
  if (empty($lstUpgrade)) {
    echo 'No Upgrade Attached';
  }else{
		?>

		<div class="thumbnail col-md-3">
			<div class="caption">
				<center>
					<label class="radio-jumee">
						<input
						type="radio"
						style="margin:0px;"
						name="upgrade<?php echo $Part_Id; ?>"
						onchange="selUpgrade(0,<?php echo $Part_Id; ?>);"
						><br>
						<strong>
							None
						</strong>
					</label>
				</center>
			</div>
		</div>

		<?php
		foreach ($lstUpgrade as $mdlUpgrade) {
			$imgLocation = "";
			$lstImage = $clsImage->GetByDetail("upgrade",$mdlUpgrade->getId(),"original");

			foreach($lstImage as $mdlImage){
				$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
			}
			?>
			<div class="thumbnail col-md-3">
				<a href="#upgrade<?php echo $mdlUpgrade->getId(); ?>" data-toggle="modal">
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
							name="upgrade<?php echo $Part_Id; ?>"
							onchange="selUpgrade(<?php echo $mdlUpgrade->getId().",".$Part_Id; ?>);"
							<?php

							$mdlUP->setProject_Id($_SESSION['projectId']);
							$mdlUP->setMaterial_Id('0');
							$mdlUP->setUpgrade_Id($mdlUpgrade->getId());
							if ($clsUP->IsExist($mdlUP)) {
								echo 'checked';
							}
							?>
							><br>
							<strong>
								<?php echo $mdlUpgrade->getName(); ?>
							</strong>
							<p>
								+ <?php echo $mdlUpgrade->getPrice(); ?> Php
							</p>
						</label>
					</center>
				</div>
			</div>


			<div class="modal fade" id="upgrade<?php echo $mdlUpgrade->getId(); ?>" role="dialog">
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

	}
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

	$clsPlan			= new Plan();
	$mdlPlan			= new PlanModel();
	$clsC 				= new Category();
	$mdlC		 			= new CategoryModel();
	$clsP 				= new Part();
	$mdlP 				= new PartModel();
	$clsM 				= new Material();
	$mdlM					= new MaterialModel();
	$clsU 				= new Upgrade();
	$mdlU 				= new UpgradeModel();

	$clsUnit			= new Unit();
	$mdlUnit			= new UnitModel();

	$lstUP = $clsUP->GetByProject_Id($_SESSION['projectId']);
	$Plan_Id = $clsProject->GetPlan_IdById($_SESSION['projectId']);


	$mdlPlan = $clsPlan->GetById($Plan_Id);
	$totalPrice = $mdlPlan->getPrice();
	$txtout .= '
	<div class="col-sm-6" style="padding:0px;">Base Price: </div>
	<div class="col-sm-6 text-right" style="padding:0px;">'.$totalPrice.'Php</div>
	';
	$txtout .= '<hr>';
	$txtout .= '<ul style="padding:0px !important;">';
	$txtout .= '<li><b><u>'.$mdlPlan->getName().'</u></b></li>';

	$lstC = $clsC->GetByPlan_Id($mdlPlan->getId());
	foreach ($lstC as $mdlC) {
		$txtout .= '<ul>';
		$txtout .= '<li><b>'.$mdlC->getName().'</b></li>';

		$lstP = $clsP->GetByCategory_Id($mdlC->getId());
		foreach ($lstP as $mdlP) {
			if ($mdlP->getArea() <= 0) {
				$mdlP->setArea('1');
			}
			$txtout .= '<ul>';
			$txtout .= '<li><b>'.$mdlP->getName().'</b></li>';

				$lstM = $clsM->GetByPart_Id($mdlP->getId());
				foreach ($lstM as $mdlM) {
					$mdlUP->setProject_Id($_SESSION['projectId']);
					$mdlUP->setMaterial_Id($mdlM->getId());
					$mdlUP->setUpgrade_Id('0');
					if ($clsUP->IsExist($mdlUP)) {
						if ($mdlM->getPriceType() == "0") {
							$M_width = $mdlM->getWidth() * $clsUnit->getConversionById($mdlM->getUnit_Id());
							$M_height = $mdlM->getHeight() * $clsUnit->getConversionById($mdlM->getUnit_Id());
							$M_area = $M_width * $M_height;

							$P_area = $mdlP->getArea() * pow($clsUnit->getConversionById($mdlP->getUnit_Id()),2);
							$Needed = ceil($P_area / $M_area);

							$PMprice = $Needed * $mdlM->getPrice();
							$totalPrice += $PMprice;
						}else{
							$PMprice = $mdlM->getPrice() * $mdlP->getPiece();
							$totalPrice += $PMprice;
						}
						$txtout .= '<ul>';
						$txtout .= '<li>
													<div class="row">
														<div class="col-sm-12">
															Material: '.$mdlM->getName().'
														</div>
													</div>';

						if ($mdlM->getPriceType() == "0") {
						$txtout .=	'	<div class="row">
														<div class="col-sm-12">
															Php '.$PMprice.'
														</div>
													</div>';
						}else{
						$txtout .=	'	<div class="row">
														<div class="col-sm-12">
															Php '.$PMprice.'
														</div>
													</div>';
						}
						$txtout .= '</li>
												</ul>';
					}
				}

				$lstU = $clsU->GetByPart_Id($mdlP->getId());
				foreach ($lstU as $mdlU) {
					$mdlUP->setProject_Id($_SESSION['projectId']);
					$mdlUP->setMaterial_Id('0');
					$mdlUP->setUpgrade_Id($mdlU->getId());
					if ($clsUP->IsExist($mdlUP)) {
						if ($mdlU->getPriceType() == "0") {
							$M_width = $mdlU->getWidth() * $clsUnit->getConversionById($mdlU->getUnit_Id());
							$M_height = $mdlU->getHeight() * $clsUnit->getConversionById($mdlU->getUnit_Id());
							$M_area = $M_width * $M_height;

							$P_area = $mdlP->getArea() * pow($clsUnit->getConversionById($mdlP->getUnit_Id()),2);
							$Needed = ceil($P_area / $M_area);

							$PUprice = $Needed * $mdlU->getPrice();
							$totalPrice += $PUprice;
						}else{
							$PUprice = $mdlU->getPrice() * $mdlP->getPiece();
							$totalPrice += $PUprice;
						}
						$txtout .= '<ul>';
						$txtout .= '<li>
													<div class="row">
														<div class="col-sm-12">
															Upgrade: '.$mdlU->getName().'
														</div>
													</div>';

						if ($mdlU->getPriceType() == "0") {
						$txtout .=	'	<div class="row">
														<div class="col-sm-12">
															Php '.$PUprice.'
														</div>
													</div>';
						}else{
						$txtout .=	'	<div class="row">
														<div class="col-sm-12">
															Php '.$PUprice.'
														</div>
													</div>';
						}
						$txtout .= '</li>
												</ul>';
					}
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
