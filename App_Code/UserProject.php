<?php
require_once ("UserProjectModel.php");
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
				`Material_Id`,
				`Upgrade_Id`
			) VALUES (
				'".$mdl->getsqlProject_Id()."',
				'".$mdl->getsqlMaterial_Id()."',
				'".$mdl->getsqlUpgrade_Id()."'
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
				 `Material_Id`='".$mdl->getsqlMaterial_Id()."'
				 `Upgrade_Id`='".$mdl->getsqlUpgrade_Id()."'
		 WHERE `UserProject_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function UpdateProject_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Project_Id`='".$value."'
			WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateMaterial_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Material_Id`='".$value."'
			WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateUpgrade_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Upgrade_Id`='".$value."'
			WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
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

	public function DeleteByProject_Id($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `Project_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";

		// Project_Id
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`UserProject_Id` != '".$mdl->getsqlId()."' AND
			`Project_Id` = '".$mdl->getsqlProject_Id()."' AND
			`Material_Id` = '".$mdl->getsqlMaterial_Id()."' AND
			`Upgrade_Id` = '".$mdl->getsqlUpgrade_Id()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputProject_Id\")'>Project_Id</a>: " . $mdl->getProject_Id() . "</p>";
			$val = true;
		}

		mysqli_close($conn);

		return $val;

	}

	public function Get($status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`
		WHERE `UserProject_Status` = '".$status."'";
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

	public function GetMaterial_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Material_Id` FROM `".$this->table."`
		WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Material_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetUpgrade_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Upgrade_Id` FROM `".$this->table."`
		WHERE `UserProject_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Upgrade_Id'];
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

	public function GetByMaterial_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Material_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByUpgrade_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Upgrade_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function DeleteMaterialChange($Project_Id,$Part_Id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$Project_Id = mysqli_real_escape_string($conn,$Project_Id);
		$Part_Id = mysqli_real_escape_string($conn,$Part_Id);
		$sql="DELETE `UP` FROM `".$this->table."` AS `UP`
			INNER JOIN `material` AS `M`
			ON `M`.`Material_Id` = `UP`.`Material_Id`
			WHERE `UP`.`Project_Id` = '".$Project_Id."'
			AND `M`.`Part_Id` = '".$Part_Id."'
			AND `UP`.`Upgrade_Id` = '0'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function DeleteUpgradeChange($Project_Id,$Part_Id){
		$Database = new Database();
		$conn = $Database->GetConn();
		$Project_Id = mysqli_real_escape_string($conn,$Project_Id);
		$Part_Id = mysqli_real_escape_string($conn,$Part_Id);
		$sql="DELETE `UP` FROM `".$this->table."` AS `UP`
			INNER JOIN `upgrade` AS `U`
			ON `U`.`Upgrade_Id` = `UP`.`Upgrade_Id`
			WHERE `UP`.`Project_Id` = '".$Project_Id."'
			AND `U`.`Part_Id` = '".$Part_Id."'
			AND `UP`.`Material_Id` = '0'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

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
		$mdl->setMaterial_Id((isset($row['Material_Id'])) ? $row['Material_Id'] : '');
		$mdl->setUpgrade_Id((isset($row['Upgrade_Id'])) ? $row['Upgrade_Id'] : '');
		return $mdl;
	}
}
