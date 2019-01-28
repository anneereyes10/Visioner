<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/FloorRoom.php");
require_once ("../App_Code/FloorRoomModel.php");

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
	$clsFloorRoom = new FloorRoom();
	$mdlFloorRoom = new FloorRoomModel();
	$mdlFloorRoom->setLayoutFloor_Id($pid);
	$mdlFloorRoom->setRoom_Id($cid);
	$clsFloorRoom->Add($mdlFloorRoom);
}


function delete($id)
{
	$clsFloorRoom = new FloorRoom();
	$clsFloorRoom->Delete($id);
}
