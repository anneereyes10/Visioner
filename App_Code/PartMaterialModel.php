<?php
$mdlPartMaterial = new PartMaterialModel();
class PartMaterialModel{

	private $Id = "";
	private $RoomPart_Id = "";
	private $Material_Id = "";

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


	public function getRoomPart_Id(){
		return $this->RoomPart_Id;
	}

	public function getsqlRoomPart_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->RoomPart_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setRoomPart_Id($RoomPart_Id){
		$this->RoomPart_Id = $RoomPart_Id;
	}


	public function getMaterial_Id(){
		return $this->Material_Id;
	}

	public function getsqlMaterial_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Material_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setMaterial_Id($Material_Id){
		$this->Material_Id = $Material_Id;
	}


}
