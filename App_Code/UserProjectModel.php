<?php
$mdlUserProject = new UserProjectModel();
class UserProjectModel{

	private $Id = "";
	private $Project_Id = "";
	private $Material_Id = "";
	private $Upgrade_Id = "";

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


	//Project_Id
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


	//Material_Id
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


	//Upgrade_Id
	public function getUpgrade_Id(){
		return $this->Upgrade_Id;
	}

	public function getsqlUpgrade_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Upgrade_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setUpgrade_Id($Upgrade_Id){
		$this->Upgrade_Id = $Upgrade_Id;
	}


}
