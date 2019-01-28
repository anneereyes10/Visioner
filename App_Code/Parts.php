<?php
$clsParts = new Parts();
class Parts{

	private $table = "parts";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "INSERT INTO `".$this->table."`
				(
					`Parts_Name`,
					`Parts_Description`,
					`Parts_Area`
				) VALUES (
					'".$mdl->getsqlName()."',
					'".$mdl->getsqlDescription()."',
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
			`Parts_Name`='".$mdl->getsqlName()."',
			`Parts_Description`='".$mdl->getsqlDescription()."',
			`Parts_Area`='".$mdl->getsqlArea()."',
			`Parts_DateCreated`='".$mdl->getsqlDateCreated()."',
			`Parts_Status`='".$mdl->getsqlStatus()."'
			WHERE `Parts_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Activate($id){ // Visible

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Parts_Status`='0'
			WHERE `Parts_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Deactivate($id){ //Hidden

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="UPDATE `".$this->table."` SET
			`Parts_Status`='1'
			WHERE `Parts_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){
		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
				WHERE `Parts_Id` = '".$id."'";
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
				`Parts_Name` = '".$mdl->getsqlName()."' AND
				`Parts_Id` != '".$mdl->getsqlId()."'";
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
				WHERE `Parts_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetNameById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Parts_Name` FROM `".$this->table."`
				WHERE `Parts_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['Parts_Name'];
		}

		mysqli_close($conn);

		return $name;
	}

	public function GetDescriptionById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$name = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Parts_Description` FROM `".$this->table."`
				WHERE `Parts_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		while($row = mysqli_fetch_array($result))
		{
			$name = $row['Parts_Description'];
		}

		mysqli_close($conn);

		return $name;
	}

	public function GetNotRoom_Id($id = ''){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT `P`.* FROM `".$this->table."` AS `P`
				LEFT JOIN
					(SELECT `RP`.* FROM `roompart` AS `RP`
						INNER JOIN `floorroom` AS `FR`
						ON `FR`.`FloorRoom_Id` = `RP`.`FloorRoom_Id`
						WHERE `FR`.`Room_Id` = '".$id."') AS `RP`
					ON `P`.`Parts_Id` = `RP`.`Parts_Id`
					WHERE `RP`.`Parts_Id` IS NULL";
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

		$mdl = new PartsModel();
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
			$mdl = new PartsModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new PartsModel();

		$mdl->setId((isset($row['Parts_Id'])) ? $row['Parts_Id'] : '');
		$mdl->setName((isset($row['Parts_Name'])) ? $row['Parts_Name'] : '');
		$mdl->setDescription((isset($row['Parts_Description'])) ? $row['Parts_Description'] : '');
		$mdl->setArea((isset($row['Parts_Area'])) ? $row['Parts_Area'] : '');
		$mdl->setDateCreated((isset($row['Parts_DateCreated'])) ? $row['Parts_DateCreated'] : '');
		$mdl->setStatus((isset($row['Parts_Status'])) ? $row['Parts_Status'] : '');
		return $mdl;
	}

}
?>
