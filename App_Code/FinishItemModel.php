<?php
$mdlFinishItem = new FinishItemModel();
class FinishItemModel{

	private $Id = "";
	private $Finish_Id = "";
	private $Layout_Id = "";
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
