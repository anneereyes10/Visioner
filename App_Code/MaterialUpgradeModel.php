<?php
$mdlMaterialUpgrade = new MaterialUpgradeModel();
class MaterialUpgradeModel{

	private $Id = "";
	private $PartMaterial_Id = "";
	private $Upgrade_Id = "";

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


	public function getPartMaterial_Id(){
		return $this->PartMaterial_Id;
	}

	public function getsqlPartMaterial_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->PartMaterial_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setPartMaterial_Id($PartMaterial_Id){
		$this->PartMaterial_Id = $PartMaterial_Id;
	}


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
