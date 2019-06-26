<?php
$mdlMaterial = new MaterialModel();
class MaterialModel{

	private $Id = "";
	private $Part_Id = "";
	private $Name = "";
	private $Description = "";
	private $Price = "";
	private $PriceType = "";
	private $Unit_Id = "";
	private $Width = "";
	private $Height = "";
	private $DateCreated = "";
	private $Status = "";

	public function __construct(){}

	//Id
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


	//Part_Id
	public function getPart_Id(){
		return $this->Part_Id;
	}

	public function getsqlPart_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Part_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setPart_Id($Part_Id){
		$this->Part_Id = $Part_Id;
	}


	//Name
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


	//Description
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


	//Price
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


	//PriceType
	public function getPriceType(){
		return $this->PriceType;
	}

	public function getsqlPriceType(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->PriceType);
		mysqli_close($conn);
		return $value;
	}

	public function setPriceType($PriceType){
		$this->PriceType = $PriceType;
	}


	//Unit_Id
	public function getUnit_Id(){
		return $this->Unit_Id;
	}

	public function getsqlUnit_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Unit_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setUnit_Id($Unit_Id){
		$this->Unit_Id = $Unit_Id;
	}


	//Width
	public function getWidth(){
		return $this->Width;
	}

	public function getsqlWidth(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Width);
		mysqli_close($conn);
		return $value;
	}

	public function setWidth($Width){
		$this->Width = $Width;
	}


	//Height
	public function getHeight(){
		return $this->Height;
	}

	public function getsqlHeight(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Height);
		mysqli_close($conn);
		return $value;
	}

	public function setHeight($Height){
		$this->Height = $Height;
	}


	//DateCreated
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


	//Status
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
