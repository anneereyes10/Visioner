<?php
require_once ("PlanModel.php");
$clsPlan = new Plan();
class Plan{

	private $table = "plan";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`Plan_Name`,
				`Plan_Description`,
				`Plan_Size`,
				`Plan_Price`,
				`Plan_Bedroom`,
				`Plan_Bathroom`,
				`Plan_Parking`
			) VALUES (
				'".$mdl->getsqlName()."',
				'".$mdl->getsqlDescription()."',
				'".$mdl->getsqlSize()."',
				'".$mdl->getsqlPrice()."',
				'".$mdl->getsqlBedroom()."',
				'".$mdl->getsqlBathroom()."',
				'".$mdl->getsqlParking()."'
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
				 `Plan_Name`='".$mdl->getsqlName()."',
				 `Plan_Description`='".$mdl->getsqlDescription()."',
				 `Plan_Size`='".$mdl->getsqlSize()."',
				 `Plan_Price`='".$mdl->getsqlPrice()."',
				 `Plan_Bedroom`='".$mdl->getsqlBedroom()."',
				 `Plan_Bathroom`='".$mdl->getsqlBathroom()."',
				 `Plan_Parking`='".$mdl->getsqlParking()."',
				 `Plan_Status`='".$mdl->getsqlStatus()."'
		 WHERE `Plan_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function UpdateName($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Plan_Name`='".$value."'
			WHERE `Plan_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateDescription($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Plan_Description`='".$value."'
			WHERE `Plan_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateSize($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Plan_Size`='".$value."'
			WHERE `Plan_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdatePrice($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Plan_Price`='".$value."'
			WHERE `Plan_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateBedroom($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Plan_Bedroom`='".$value."'
			WHERE `Plan_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateBathroom($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Plan_Bathroom`='".$value."'
			WHERE `Plan_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateParking($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Plan_Parking`='".$value."'
			WHERE `Plan_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateStatus($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Plan_Status`='".$value."'
			WHERE `Plan_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `Plan_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";

		// Plan_Name
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`Plan_Id` != '".$mdl->getsqlId()."'AND
			`Plan_Name` = '".$mdl->getsqlName()."'
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
		WHERE `Plan_Status` = '".$status."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetNameById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Plan_Name` FROM `".$this->table."`
		WHERE `Plan_Id` = '".$id."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Plan_Name'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetDescriptionById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Plan_Description` FROM `".$this->table."`
		WHERE `Plan_Id` = '".$id."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Plan_Description'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetSizeById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Plan_Size` FROM `".$this->table."`
		WHERE `Plan_Id` = '".$id."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Plan_Size'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetPriceById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Plan_Price` FROM `".$this->table."`
		WHERE `Plan_Id` = '".$id."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Plan_Price'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetBedroomById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Plan_Bedroom` FROM `".$this->table."`
		WHERE `Plan_Id` = '".$id."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Plan_Bedroom'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetBathroomById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Plan_Bathroom` FROM `".$this->table."`
		WHERE `Plan_Id` = '".$id."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Plan_Bathroom'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetParkingById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Plan_Parking` FROM `".$this->table."`
		WHERE `Plan_Id` = '".$id."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Plan_Parking'];
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

		$sql="SELECT `Plan_Status` FROM `".$this->table."`
		WHERE `Plan_Id` = '".$id."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Plan_Status'];
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
		WHERE `Plan_Id` = '".$value."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByName($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Plan_Name` = '".$value."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByDescription($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Plan_Description` = '".$value."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetBySize($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Plan_Size` = '".$value."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByPrice($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Plan_Price` = '".$value."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByBedroom($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Plan_Bedroom` = '".$value."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByBathroom($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Plan_Bathroom` = '".$value."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByParking($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Plan_Parking` = '".$value."'
		AND `Plan_Status` = '".$status."'";

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
		WHERE `Plan_DateCreated` = '".$value."'
		AND `Plan_Status` = '".$status."'";

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
		WHERE `Plan_Status` = '".$value."'
		AND `Plan_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function SearchByMinMax($mdlMin,$mdlMax,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Plan_Status` = '".$status."'";

		if (!empty($mdlMin->getSize())) {
			$sql .= "AND `Plan_Size` >= '".$mdlMin->getSize()."'";
		}
		if (!empty($mdlMax->getSize())) {
			$sql .= "AND `Plan_Size` <= '".$mdlMax->getSize()."'";
		}
		if (!empty($mdlMin->getPrice())) {
			$sql .= "AND `Plan_Price` >= '".$mdlMin->getPrice()."'";
		}
		if (!empty($mdlMax->getPrice())) {
			$sql .= "AND `Plan_Price` <= '".$mdlMax->getPrice()."'";
		}
		if (!empty($mdlMin->getBedroom())) {
			$sql .= "AND `Plan_Bedroom` >= '".$mdlMin->getBedroom()."'";
		}
		if (!empty($mdlMax->getBedroom())) {
			$sql .= "AND `Plan_Bedroom` <= '".$mdlMax->getBedroom()."'";
		}
		if (!empty($mdlMin->getBathroom())) {
			$sql .= "AND `Plan_Bathroom` >= '".$mdlMin->getBathroom()."'";
		}
		if (!empty($mdlMax->getBathroom())) {
			$sql .= "AND `Plan_Bathroom` <= '".$mdlMax->getBathroom()."'";
		}
		if (!empty($mdlMin->getParking())) {
			$sql .= "AND `Plan_Parking` >= '".$mdlMin->getParking()."'";
		}
		if (!empty($mdlMax->getParking())) {
			$sql .= "AND `Plan_Parking` <= '".$mdlMax->getParking()."'";
		}

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

		$mdl = new PlanModel();
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
			$mdl = new PlanModel();
			$mdl = $this->ToModel($row);
			array_push($lst,$mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new PlanModel();
		$mdl->setId((isset($row['Plan_Id'])) ? $row['Plan_Id'] : '');
		$mdl->setName((isset($row['Plan_Name'])) ? $row['Plan_Name'] : '');
		$mdl->setDescription((isset($row['Plan_Description'])) ? $row['Plan_Description'] : '');
		$mdl->setSize((isset($row['Plan_Size'])) ? $row['Plan_Size'] : '');
		$mdl->setPrice((isset($row['Plan_Price'])) ? $row['Plan_Price'] : '');
		$mdl->setBedroom((isset($row['Plan_Bedroom'])) ? $row['Plan_Bedroom'] : '');
		$mdl->setBathroom((isset($row['Plan_Bathroom'])) ? $row['Plan_Bathroom'] : '');
		$mdl->setParking((isset($row['Plan_Parking'])) ? $row['Plan_Parking'] : '');
		$mdl->setDateCreated((isset($row['Plan_DateCreated'])) ? $row['Plan_DateCreated'] : '');
		$mdl->setStatus((isset($row['Plan_Status'])) ? $row['Plan_Status'] : '');
		return $mdl;
	}
}
