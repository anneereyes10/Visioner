<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/PartMaterial.php");
require_once ("../App_Code/PartMaterialModel.php");

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
	$clsPartMaterial = new PartMaterial();
	$mdlPartMaterial = new PartMaterialModel();
	$mdlPartMaterial->setRoomPart_Id($pid);
	$mdlPartMaterial->setMaterial_Id($cid);
	$clsPartMaterial->Add($mdlPartMaterial);
}


function delete($id)
{
	$clsPartMaterial = new PartMaterial();
	$clsPartMaterial->Delete($id);
}
