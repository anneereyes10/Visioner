<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/Project.php");
require_once ("../App_Code/ProjectModel.php");
require_once ("../App_Code/Payment.php");
require_once ("../App_Code/PaymentModel.php");

$call = $_GET['call'];

switch ($call)
{
	case 'Approved':
	{
		Approved($_GET['Id']);
		break;
	}
	case 'Declined':
	{
		Declined($_GET['Id']);
		break;
	}
}

function Approved($pid)
{
	$clsFn = new Functions();
	$clsPayment = new Payment();
	$clsProject = new Project();
	$clsUser = new User();
	$clsPayment->UpdateReceiptStatus($pid,'1');

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


function Declined($pid)
{
	$clsFn = new Functions();
	$clsPayment = new Payment();
	$clsProject = new Project();
	$clsUser = new User();
	$clsPayment->UpdateReceiptStatus($pid,'2');

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
