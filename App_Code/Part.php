<?php
require_once ("PartModel.php");
$clsPart = new Part();
class Part{

	private $table = "part";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`Category_Id`,
				`Part_Name`,
				`Part_Area`
			) VALUES (
				'".$mdl->getsqlCategory_Id()."',
				'".$mdl->getsqlName()."',
				'".$mdl->getsqlArea()."'
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
				 `Category_Id`='".$mdl->getsqlCategory_Id()."',
				 `Part_Name`='".$mdl->getsqlName()."',
				 `Part_Area`='".$mdl->getsqlArea()."',
				 `Part_Status`='".$mdl->getsqlStatus()."'
		 WHERE `Part_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function UpdateCategory_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Category_Id`='".$value."'
			WHERE `Part_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateName($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Part_Name`='".$value."'
			WHERE `Part_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateArea($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Part_Area`='".$value."'
			WHERE `Part_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateStatus($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Part_Status`='".$value."'
			WHERE `Part_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `Part_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";

		// Part_Name
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`Part_Id` != '".$mdl->getsqlId()."' AND
			`Part_Name` = '".$mdl->getsqlName()."' AND
			`Category_Id` = '".$mdl->getsqlCategory_Id()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputName\")'>Name</a>: " . $mdl->getName() . "</p>";
			$val = true;
		}

		mysqli_close($conn);

		return array("val"=>"$val","msg"=>"$msg");

	}

	public function Get($status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Part_Status` = '".$status."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetCategory_IdById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Category_Id` FROM `".$this->table."`
		WHERE `Part_Id` = '".$id."'
		AND `Part_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Category_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetNameById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Part_Name` FROM `".$this->table."`
		WHERE `Part_Id` = '".$id."'
		AND `Part_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Part_Name'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetAreaById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Part_Area` FROM `".$this->table."`
		WHERE `Part_Id` = '".$id."'
		AND `Part_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Part_Area'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetStatusById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Part_Status` FROM `".$this->table."`
		WHERE `Part_Id` = '".$id."'
		AND `Part_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Part_Status'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetById($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Part_Id` = '".$value."'
		AND `Part_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByCategory_Id($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Category_Id` = '".$value."'
		AND `Part_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByName($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Part_Name` = '".$value."'
		AND `Part_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByArea($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Part_Area` = '".$value."'
		AND `Part_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByDateCreated($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Part_DateCreated` = '".$value."'
		AND `Part_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByStatus($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Part_Status` = '".$value."'
		AND `Part_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function SetImage($image,$id){

		$val = true;
		$msg = "";
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

		$mdl = new PartModel();
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
			$mdl = new PartModel();
			$mdl = $this->ToModel($row);
			array_push($lst,$mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new PartModel();
		$mdl->setId((isset($row['Part_Id'])) ? $row['Part_Id'] : '');
		$mdl->setCategory_Id((isset($row['Category_Id'])) ? $row['Category_Id'] : '');
		$mdl->setName((isset($row['Part_Name'])) ? $row['Part_Name'] : '');
		$mdl->setArea((isset($row['Part_Area'])) ? $row['Part_Area'] : '');
		$mdl->setDateCreated((isset($row['Part_DateCreated'])) ? $row['Part_DateCreated'] : '');
		$mdl->setStatus((isset($row['Part_Status'])) ? $row['Part_Status'] : '');
		return $mdl;
	}
}
