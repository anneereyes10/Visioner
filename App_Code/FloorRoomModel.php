<?php
$mdlFloorRoom = new FloorRoomModel();
class FloorRoomModel{

	private $Id = "";
	private $mdlLayoutFloor_Id = "";
	private $Room_Id = "";

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


	public function getLayoutFloor_Id(){
		return $this->LayoutFloor_Id;
	}

	public function getsqlLayoutFloor_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->LayoutFloor_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setLayoutFloor_Id($LayoutFloor_Id){
		$this->LayoutFloor_Id = $LayoutFloor_Id;
	}


	public function getRoom_Id(){
		return $this->Room_Id;
	}

	public function getsqlRoom_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Room_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setRoom_Id($Room_Id){
		$this->Room_Id = $Room_Id;
	}


}
