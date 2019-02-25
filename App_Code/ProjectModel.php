<?php
$mdlProject = new ProjectModel();
class ProjectModel{

	private $Id = "";
	private $Type = "";
	private $User_Id = "";
	private $Name = "";
	private $Plan_Id = "";
	private $DateCreated = "";
	private $Status = "";

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


	//Type
	public function getType(){
		return $this->Type;
	}

	public function getsqlType(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Type);
		mysqli_close($conn);
		return $value;
	}

	public function setType($Type){
		$this->Type = $Type;
	}


	//User_Id
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


	//Name
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


	//DateCreated
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


	//Status
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
