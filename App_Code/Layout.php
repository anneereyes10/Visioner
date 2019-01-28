<?php
$clsLayout = new Layout();
class Layout{

	private $table = "layout";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`Layout_Name`,
				`Layout_Description`,
				`Layout_Size`,
				`Layout_Price`,
				`Layout_Bedroom`,
				`Layout_Bathroom`,
				`Layout_Parking`
			) VALUES (
				'".$mdl->getsqlName()."',
				'".$mdl->getsqlDescription()."',
				'".$mdl->getsqlSize()."',
				'".$mdl->getsqlPrice()."',
				'".$mdl->getsqlBedroom()."',
				'".$mdl->getsqlBathroom()."',
				'".$mdl->getsqlParking()."'
			)";
			echo $sql;
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$id = mysqli_insert_id($conn);

		mysqli_close($conn);
		return $id;
	}

	public function Update($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql="UPDATE `".$this->table."` SET
				 `Layout_Name`='".$mdl->getsqlName()."',
				 `Layout_Description`='".$mdl->getsqlDescription()."',
				 `Layout_Size`='".$mdl->getsqlSize()."',
				 `Layout_Price`='".$mdl->getsqlPrice()."',
				 `Layout_Bedroom`='".$mdl->getsqlBedroom()."',
				 `Layout_Bathroom`='".$mdl->getsqlBathroom()."',
				 `Layout_Parking`='".$mdl->getsqlParking()."',
				 `Layout_Status`='".$mdl->getsqlStatus()."'
		 WHERE `Layout_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function UpdateName($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Layout_Name`='".$value."'
			WHERE `Layout_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdateDescription($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Layout_Description`='".$value."'
			WHERE `Layout_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdateSize($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Layout_Size`='".$value."'
			WHERE `Layout_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdatePrice($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Layout_Price`='".$value."'
			WHERE `Layout_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdateBedroom($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Layout_Bedroom`='".$value."'
			WHERE `Layout_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdateBathroom($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Layout_Bathroom`='".$value."'
			WHERE `Layout_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdateParking($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Layout_Parking`='".$value."'
			WHERE `Layout_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdateStatus($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Layout_Status`='".$value."'
			WHERE `Layout_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `Layout_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$val = false;
		$msg = "";
		$sql = "SELECT * FROM `".$this->table."` AS `count`
			WHERE
			`Layout_Id` != '".$mdl->getsqlId()."'AND
			`Layout_Name` = '".$mdl->getsqlName()."'AND
			`Layout_Description` = '".$mdl->getsqlDescription()."'AND
			`Layout_Size` = '".$mdl->getsqlSize()."'AND
			`Layout_Price` = '".$mdl->getsqlPrice()."'AND
			`Layout_Bedroom` = '".$mdl->getsqlBedroom()."'AND
			`Layout_Bathroom` = '".$mdl->getsqlBathroom()."'AND
			`Layout_Parking` = '".$mdl->getsqlParking()."'";
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

	public function GetNameById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Layout_Name` FROM `".$this->table."`
		WHERE `Layout_Id` = '".$id."'
		AND `Layout_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Layout_Name'];
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

		$sql="SELECT `Layout_Description` FROM `".$this->table."`
		WHERE `Layout_Id` = '".$id."'
		AND `Layout_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Layout_Description'];
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

		$sql="SELECT `Layout_Size` FROM `".$this->table."`
		WHERE `Layout_Id` = '".$id."'
		AND `Layout_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Layout_Size'];
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

		$sql="SELECT `Layout_Price` FROM `".$this->table."`
		WHERE `Layout_Id` = '".$id."'
		AND `Layout_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Layout_Price'];
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

		$sql="SELECT `Layout_Bedroom` FROM `".$this->table."`
		WHERE `Layout_Id` = '".$id."'
		AND `Layout_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Layout_Bedroom'];
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

		$sql="SELECT `Layout_Bathroom` FROM `".$this->table."`
		WHERE `Layout_Id` = '".$id."'
		AND `Layout_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Layout_Bathroom'];
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

		$sql="SELECT `Layout_Parking` FROM `".$this->table."`
		WHERE `Layout_Id` = '".$id."'
		AND `Layout_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Layout_Parking'];
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

		$sql="SELECT `Layout_Status` FROM `".$this->table."`
		WHERE `Layout_Id` = '".$id."'
		AND `Layout_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Layout_Status'];
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
		WHERE `Layout_Id` = '".$value."'
		AND `Layout_Status` = '".$status."'";

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
		WHERE `Layout_Name` = '".$value."'
		AND `Layout_Status` = '".$status."'";

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
		WHERE `Layout_Description` = '".$value."'
		AND `Layout_Status` = '".$status."'";

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
		WHERE `Layout_Size` = '".$value."'
		AND `Layout_Status` = '".$status."'";

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
		WHERE `Layout_Price` = '".$value."'
		AND `Layout_Status` = '".$status."'";

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
		WHERE `Layout_Bedroom` = '".$value."'
		AND `Layout_Status` = '".$status."'";

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
		WHERE `Layout_Bathroom` = '".$value."'
		AND `Layout_Status` = '".$status."'";

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
		WHERE `Layout_Parking` = '".$value."'
		AND `Layout_Status` = '".$status."'";

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
		WHERE `Layout_DateCreated` = '".$value."'
		AND `Layout_Status` = '".$status."'";

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
		WHERE `Layout_Status` = '".$value."'
		AND `Layout_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function SearchByMinMax($mdlMin,$mdlMax,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Layout_Status` = '".$status."'";

		if (!empty($mdlMin->getSize())) {
			$sql .= "AND `Layout_Size` >= '".$mdlMin->getSize()."'";
		}
		if (!empty($mdlMax->getSize())) {
			$sql .= "AND `Layout_Size` <= '".$mdlMax->getSize()."'";
		}
		if (!empty($mdlMin->getPrice())) {
			$sql .= "AND `Layout_Price` >= '".$mdlMin->getPrice()."'";
		}
		if (!empty($mdlMax->getPrice())) {
			$sql .= "AND `Layout_Price` <= '".$mdlMax->getPrice()."'";
		}
		if (!empty($mdlMin->getBedroom())) {
			$sql .= "AND `Layout_Bedroom` >= '".$mdlMin->getBedroom()."'";
		}
		if (!empty($mdlMax->getBedroom())) {
			$sql .= "AND `Layout_Bedroom` <= '".$mdlMax->getBedroom()."'";
		}
		if (!empty($mdlMin->getBathroom())) {
			$sql .= "AND `Layout_Bathroom` >= '".$mdlMin->getBathroom()."'";
		}
		if (!empty($mdlMax->getBathroom())) {
			$sql .= "AND `Layout_Bathroom` <= '".$mdlMax->getBathroom()."'";
		}
		if (!empty($mdlMin->getParking())) {
			$sql .= "AND `Layout_Parking` >= '".$mdlMin->getParking()."'";
		}
		if (!empty($mdlMax->getParking())) {
			$sql .= "AND `Layout_Parking` <= '".$mdlMax->getParking()."'";
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

		$mdl = new LayoutModel();
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
			$mdl = new LayoutModel();
			$mdl = $this->ToModel($row);
			array_push($lst,$mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new LayoutModel();
		$mdl->setId((isset($row['Layout_Id'])) ? $row['Layout_Id'] : '');
		$mdl->setName((isset($row['Layout_Name'])) ? $row['Layout_Name'] : '');
		$mdl->setDescription((isset($row['Layout_Description'])) ? $row['Layout_Description'] : '');
		$mdl->setSize((isset($row['Layout_Size'])) ? $row['Layout_Size'] : '');
		$mdl->setPrice((isset($row['Layout_Price'])) ? $row['Layout_Price'] : '');
		$mdl->setBedroom((isset($row['Layout_Bedroom'])) ? $row['Layout_Bedroom'] : '');
		$mdl->setBathroom((isset($row['Layout_Bathroom'])) ? $row['Layout_Bathroom'] : '');
		$mdl->setParking((isset($row['Layout_Parking'])) ? $row['Layout_Parking'] : '');
		$mdl->setDateCreated((isset($row['Layout_DateCreated'])) ? $row['Layout_DateCreated'] : '');
		$mdl->setStatus((isset($row['Layout_Status'])) ? $row['Layout_Status'] : '');
		return $mdl;
	}
}
