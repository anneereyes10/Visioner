<?php
$mdlLayout = new LayoutModel();
class LayoutModel{

	private $Id = "";
	private $Name = "";
	private $Description = "";
	private $Size = "";
	private $Price = "";
	private $Bedroom = "";
	private $Bathroom = "";
	private $Parking = "";
	private $DateCreated = "";
	private $Status = "";

	public function __construct(){}

	public function getId(){
		return $this->Id;
	}

	public function getsqlId(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Id);
		mysqli_close($conn);
		return $value;
	}

	public function setId($Id){
	$this->Id = $Id;
	}

	public function getName(){
		return $this->Name;
	}

	public function getsqlName(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Name);
		mysqli_close($conn);
		return $value;
	}

	public function setName($Name){
	$this->Name = $Name;
	}

	public function getDescription(){
		return $this->Description;
	}

	public function getsqlDescription(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Description);
		mysqli_close($conn);
		return $value;
	}

	public function setDescription($Description){
	$this->Description = $Description;
	}

	public function getSize(){
		return $this->Size;
	}

	public function getsqlSize(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Size);
		mysqli_close($conn);
		return $value;
	}

	public function setSize($Size){
	$this->Size = $Size;
	}

	public function getPrice(){
		return $this->Price;
	}

	public function getsqlPrice(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Price);
		mysqli_close($conn);
		return $value;
	}

	public function setPrice($Price){
	$this->Price = $Price;
	}

	public function getBedroom(){
		return $this->Bedroom;
	}

	public function getsqlBedroom(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Bedroom);
		mysqli_close($conn);
		return $value;
	}

	public function setBedroom($Bedroom){
	$this->Bedroom = $Bedroom;
	}

	public function getBathroom(){
		return $this->Bathroom;
	}

	public function getsqlBathroom(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Bathroom);
		mysqli_close($conn);
		return $value;
	}

	public function setBathroom($Bathroom){
	$this->Bathroom = $Bathroom;
	}

	public function getParking(){
		return $this->Parking;
	}

	public function getsqlParking(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Parking);
		mysqli_close($conn);
		return $value;
	}

	public function setParking($Parking){
	$this->Parking = $Parking;
	}

	public function getDateCreated(){
		return $this->DateCreated;
	}

	public function getsqlDateCreated(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->DateCreated);
		mysqli_close($conn);
		return $value;
	}

	public function setDateCreated($DateCreated){
	$this->DateCreated = $DateCreated;
	}

	public function getStatus(){
		return $this->Status;
	}

	public function getsqlStatus(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Status);
		mysqli_close($conn);
		return $value;
	}

	public function setStatus($Status){
	$this->Status = $Status;
	}

}
