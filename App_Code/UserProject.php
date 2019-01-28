<?php
$clsUserProject = new UserProject();
class UserProject{

	private $table = "userproject";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`Project_Id`,
				`PartMaterial_Id`,
				`MaterialUpgrade_Id`
			) VALUES (
				 '".$mdl->getsqlProject_Id()."',
				 '".$mdl->getsqlPartMaterial_Id()."',
				 '".$mdl->getsqlMaterialUpgrade_Id()."'
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
				 `Project_Id`='".$mdl->getsqlProject_Id()."',
				 `PartMaterial_Id`='".$mdl->getsqlPartMaterial_Id()."'
				 `MaterialUpgrade_Id`='".$mdl->getsqlMaterialUpgrade_Id()."'
		 WHERE `UserProject_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}


	public function UpdateId($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Project_Id`='".$value."'
			WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdateartMaterial_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`PartMaterial_Id`='".$value."'
			WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdateMaterialUpgrade_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`MaterialUpgrade_Id`='".$value."'
			WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `UserProject_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function DeleteByProjectId($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `Project_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

	}

	public function DeleteMaterialChange($projectId,$roomPartId){

		$Database = new Database();
		$conn = $Database->GetConn();
		$projectId = mysqli_real_escape_string($conn,$projectId);
		$roomPartId = mysqli_real_escape_string($conn,$roomPartId);
		$sql="DELETE `UP` FROM `".$this->table."` AS `UP`
			INNER JOIN `PartMaterial` AS `PM`
			ON `PM`.`PartMaterial_Id` = `UP`.`PartMaterial_Id`
			WHERE `UP`.`Project_Id` = '".$projectId."'
			AND `PM`.`RoomPart_Id` = '".$roomPartId."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function DeleteUpgradeChange($Project_Id,$PartMaterial_Id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$Project_Id = mysqli_real_escape_string($conn,$Project_Id);
		$PartMaterial_Id = mysqli_real_escape_string($conn,$PartMaterial_Id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `PartMaterial_Id` = '".$PartMaterial_Id."'
			AND `MaterialUpgrade_Id` != '0'
			AND `Project_Id` != '".$Project_Id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

	}

	public function Get(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}


	public function GetProject_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Project_Id` FROM `".$this->table."`
		WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Project_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetPartMaterial_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `PartMaterial_Id` FROM `".$this->table."`
		WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['PartMaterial_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetMaterialUpgrade_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `MaterialUpgrade_Id` FROM `".$this->table."`
		WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['MaterialUpgrade_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetById($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `UserProject_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByProject_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Project_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByPartMaterial_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `PartMaterial_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByMaterialUpgrade_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `MaterialUpgrade_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetLayoutById($id){
		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `MaterialUpgrade_Id` FROM `".$this->table."`
		WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['MaterialUpgrade_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$val = false;
		$msg = "";
		$sql = "SELECT * FROM `".$this->table."` AS `count`
			WHERE
			`Project_Id` = '".$mdl->getsqlProject_Id()."' AND
			`PartMaterial_Id` = '".$mdl->getsqlPartMaterial_Id()."' AND
			`MaterialUpgrade_Id` = '".$mdl->getsqlMaterialUpgrade_Id()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

			mysqli_close($conn);

		if($num_rows > 0)
		{
			return true;
		}

		return false;
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

		$mdl = new UserProjectModel();
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
			$mdl = new UserProjectModel();
			$mdl = $this->ToModel($row);
			array_push($lst,$mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new UserProjectModel();
		$mdl->setId((isset($row['UserProject_Id'])) ? $row['UserProject_Id'] : '');
		$mdl->setProject_Id((isset($row['Project_Id'])) ? $row['Project_Id'] : '');
		$mdl->setPartMaterial_Id((isset($row['PartMaterial_Id'])) ? $row['PartMaterial_Id'] : '');
		$mdl->setMaterialUpgrade_Id((isset($row['MaterialUpgrade_Id'])) ? $row['MaterialUpgrade_Id'] : '');
		return $mdl;
	}
}
