<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/User.php");

require_once ("../App_Code/Project.php");
require_once ("../App_Code/UserProject.php");
require_once ("../App_Code/Payment.php");

require_once ("../App_Code/Upload.php");
require_once ("../App_Code/Services.php");

require_once ("../App_Code/Plan.php");
require_once ("../App_Code/Category.php");
require_once ("../App_Code/Part.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/Upgrade.php");


require_once ("../App_Code/Image.php");

$call = $_GET['call'];

switch ($call)
{
	case 'Approved':
	{
		Approved($_GET['Id'],$_GET['txt']);
		break;
	}
	case 'Declined':
	{
		Declined($_GET['Id'],$_GET['txt']);
		break;
	}
	case 'displayDetail':
	{
		displayDetail($_GET['Id']);
		break;
	}
}

function Approved($pid,$txt)
{
	$clsFn = new Functions();
	$clsPayment = new Payment();
	$clsProject = new Project();
	$clsUser = new User();
	$clsPayment->UpdateReceiptStatus($pid,'1');
	$clsPayment->UpdateMessage($pid,$txt);
	echo $txt;

	$mdlPayment = $clsPayment->GetById($pid);
	$User_Id = $clsProject->GetUser_IdById($mdlPayment->getProject_Id());
	$email = $clsUser->GetEmailById($User_Id);

	$subject = "Payment Approved";
	$message = '';
	$message .= '<html>';
	$message .= '<body>';
	$message .= '<center>';
	$message .= '<h1><strong>YOUR PAYMENT HAS BEEN APPROVED!</strong></h1><br />';
	$message .= '<h4><strong>Project</strong>: ' .$clsProject->GetNameById($mdlPayment->getProject_Id()) . "</h4><br />";
	$message .= 'Click <a href="https://visionerdesignandbuilders.com/">HERE</a> to go to out website and check your projects<br />';
	$message .= '';
	$message .= '</center>';
	$message .= '</body>';
	$message .= '</html>';
	$message .= '';

	$clsFn->SendEmail($email,$subject,$message);
}


function Declined($pid,$txt)
{
	$clsFn = new Functions();
	$clsPayment = new Payment();
	$clsProject = new Project();
	$clsUser = new User();
	$clsPayment->UpdateReceiptStatus($pid,'2');
	$clsPayment->UpdateMessage($pid,$txt);

	$mdlPayment = $clsPayment->GetById($pid);
	$User_Id = $clsProject->GetUser_IdById($mdlPayment->getProject_Id());
	$email = $clsUser->GetEmailById($User_Id);

	$subject = "Payment Approved";
	$message = '';
	$message .= '<html>';
	$message .= '<body>';
	$message .= '<center>';
	$message .= '<h1><strong>YOUR PAYMENT HAS BEEN DECLINED!</strong></h1><br />';
	$message .= '<h4><strong>Project</strong>: ' .$clsProject->GetNameById($mdlPayment->getProject_Id()) . "</h4>";
	$message .= 'Click <a href="https://visionerdesignandbuilders.com/">HERE</a> to go to out website and check your projects<br />';
	$message .= '';
	$message .= '</center>';
	$message .= '</body>';
	$message .= '</html>';
	$message .= '';

	$clsFn->SendEmail($email,$subject,$message);
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
			<h5 class="modal-title">Details</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
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
												<div class="row">
													<div class="col-sm-6">Material: '.$mdlM->getName().'</div>
													<div class="col-sm-6 text-right">'.$PMprice.'Php</div>
													</div>
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
												<div class="row">
													<div class="col-sm-6">Upgrade: '.$mdlU->getName().'</div>
													<div class="col-sm-6 text-right">'.$PUprice.'Php</div>
												</div>
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
							<div class="row">
							<div class="col-sm-6">Estimated Price: </div>
							<div class="col-sm-6 text-right">'.$totalPrice.'Php</div>
							</div>
							';
	echo $txtout;
}
?>
