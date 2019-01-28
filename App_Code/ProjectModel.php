<?php
$mdlProject = new ProjectModel();
class ProjectModel{

	private $Id = "";
	private $User_Id = "";
	private $Name = "";
	private $Layout_Id = "";
	private $DateCreated = "";
	private $Status = "";

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

	public function getUser_Id(){
		return $this->User_Id;
	}

	public function getsqlUser_Id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->User_Id);
		mysqli_close($conn);
		return $value;
	}

	public function setUser_Id($User_Id){
	$this->User_Id = $User_Id;
	}

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
