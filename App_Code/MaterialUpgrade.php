<?php
$clsMaterialUpgrade = new MaterialUpgrade();
class MaterialUpgrade{

	private $table = "materialupgrade";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`PartMaterial_Id`,
					`Upgrade_Id`

				) VALUES (
					'".$mdl->getsqlPartMaterial_Id()."',
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
			`PartMaterial_Id`='".$mdl->getsqlPartMaterial_Id()."',
			`Upgrade_Id`='".$mdl->getsqlUpgrade_Id()."'
			WHERE `MaterialUpgrade_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}


	public function Delete($id){
		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `MaterialUpgrade_Id` = '".$id."'";
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
				`PartMaterial_Id` = '".$mdl->getsqlPartMaterial_Id()."' AND
				`Upgrade_Id` = '".$mdl->getsqlUpgrade_Id()."' AND
				`MaterialUpgrade_Id` != '".$mdl->getsqlId()."'";
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
				WHERE `MaterialUpgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetPartMaterial_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$sql="SELECT `PartMaterial_Id` FROM `".$this->table."`
				WHERE `MaterialUpgrade_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result)){
			$value = $row['PartMaterial_Id'];
		}
		mysqli_close($conn);
		return $value;
	}

	public function GetByPartMaterial_Id($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `PartMaterial_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function ModelTransfer($result){

		$mdl = new MaterialUpgradeModel();
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
			$mdl = new MaterialUpgradeModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new MaterialUpgradeModel();

		$mdl->setId((isset($row['MaterialUpgrade_Id'])) ? $row['MaterialUpgrade_Id'] : '');
		$mdl->setPartMaterial_Id((isset($row['PartMaterial_Id'])) ? $row['PartMaterial_Id'] : '');
		$mdl->setUpgrade_Id((isset($row['Upgrade_Id'])) ? $row['Upgrade_Id'] : '');
		return $mdl;
	}

}
?>
