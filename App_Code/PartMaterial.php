<?php
$clsPartMaterial = new PartMaterial();
class PartMaterial{

	private $table = "partmaterial";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`RoomPart_Id`,
					`Material_Id`

				) VALUES (
					'".$mdl->getsqlRoomPart_Id()."',
					'".$mdl->getsqlMaterial_Id()."'
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
			`RoomPart_Id`='".$mdl->getsqlRoomPart_Id()."',
			`Material_Id`='".$mdl->getsqlMaterial_Id()."'
			WHERE `PartMaterial_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){
		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `PartMaterial_Id` = '".$id."'";
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
				`RoomPart_Id` = '".$mdl->getsqlRoomPart_Id()."' AND
				`Material_Id` = '".$mdl->getsqlMaterial_Id()."' AND
				`PartMaterial_Id` != '".$mdl->getsqlId()."'";
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
				WHERE `PartMaterial_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByRoomPart_Id($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `RoomPart_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetRoomPart_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$sql="SELECT `RoomPart_Id` FROM `".$this->table."`
				WHERE `PartMaterial_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result)){
			$value = $row['RoomPart_Id'];
		}
		mysqli_close($conn);
		return $value;
	}

	public function ModelTransfer($result){

		$mdl = new PartMaterialModel();
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
			$mdl = new PartMaterialModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new PartMaterialModel();

		$mdl->setId((isset($row['PartMaterial_Id'])) ? $row['PartMaterial_Id'] : '');
		$mdl->setRoomPart_Id((isset($row['RoomPart_Id'])) ? $row['RoomPart_Id'] : '');
		$mdl->setMaterial_Id((isset($row['Material_Id'])) ? $row['Material_Id'] : '');
		return $mdl;
	}

}
?>
