<?php
$mdlFinishItem = new FinishItemModel();
class FinishItemModel{

	private $Id = "";
	private $Finish_Id = "";
	private $Plan_Id = "";
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


	//Finish_Id
	public function getFinish_Id(){
		return $this->Finish_Id;
	}

	public function getsqlFinish_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Finish_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setFinish_Id($Finish_Id){
		$this->Finish_Id = $Finish_Id;
	}


	//Plan_Id
	public function getPlan_Id(){
		return $this->Plan_Id;
	}

	public function getsqlPlan_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Plan_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setPlan_Id($Plan_Id){
		$this->Plan_Id = $Plan_Id;
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
