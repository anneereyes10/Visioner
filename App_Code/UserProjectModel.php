<?php
$mdlUserProject = new UserProjectModel();
class UserProjectModel{

	private $Id = "";
	private $Project_Id = "";
	private $PartMaterial_Id = "";
	private $MaterialUpgrade_Id = "";

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

	public function getProject_Id(){
		return $this->Project_Id;
	}

	public function getsqlProject_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Project_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setProject_Id($Project_Id){
	$this->Project_Id = $Project_Id;
	}

	public function getPartMaterial_Id(){
		return $this->artMaterial_Id;
	}

	public function getsqlPartMaterial_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->artMaterial_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setPartMaterial_Id($artMaterial_Id){
	$this->artMaterial_Id = $artMaterial_Id;
	}

	public function getMaterialUpgrade_Id(){
		return $this->MaterialUpgrade_Id;
	}

	public function getsqlMaterialUpgrade_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->MaterialUpgrade_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setMaterialUpgrade_Id($MaterialUpgrade_Id){
	$this->MaterialUpgrade_Id = $MaterialUpgrade_Id;
	}

}
