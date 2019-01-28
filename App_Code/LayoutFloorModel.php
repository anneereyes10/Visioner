<?php
$mdlLayoutFloor = new LayoutFloorModel();
class LayoutFloorModel{

	private $Id = "";
	private $Layout_Id = "";
	private $Floor_Id = "";

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


	public function getLayout_Id(){
		return $this->Layout_Id;
	}

	public function getsqlLayout_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Layout_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setLayout_Id($Layout_Id){
		$this->Layout_Id = $Layout_Id;
	}


	public function getFloor_Id(){
		return $this->Floor_Id;
	}

	public function getsqlFloor_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Floor_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setFloor_Id($Floor_Id){
		$this->Floor_Id = $Floor_Id;
	}


}
