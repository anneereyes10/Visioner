<?php
$clsFloorRoom = new FloorRoom();
class FloorRoom{

	private $table = "FloorRoom";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`LayoutFloor_Id`,
					`Room_Id`

				) VALUES (
					'".$mdl->getsqlLayoutFloor_Id()."',
					'".$mdl->getsqlRoom_Id()."'
				)";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$id = mysqli_insert_id($conn);

		mysqli_close($conn);

		return $id;
	}

	public function Update($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="UPDATE `".$this->table."` SET
			`LayoutRoom_Id`='".$mdl->getsqlLayoutRoom_Id()."',
			`Room_Id`='".$mdl->getsqlRoom_Id()."'
			WHERE `LayoutRoom_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){
		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `FloorRoom_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";

		$sql = "SELECT COUNT(*) FROM `".$this->table."` AS `count`
				WHERE
				`LayoutRoom_Id` = '".$mdl->getsqlLayoutRoom_Id()."' AND
				`Room_Id` = '".$mdl->getsqlRoom_Id()."' AND
				`LayoutRoom_Id` != '".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		mysqli_close($conn);

		if($num_rows > 0)
		{
			return true;
		}

		return false;
	}

	public function Get(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `FloorRoom_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByLayoutFloor_Id($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `LayoutFloor_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetLayoutFloor_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$sql="SELECT `LayoutFloor_Id` FROM `".$this->table."`
				WHERE `FloorRoom_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result)){
			$value = $row['LayoutFloor_Id'];
		}
		mysqli_close($conn);
		return $value;
	}

	public function ModelTransfer($result){

		$mdl = new FloorRoomModel();
		while($row = mysqli_fetch_array($result))
		{
			$mdl = $this->ToModel($row);
		}
		return $mdl;
	}

	public function ListTransfer($result){

		$lst = array();
		while($row = mysqli_fetch_array($result))
		{
			$mdl = new FloorRoomModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new FloorRoomModel();

		$mdl->setId((isset($row['FloorRoom_Id'])) ? $row['FloorRoom_Id'] : '');
		$mdl->setLayoutFloor_Id((isset($row['LayoutFloor_Id'])) ? $row['LayoutFloor_Id'] : '');
		$mdl->setRoom_Id((isset($row['Room_Id'])) ? $row['Room_Id'] : '');
		return $mdl;
	}

}
?>
