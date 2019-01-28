<?php
$mdlRoomPart = new RoomPartModel();
class RoomPartModel{

	private $Id = "";
	private $FloorRoom_Id = "";
	private $Parts_Id = "";

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


	public function getFloorRoom_Id(){
		return $this->FloorRoom_Id;
	}

	public function getsqlFloorRoom_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->FloorRoom_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setFloorRoom_Id($FloorRoom_Id){
		$this->FloorRoom_Id = $FloorRoom_Id;
	}


	public function getParts_Id(){
		return $this->Parts_Id;
	}

	public function getsqlParts_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Parts_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setParts_Id($Parts_Id){
		$this->Parts_Id = $Parts_Id;
	}


}
