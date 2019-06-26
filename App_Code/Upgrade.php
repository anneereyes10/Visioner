<?php
require_once ("UpgradeModel.php");
$clsUpgrade = new Upgrade();
class Upgrade{

	private $table = "upgrade";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`Part_Id`,
				`Upgrade_Name`,
				`Upgrade_Description`,
				`Upgrade_Price`,
				`Upgrade_PriceType`,
				`Upgrade_Width`,
				`Upgrade_Height`,
				`Unit_Id`
			) VALUES (
				'".$mdl->getsqlPart_Id()."',
				'".$mdl->getsqlName()."',
				'".$mdl->getsqlDescription()."',
				'".$mdl->getsqlPrice()."',
				'".$mdl->getsqlPriceType()."',
				'".$mdl->getsqlWidth()."',
				'".$mdl->getsqlHeight()."',
				'".$mdl->getsqlUnit_Id()."'
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
				 `Part_Id`='".$mdl->getsqlPart_Id()."',
				 `Upgrade_Name`='".$mdl->getsqlName()."',
				 `Upgrade_Description`='".$mdl->getsqlDescription()."',
				 `Upgrade_Price`='".$mdl->getsqlPrice()."',
				 `Upgrade_PriceType`='".$mdl->getsqlPriceType()."',
				 `Upgrade_Width`='".$mdl->getsqlWidth()."',
				 `Upgrade_Height`='".$mdl->getsqlHeight()."',
				 `Unit_Id`='".$mdl->getsqlUnit_Id()."',
				 `Upgrade_Status`='".$mdl->getsqlStatus()."'
		 WHERE `Upgrade_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function UpdatePart_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Part_Id`='".$value."'
			WHERE `Upgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateName($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Upgrade_Name`='".$value."'
			WHERE `Upgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateDescription($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Upgrade_Description`='".$value."'
			WHERE `Upgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdatePrice($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Upgrade_Price`='".$value."'
			WHERE `Upgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdatePriceType($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Upgrade_PriceType`='".$value."'
			WHERE `Upgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateWidth($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Upgrade_Width`='".$value."'
			WHERE `Upgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateHeight($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Upgrade_Height`='".$value."'
			WHERE `Upgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateUnit_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Unit_Id`='".$value."'
			WHERE `Upgrade_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateStatus($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Upgrade_Status`='".$value."'
			WHERE `Upgrade_Id` = '".$id."'";

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

		// Upgrade_Name
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`Upgrade_Id` != '".$mdl->getsqlId()."' AND
			`Upgrade_Name` = '".$mdl->getsqlName()."' AND
			`Part_Id` = '".$mdl->getsqlPart_Id()."'
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

	public function Get($status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql = "SELECT * FROM `".$this->table."`";
		if ($status !== "") {
			$sql .= "WHERE `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetPart_IdById($id,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql = "SELECT `Part_Id` FROM `".$this->table."`
			WHERE `Upgrade_Id` = '".$id."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Part_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetNameById($id,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql = "SELECT `Upgrade_Name` FROM `".$this->table."`
			WHERE `Upgrade_Id` = '".$id."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Upgrade_Name'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetDescriptionById($id,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql = "SELECT `Upgrade_Description` FROM `".$this->table."`
			WHERE `Upgrade_Id` = '".$id."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Upgrade_Description'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetPriceById($id,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql = "SELECT `Upgrade_Price` FROM `".$this->table."`
			WHERE `Upgrade_Id` = '".$id."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Upgrade_Price'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetPriceTypeById($id,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql = "SELECT `Upgrade_PriceType` FROM `".$this->table."`
			WHERE `Upgrade_Id` = '".$id."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Upgrade_PriceType'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetWidthById($id,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql = "SELECT `Upgrade_Width` FROM `".$this->table."`
			WHERE `Upgrade_Id` = '".$id."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Upgrade_Width'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetHeightById($id,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql = "SELECT `Upgrade_Height` FROM `".$this->table."`
			WHERE `Upgrade_Id` = '".$id."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Upgrade_Height'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetUnit_IdById($id,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql = "SELECT `Unit_Id` FROM `".$this->table."`
			WHERE `Upgrade_Id` = '".$id."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Unit_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetStatusById($id,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql = "SELECT `Upgrade_Status` FROM `".$this->table."`
			WHERE `Upgrade_Id` = '".$id."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Upgrade_Status'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetById($value,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Upgrade_Id` = '".$value."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByPart_Id($value,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Part_Id` = '".$value."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByName($value,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Upgrade_Name` = '".$value."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByDescription($value,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Upgrade_Description` = '".$value."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByPrice($value,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Upgrade_Price` = '".$value."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByPriceType($value,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Upgrade_PriceType` = '".$value."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByWidth($value,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Upgrade_Width` = '".$value."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByHeight($value,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Upgrade_Height` = '".$value."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByUnit_Id($value,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Unit_Id` = '".$value."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByDateCreated($value,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Upgrade_DateCreated` = '".$value."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
		}

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByStatus($value,$status=""){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
			WHERE `Upgrade_Status` = '".$value."'";
		if ($status !== "") {
			$sql .= "AND `Upgrade_Status` = '".$status."'";
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
			array_push($lst,$mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new UpgradeModel();
		$mdl->setId((isset($row['Upgrade_Id'])) ? $row['Upgrade_Id'] : '');
		$mdl->setPart_Id((isset($row['Part_Id'])) ? $row['Part_Id'] : '');
		$mdl->setName((isset($row['Upgrade_Name'])) ? $row['Upgrade_Name'] : '');
		$mdl->setDescription((isset($row['Upgrade_Description'])) ? $row['Upgrade_Description'] : '');
		$mdl->setPrice((isset($row['Upgrade_Price'])) ? $row['Upgrade_Price'] : '');
		$mdl->setPriceType((isset($row['Upgrade_PriceType'])) ? $row['Upgrade_PriceType'] : '');
		$mdl->setWidth((isset($row['Upgrade_Width'])) ? $row['Upgrade_Width'] : '');
		$mdl->setHeight((isset($row['Upgrade_Height'])) ? $row['Upgrade_Height'] : '');
		$mdl->setUnit_Id((isset($row['Unit_Id'])) ? $row['Unit_Id'] : '');
		$mdl->setDateCreated((isset($row['Upgrade_DateCreated'])) ? $row['Upgrade_DateCreated'] : '');
		$mdl->setStatus((isset($row['Upgrade_Status'])) ? $row['Upgrade_Status'] : '');
		return $mdl;
	}
}
