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
		Approved($_GET['Id'],$_GET['txt']);
		break;
	}
	case 'Declined':
	{
		Declined($_GET['Id'],$_GET['txt']);
		break;
	}
}

function Approved($pid,$txt)
{
	$clsFn = new Functions();
	$clsPayment = new Payment();
	$clsProject = new Project();
	$clsUser = new User();
	$clsPayment->UpdateAppointmentStatus($pid,'1');
	$clsPayment->UpdateMessage($pid,$txt);

	$mdlPayment = $clsPayment->GetById($pid);
	$User_Id = $clsProject->GetUser_IdById($mdlPayment->getProject_Id());
	$email = $clsUser->GetEmailById($User_Id);

	$subject = "Appointment Approved";
	$message = '';
	$message .= '<html>';
	$message .= '<body>';
	$message .= '<center>';
	$message .= '<h1><strong>YOUR APPOINTMENT DATE HAS BEEN APPROVED!</strong></h1><br />';
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
	$clsPayment->UpdateAppointmentStatus($pid,'2');
	$clsPayment->UpdateMessage($pid,$txt);

	$mdlPayment = $clsPayment->GetById($pid);
	$User_Id = $clsProject->GetUser_IdById($mdlPayment->getProject_Id());
	$email = $clsUser->GetEmailById($User_Id);

	$subject = "Appointment Approved";
	$message = '';
	$message .= '<html>';
	$message .= '<body>';
	$message .= '<center>';
	$message .= '<h1><strong>YOUR APPOINTMENT DATE HAS BEEN DECLINED!</strong></h1><br />';
	$message .= '<h4><strong>Project</strong>: ' .$clsProject->GetNameById($mdlPayment->getProject_Id()) . "</h4>";
	$message .= 'Click <a href="https://visionerdesignandbuilders.com/">HERE</a> to go to out website and check your projects<br />';
	$message .= '';
	$message .= '</center>';
	$message .= '</body>';
	$message .= '</html>';
	$message .= '';

	$clsFn->SendEmail($email,$subject,$message);
}
