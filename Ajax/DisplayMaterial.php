<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/MaterialUpgrade.php");
require_once ("../App_Code/MaterialUpgradeModel.php");

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
	$clsMaterialUpgrade = new MaterialUpgrade();
	$mdlMaterialUpgrade = new MaterialUpgradeModel();
	$mdlMaterialUpgrade->setPartMaterial_Id($pid);
	$mdlMaterialUpgrade->setUpgrade_Id($cid);
	$clsMaterialUpgrade->Add($mdlMaterialUpgrade);
}


function delete($id)
{
	$clsMaterialUpgrade = new MaterialUpgrade();
	$clsMaterialUpgrade->Delete($id);
}
