<?php
$clsMaterial = new Material();
class Material{

	private $table = "material";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`Material_Name`,
					`Material_Description`,
					`Material_Price`
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
			`Material_Name`='".$mdl->getsqlName()."',
			`Material_Description`='".$mdl->getsqlDescription()."',
			`Material_Price`='".$mdl->getsqlPrice()."',
			`Material_DateCreated`='".$mdl->getsqlDateCreated()."',
			`Material_Status`='".$mdl->getsqlStatus()."'
			WHERE `Material_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Activate($id){ // Visible

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Material_Status`='0'
			WHERE `Material_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Deactivate($id){ //Hidden

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Material_Status`='1'
			WHERE `Material_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){
		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `Material_Id` = '".$id."'";
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
				`Material_Name` = '".$mdl->getsqlName()."' AND
				`Material_Id` != '".$mdl->getsqlId()."'";
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
				WHERE `Material_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetNameById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Material_Name` FROM `".$this->table."`
				WHERE `Material_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['Material_Name'];
		}

		mysqli_close($conn);

		return $name;
	}

	public function GetDescriptionById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Material_Description` FROM `".$this->table."`
				WHERE `Material_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['Material_Description'];
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
				WHERE `RP`.`Upgrade_Id` IS NULL";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetNotParts_Id($id = ''){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT `M`.* FROM `".$this->table."` AS `M`
				LEFT JOIN
					(SELECT `PM`.* FROM `partmaterial` AS `PM`
						INNER JOIN `roompart` AS `RP`
						ON `RP`.`RoomPart_Id` = `PM`.`RoomPart_Id`
						WHERE `RP`.`Parts_Id` = '".$id."') AS `PM`
					ON `M`.`Material_Id` = `PM`.`Material_Id`
					WHERE `PM`.`Material_Id` IS NULL";
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

		$mdl = new MaterialModel();
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
			$mdl = new MaterialModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new MaterialModel();

		$mdl->setId((isset($row['Material_Id'])) ? $row['Material_Id'] : '');
		$mdl->setName((isset($row['Material_Name'])) ? $row['Material_Name'] : '');
		$mdl->setDescription((isset($row['Material_Description'])) ? $row['Material_Description'] : '');
		$mdl->setPrice((isset($row['Material_Price'])) ? $row['Material_Price'] : '');
		$mdl->setDateCreated((isset($row['Material_DateCreated'])) ? $row['Material_DateCreated'] : '');
		$mdl->setStatus((isset($row['Material_Status'])) ? $row['Material_Status'] : '');
		return $mdl;
	}

}
?>
