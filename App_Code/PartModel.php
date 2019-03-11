<?php
$mdlPart = new PartModel();
class PartModel{

	private $Id = "";
	private $Category_Id = "";
	private $Name = "";
	private $Area = "";
	private $Piece = "";
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


	//Category_Id
	public function getCategory_Id(){
		return $this->Category_Id;
	}

	public function getsqlCategory_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Category_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setCategory_Id($Category_Id){
		$this->Category_Id = $Category_Id;
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


	//Area
	public function getArea(){
		return $this->Area;
	}

	public function getsqlArea(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Area);
		mysqli_close($conn);
		return $value;
	}

	public function setArea($Area){
		$this->Area = $Area;
	}


	//Piece
	public function getPiece(){
		return $this->Piece;
	}

	public function getsqlPiece(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Piece);
		mysqli_close($conn);
		return $value;
	}

	public function setPiece($Piece){
		$this->Piece = $Piece;
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
