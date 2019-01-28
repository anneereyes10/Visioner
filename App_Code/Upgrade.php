<?php
$clsUpgrade = new Upgrade();
class Upgrade{

	private $table = "upgrade";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`Upgrade_Name`,
					`Upgrade_Description`,
					`Upgrade_Price`
				) VALUES (
					'".$mdl->getsqlName()."',
					'".$mdl->getsqlDescription()."',
					'".$mdl->getsqlPrice()."'
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
			`Upgrade_Name`='".$mdl->getsqlName()."',
			`Upgrade_Description`='".$mdl->getsqlDescription()."',
			`Upgrade_Price`='".$mdl->getsqlPrice()."',
			`Upgrade_DateCreated`='".$mdl->getsqlDateCreated()."',
			`Upgrade_Status`='".$mdl->getsqlStatus()."'
			WHERE `Upgrade_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Activate($id){ // Visible

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Upgrade_Status`='0'
			WHERE `Upgrade_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Deactivate($id){ //Hidden

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Upgrade_Status`='1'
			WHERE `Upgrade_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){
		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `Upgrade_Id` = '".$id."'";
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
				`Upgrade_Name` = '".$mdl->getsqlName()."' AND
				`Upgrade_Id` != '".$mdl->getsqlId()."'";
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
				WHERE `Upgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetNameById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Upgrade_Name` FROM `".$this->table."`
				WHERE `Upgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['Upgrade_Name'];
		}

		mysqli_close($conn);

		return $name;
	}

	public function GetDescriptionById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Upgrade_Description` FROM `".$this->table."`
				WHERE `Upgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['Upgrade_Description'];
		}

		mysqli_close($conn);

		return $name;
	}

	public function GetNotMaterialUpgrade(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT `U`.* FROM `".$this->table."` AS `U`
				LEFT JOIN `materialupgrade` AS `MU`
				ON `U`.`Upgrade_Id` = `MU`.`Upgrade_Id`
				WHERE `MU`.`Upgrade_Id` IS NULL";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}


	public function GetNotMaterial_Id($id = ''){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT `U`.* FROM `".$this->table."` AS `U`
				LEFT JOIN
					(SELECT `MU`.* FROM `materialupgrade` AS `MU`
						INNER JOIN `partmaterial` AS `PM`
						ON `PM`.`PartMaterial_Id` = `MU`.`PartMaterial_Id`
						WHERE `PM`.`Material_Id` = '".$id."') AS `MU`
					ON `U`.`Upgrade_Id` = `MU`.`Upgrade_Id`
					WHERE `MU`.`Upgrade_Id` IS NULL";
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

		$mdl = new UpgradeModel();
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
			$mdl = new UpgradeModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new UpgradeModel();

		$mdl->setId((isset($row['Upgrade_Id'])) ? $row['Upgrade_Id'] : '');
		$mdl->setName((isset($row['Upgrade_Name'])) ? $row['Upgrade_Name'] : '');
		$mdl->setDescription((isset($row['Upgrade_Description'])) ? $row['Upgrade_Description'] : '');
		$mdl->setPrice((isset($row['Upgrade_Price'])) ? $row['Upgrade_Price'] : '');
		$mdl->setDateCreated((isset($row['Upgrade_DateCreated'])) ? $row['Upgrade_DateCreated'] : '');
		$mdl->setStatus((isset($row['Upgrade_Status'])) ? $row['Upgrade_Status'] : '');
		return $mdl;
	}

}
?>
