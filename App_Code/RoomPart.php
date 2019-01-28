<?php
$clsRoomPart = new RoomPart();
class RoomPart{

	private $table = "roompart";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`FloorRoom_Id`,
					`Parts_Id`

				) VALUES (
					'".$mdl->getsqlFloorRoom_Id()."',
					'".$mdl->getsqlParts_Id()."'
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
			`FloorRoom_Id`='".$mdl->getsqlFloorRoom_Id()."',
			`Floor_Id`='".$mdl->getsqlRoom_Id()."'
			WHERE `RoomPart_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){
		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `RoomPart_Id` = '".$id."'";
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
				`FloorRoom_Id` = '".$mdl->getsqlFloorRoom_Id()."' AND
				`Floor_Id` = '".$mdl->getsqlFloor_Id()."' AND
				`RoomPart_Id` != '".$mdl->getsqlId()."'";
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
				WHERE `RoomPart_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByFloorRoom_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `FloorRoom_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetFloorRoom_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$sql="SELECT `FloorRoom_Id` FROM `".$this->table."`
				WHERE `RoomPart_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result)){
			$value = $row['FloorRoom_Id'];
		}
		mysqli_close($conn);
		return $value;
	}

	public function ModelTransfer($result){

		$mdl = new RoomPartModel();
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
			$mdl = new RoomPartModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new RoomPartModel();

		$mdl->setId((isset($row['RoomPart_Id'])) ? $row['RoomPart_Id'] : '');
		$mdl->setFloorRoom_Id((isset($row['FloorRoom_Id'])) ? $row['FloorRoom_Id'] : '');
		$mdl->setParts_Id((isset($row['Parts_Id'])) ? $row['Parts_Id'] : '');
		return $mdl;
	}

}
?>
