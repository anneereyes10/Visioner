<?php
require_once ("../App_Code/Database.php");
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
	$clsPayment = new Payment();
	$clsPayment->UpdateReceiptStatus($pid,'1');
}


function Declined($pid)
{
	$clsPayment = new Payment();
	$clsPayment->UpdateReceiptStatus($pid,'2');
}
