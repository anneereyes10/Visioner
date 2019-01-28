<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/RoomPart.php");
require_once ("../App_Code/RoomPartModel.php");

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
	$clsRoomPart = new RoomPart();
	$mdlRoomPart = new RoomPartModel();
	$mdlRoomPart->setFloorRoom_Id($pid);
	$mdlRoomPart->setParts_Id($cid);
	$clsRoomPart->Add($mdlRoomPart);
}


function delete($id)
{
	$clsRoomPart = new RoomPart();
	$clsRoomPart->Delete($id);
}
