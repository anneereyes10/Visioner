<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/LayoutFloor.php");
require_once ("../App_Code/LayoutFloorModel.php");

$call = $_GET['call'];

switch ($call)
{
	case 'add':
	{
		add($_GET['pid'],$_GET['cid']);
		break;
	}
	case 'remove':
	{
		delete($_GET['Id']);
		break;
	}
}

function add($pid,$cid)
{
	$clsLayoutFloor = new LayoutFloor();
	$mdlLayoutFloor = new LayoutFloorModel();
	$mdlLayoutFloor->setLayout_Id($pid);
	$mdlLayoutFloor->setFloor_Id($cid);
	$clsLayoutFloor->Add($mdlLayoutFloor);
}


function delete($id)
{
	$clsLayoutFloor = new LayoutFloor();
	$clsLayoutFloor->Delete($id);
}
