<?php
$clsFloor = new Floor();
class Floor{

	private $table = "floor";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`Floor_Name`,
					`Floor_Description`
				) VALUES (
					'".$mdl->getsqlName()."',
					'".$mdl->getsqlDescription()."'
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
			`Floor_Name`='".$mdl->getsqlName()."',
			`Floor_Description`='".$mdl->getsqlDescription()."',
			`Floor_DateCreated`='".$mdl->getsqlDateCreated()."',
			`Floor_Status`='".$mdl->getsqlStatus()."'
			WHERE `Floor_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Activate($id){ // Visible

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Floor_Status`='0'
			WHERE `Floor_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Deactivate($id){ //Hidden

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Floor_Status`='1'
			WHERE `Floor_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){
		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `Floor_Id` = '".$id."'";
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
				`Floor_Name` = '".$mdl->getsqlName()."' AND
				`Floor_Id` != '".$mdl->getsqlId()."'";
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
				WHERE `Floor_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetNameById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Floor_Name` FROM `".$this->table."`
				WHERE `Floor_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['Floor_Name'];
		}

		mysqli_close($conn);

		return $name;
	}

	public function GetDescriptionById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Floor_Description` FROM `".$this->table."`
				WHERE `Floor_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['Floor_Description'];
		}

		mysqli_close($conn);

		return $name;
	}

	public function GetFloorByLayout_Id($id = ''){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="	SELECT `F`.* FROM `".$this->table."`	AS `F`
						INNER JOIN `layoutfloor` AS `LF`
						ON `F`.`Floor_Id` = `LF`.`Floor_Id`
						WHERE `LF`.`Layout_Id` = '".$id."'
					";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetFloorNotLayout($layoutId = ''){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="	SELECT `F`.* FROM `".$this->table."`	AS `F`
						LEFT JOIN
							(SELECT * FROM `layoutfloor` WHERE `Layout_Id` = '".$layoutId."') AS `LF`
						ON `F`.`Floor_Id` = `LF`.`Floor_Id`
						WHERE `LF`.`Floor_Id` IS NULL
					";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function SetImage($image,$id){
		$val = true; // true - upload success | false - upload failed
		$msg = ""; // error message
		$clsImage = new Image();

		if(isset($image["name"]) && ($image["name"]!=""))
		{
			$result = $clsImage->Upload($image,$this->table,$id);
			if($result[0] != ""){
				$msg = $result[0];
			}
		}

		return array("val"=>$val,"msg"=>$msg);
	}



	public function ModelTransfer($result){

		$mdl = new FloorModel();
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
			$mdl = new FloorModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new FloorModel();

		$mdl->setId((isset($row['Floor_Id'])) ? $row['Floor_Id'] : '');
		$mdl->setName((isset($row['Floor_Name'])) ? $row['Floor_Name'] : '');
		$mdl->setDescription((isset($row['Floor_Description'])) ? $row['Floor_Description'] : '');
		$mdl->setDateCreated((isset($row['Floor_DateCreated'])) ? $row['Floor_DateCreated'] : '');
		$mdl->setStatus((isset($row['Floor_Status'])) ? $row['Floor_Status'] : '');
		return $mdl;
	}

}
?>
