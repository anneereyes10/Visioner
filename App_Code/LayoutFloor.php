<?php
$clsLayoutFloor = new LayoutFloor();
class LayoutFloor{

	private $table = "layoutfloor";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`Layout_Id`,
					`Floor_Id`

				) VALUES (
					'".$mdl->getsqlLayout_Id()."',
					'".$mdl->getsqlFloor_Id()."'
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
			`Layout_Id`='".$mdl->getsqlLayout_Id()."',
			`Floor_Id`='".$mdl->getsqlFloor_Id()."'
			WHERE `LayoutFloor_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){
		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `LayoutFloor_Id` = '".$id."'";
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
				`Layout_Id` = '".$mdl->getsqlLayout_Id()."' AND
				`Floor_Id` = '".$mdl->getsqlFloor_Id()."' AND
				`LayoutFloor_Id` != '".$mdl->getsqlId()."'";
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
				WHERE `LayoutFloor_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetLayout_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$sql="SELECT `Layout_Id` FROM `".$this->table."`
				WHERE `LayoutFloor_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result)){
			$value = $row['Layout_Id'];
		}
		mysqli_close($conn);
		return $value;
	}

	public function GetByLayout_Id($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `Layout_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetFloorOnLayout($layoutId = ''){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT `F`.* FROM `".$this->table."` AS `F`
				INNER JOIN `layoutfloor` AS `LF`
				ON `F`.`Floor_Id` = `LF`.`Floor_Id`";

		if ($layoutId != '') {
			$sql .= " WHERE `LF`.`Layout_Id` = '".$layoutId."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function ModelTransfer($result){

		$mdl = new LayoutFloorModel();
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
			$mdl = new LayoutFloorModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new LayoutFloorModel();

		$mdl->setId((isset($row['LayoutFloor_Id'])) ? $row['LayoutFloor_Id'] : '');
		$mdl->setLayout_Id((isset($row['Layout_Id'])) ? $row['Layout_Id'] : '');
		$mdl->setFloor_Id((isset($row['Floor_Id'])) ? $row['Floor_Id'] : '');
		return $mdl;
	}

}
?>
