<?php
require_once ("FinishItemModel.php");
$clsFinishItem = new FinishItem();
class FinishItem{

	private $table = "finishitem";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`Finish_Id`,
				`Plan_Id`,
				`Material_Id`,
				`Upgrade_Id`
			) VALUES (
				'".$mdl->getsqlFinish_Id()."',
				'".$mdl->getsqlPlan_Id()."',
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
				 `Finish_Id`='".$mdl->getsqlFinish_Id()."',
				 `Plan_Id`='".$mdl->getsqlPlan_Id()."',
				 `Material_Id`='".$mdl->getsqlMaterial_Id()."'
				 `Upgrade_Id`='".$mdl->getsqlUpgrade_Id()."'
		 WHERE `FinishItem_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function UpdateFinish_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Finish_Id`='".$value."'
			WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdatePlan_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Plan_Id`='".$value."'
			WHERE `FinishItem_Id` = '".$id."'";

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
			WHERE `FinishItem_Id` = '".$id."'";

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
			WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `FinishItem_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";


		// Finish_Id
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`FinishItem_Id` != '".$mdl->getsqlId()."' AND
			`Finish_Id` = '".$mdl->getsqlFinish_Id()."' AND
			`Plan_Id` = '".$mdl->getsqlPlan_Id()."' AND
			`Material_Id` = '".$mdl->getsqlMaterial_Id()."' AND
			`Upgrade_Id` = '".$mdl->getsqlUpgrade_Id()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputFinish_Id\")'>Finish_Id</a>: " . $mdl->getFinish_Id() . "</p>";
			$val = true;
		}

		mysqli_close($conn);

		// return array("val"=>"$val","msg"=>"$msg");
		return $val;

	}

	public function Get($status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`
		WHERE `FinishItem_Status` = '".$status."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetFinish_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Finish_Id` FROM `".$this->table."`
		WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Finish_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetPlan_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Plan_Id` FROM `".$this->table."`
		WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Plan_Id'];
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
		WHERE `FinishItem_Id` = '".$id."'";

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
		WHERE `FinishItem_Id` = '".$id."'";

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
		WHERE `FinishItem_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByFinish_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Finish_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByFinish_IdPlan_Id($value,$value2){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$value2 = mysqli_real_escape_string($conn,$value2);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Finish_Id` = '".$value."' AND
				`Plan_Id` = '".$value2."'
		";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByPlan_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Plan_Id` = '".$value."'";

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

	public function DeleteMaterialChange($Finish_Id,$Plan_Id,$Part_Id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$Finish_Id = mysqli_real_escape_string($conn,$Finish_Id);
		$Plan_Id = mysqli_real_escape_string($conn,$Plan_Id);
		$Part_Id = mysqli_real_escape_string($conn,$Part_Id);
		$sql="DELETE `FI` FROM `".$this->table."` AS `FI`
			INNER JOIN `material` AS `M`
			ON `M`.`Material_Id` = `FI`.`Material_Id`
			WHERE
				`FI`.`Finish_Id` = '".$Finish_Id."' AND
				`FI`.`Plan_Id` = '".$Plan_Id."' AND
				`M`.`Part_Id` = '".$Part_Id."' AND
				`FI`.`Upgrade_Id` = '0'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

	}

	public function DeleteUpgradeChange($Finish_Id,$Plan_Id,$Part_Id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$Finish_Id = mysqli_real_escape_string($conn,$Finish_Id);
		$Plan_Id = mysqli_real_escape_string($conn,$Plan_Id);
		$Part_Id = mysqli_real_escape_string($conn,$Part_Id);
		$sql="DELETE `FI` FROM `".$this->table."` AS `FI`
			INNER JOIN `upgrade` AS `U`
			ON `U`.`Upgrade_Id` = `FI`.`Upgrade_Id`
			WHERE
				`FI`.`Finish_Id` = '".$Finish_Id."' AND
				`FI`.`Plan_Id` = '".$Plan_Id."' AND
				`U`.`Part_Id` = '".$Part_Id."' AND
				`FI`.`Material_Id` = '0'";
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

		$mdl = new FinishItemModel();
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
			$mdl = new FinishItemModel();
			$mdl = $this->ToModel($row);
			array_push($lst,$mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new FinishItemModel();
		$mdl->setId((isset($row['FinishItem_Id'])) ? $row['FinishItem_Id'] : '');
		$mdl->setFinish_Id((isset($row['Finish_Id'])) ? $row['Finish_Id'] : '');
		$mdl->setPlan_Id((isset($row['Plan_Id'])) ? $row['Plan_Id'] : '');
		$mdl->setMaterial_Id((isset($row['Material_Id'])) ? $row['Material_Id'] : '');
		$mdl->setUpgrade_Id((isset($row['Upgrade_Id'])) ? $row['Upgrade_Id'] : '');
		return $mdl;
	}
}
