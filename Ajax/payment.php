<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Payment.php");
require_once ("../App_Code/UploadPlace.php");
require_once ("../App_Code/Project.php");
require_once ("../App_Code/Services.php");
require_once ("../App_Code/UserProject.php");
require_once ("../App_Code/Plan.php");
require_once ("../App_Code/Category.php");
require_once ("../App_Code/Part.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/Upgrade.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/Upload.php");

$call = $_GET['call'];

switch ($call){
	case 'addPayment':	{
		if (empty($_GET['Date'])) {
			addPayment($_GET['Id'],$_GET['Place_Id']);
		} else {
			addPayment($_GET['Id'],$_GET['Place_Id'],$_GET['Date']);
		}
		break;
	}
	case 'deletePayment':	{
		deletePayment($_GET['Id']);
		break;
	}
	case 'displayDetail':
	{
		displayDetail($_GET['Id']);
		break;
	}
}

function addPayment($id,$place,$date=""){
	$clsUploadPlace = new UploadPlace();
	$clsPayment = new Payment();
	$mdlPayment = new PaymentModel();
	if ($date=="") {
		$date = "1111-11-11";
		$clsPayment->UpdateAppointmentDate($id,$date);
		$clsPayment->UpdatePlace_Id($id,$place);
		$clsPayment->UpdateAppointmentStatus($id,'1');
		$clsUploadPlace->UpdateUsed($place,'1');
		?>
		<div class="alert alert-success">
			<strong>Success!</strong> Appointment is now scheduled.
		</div>
		<?php
	} else {
		if ($clsPayment->IsDateTaken($id,$date)) {
			?>
			<div class="alert alert-danger">
				Date Already Taken.
			</div>
			<input type='date' class='form-control' id='inputAppointmentDate<?php echo $id;?>' name='AppointmentDate' value=''>
			<button class="btn btn-primary w-full" onclick="setAppointment(<?php echo $id;?>)">Set Appointment</button>
			<?php
		}else{
			$clsPayment->UpdateAppointmentDate($id,$date);
			$clsPayment->UpdatePlace_Id($id,$place);
			$clsPayment->UpdateAppointmentStatus($id,'0');
			?>
			<div class="alert alert-success">
			  <strong>Success!</strong> Date Submitted</a>.
			</div>
			<?php
		}
	}

}

function deletePayment($id){
	$clsPayment = new Payment();
	$clsPayment->Delete($id);

}


function displayDetail($id)
{
	$clsProject = new Project();
	$mdlProject = new ProjectModel();
	$clsServices = new Services();
	$mdlServices = new ServicesModel();
	$clsUpload = new Upload();
	$mdlUpload = new UploadModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

	$mdlProject = $clsProject->GetById($id);
	?>
	<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Details</h4>
  </div>
  <div class="modal-body">
    <div class="row">
			<div class="col-md-4">
				Project Name:
			</div>
			<div class="col-md-8">
				<?php echo $mdlProject->getName(); ?>
			</div>
		</div>
    <div class="row">
			<div class="col-md-4">
				Project Type:
			</div>
			<div class="col-md-8">
				<?php
				switch ($mdlProject->getType()){
					case '0':
						echo "Build";
						break;
					case '1':
						echo "Service";
						break;
					case '2':
						echo "Upload";
						break;
				}
				?>
			</div>
		</div>
    <div class="row">
			<div class="col-md-12">
				<?php

				switch ($mdlProject->getType()){
					case '0':
						{
							?>
							<div class="row" style="padding: 10px;">
								<div class="col-md-12" style="border:1px solid #aaa; padding:10px;">
									<?php
									ProjectBuild($mdlProject->getId());
									?>
								</div>
							</div>
							<?php
						}
						break;
					case '1':
						{
							$mdlServices = $clsServices->GetById($mdlProject->getPlan_Id());
							?>
							<div class="row" style="padding: 10px;">
								<div class="col-md-12" style="border:1px solid #aaa;padding:10px;	">
									<div class="row">
										<div class="col-md-12">
					            <?php
					            $lstImage = $clsImage->GetByDetail("services",$mdlServices->getId(),"original");
					            $imgLocation = '';
					            foreach($lstImage as $mdlImage){
					              $imgLocation = '../'.$clsImage->ToLocation($mdlImage);
					            }
					            if ($imgLocation != '') {
					              echo '<img src="'.$imgLocation.'" style="max-height:200px;">';
					            }
					            ?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Name:
										</div>
										<div class="col-md-8">
											<?php echo $mdlServices->getName(); ?>
										</div>
									</div>
								</div>
							</div>
							<?php
							break;
						}
					case '2':
						{
							$mdlUpload = $clsUpload->GetById($mdlProject->getPlan_Id());
							?>
							<div class="row" style="padding: 10px;">
								<div class="col-md-12" style="border:1px solid #aaa;padding:10px;	">
									<div class="row">

										<div class="col-md-4">
											Files:
										</div>
										<div class="col-md-6">
											<?php
											$lstImage = $clsImage->GetByDetail("upload",$mdlUpload->getId(),"original");
											$imgLocation = '';
											foreach($lstImage as $mdlImage){
												$imgLocation = '../'.$clsImage->ToLocation($mdlImage);
											}
											if ($imgLocation != '') {
												echo '<img src="'.$imgLocation.'" style="max-height:200px;">';
											}
											$path = '../UploadFiles/'.$mdlUpload->getId()."/";
											if (file_exists($path)) {
												$files = array_slice(scandir($path), 2);
												foreach ($files as $key => $value) {
													echo "<a href='".$path.$value."' >".$value."</a><br/>";
												}
											}
											?>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											Description:
										</div>
										<div class="col-md-8" style="white-space: pre-line">
											<?php echo $mdlUpload->getDescription(); ?>
										</div>
									</div>
								</div>
							</div>
							<?php
							break;
						}
				}
				 ?>
			</div>
		</div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
	<?php
}


function ProjectBuild($Project_Id) {
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

	$lstUP = $clsUP->GetByProject_Id($Project_Id);
	$Plan_Id = $clsProject->GetPlan_IdById($Project_Id);

	$mdlPlan = $clsPlan->GetById($Plan_Id);
	$txtout .= '<ul>';
	$txtout .= '<li>'.$mdlPlan->getName().'</li>';

	$lstC = $clsC->GetByPlan_Id($mdlPlan->getId());
	foreach ($lstC as $mdlC) {
		$txtout .= '<ul>';
		$txtout .= '<li>'.$mdlC->getName().'</li>';

		$lstP = $clsP->GetByCategory_Id($mdlC->getId());
		foreach ($lstP as $mdlP) {
			if ($mdlP->getArea() <= 0) {
				$mdlP->setArea('1');
			}
			$txtout .= '<ul>';
			$txtout .= '<li>'.$mdlP->getName().'</li>';

				$lstM = $clsM->GetByPart_Id($mdlP->getId());
				foreach ($lstM as $mdlM) {
					$mdlUP->setProject_Id($Project_Id);
					$mdlUP->setMaterial_Id($mdlM->getId());
					$mdlUP->setUpgrade_Id('0');
					if ($clsUP->IsExist($mdlUP)) {
						if ($mdlM->getPriceType() == "0") {
							$PMprice = $mdlM->getPrice() * $mdlP->getArea();
							$totalPrice += $PMprice;
						}else{
							$PMprice = $mdlM->getPrice() * $mdlP->getPiece();
							$totalPrice += $PMprice;
						}
						$txtout .= '<ul>';
						$txtout .= '<li>
													<div class="col-sm-6" style="padding:0px;">Material: '.$mdlM->getName().'</div>
													<div class="col-sm-6 text-right" style="padding:0px;">'.$PMprice.'Php</div>
												</li>';
						$txtout .= '</ul>';
					}
				}

				$lstU = $clsU->GetByPart_Id($mdlP->getId());
				foreach ($lstU as $mdlU) {
					$mdlUP->setProject_Id($Project_Id);
					$mdlUP->setMaterial_Id('0');
					$mdlUP->setUpgrade_Id($mdlU->getId());
					if ($clsUP->IsExist($mdlUP)) {
						if ($mdlU->getPriceType() == "0") {
							$PUprice = $mdlU->getPrice() * $mdlP->getArea();
							$totalPrice += $PUprice;
						}else{
							$PUprice = $mdlU->getPrice() * $mdlP->getPiece();
							$totalPrice += $PUprice;
						}
						$txtout .= '<ul>';
						$txtout .= '<li>
													<div class="col-sm-6" style="padding:0px;">Upgrade: '.$mdlU->getName().'</div>
													<div class="col-sm-6 text-right" style="padding:0px;">'.$PUprice.'Php</div>
												</li>';
						$txtout .= '</ul>';
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
?>
