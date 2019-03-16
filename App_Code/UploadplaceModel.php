<?php
$mdlUploadplace = new UploadplaceModel();
class UploadplaceModel{

	private $Id = "";
	private $Place = "";
	private $DateTime = "";
	private $Used = "";
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


	//Place
	public function getPlace(){
		return $this->Place;
	}

	public function getsqlPlace(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Place);
		mysqli_close($conn);
		return $value;
	}

	public function setPlace($Place){
		$this->Place = $Place;
	}


	//DateTime
	public function getDateTime(){
		return $this->DateTime;
	}

	public function getsqlDateTime(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->DateTime);
		mysqli_close($conn);
		return $value;
	}

	public function setDateTime($DateTime){
		$this->DateTime = $DateTime;
	}


	//Used
	public function getUsed(){
		return $this->Used;
	}

	public function getsqlUsed(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->Used);
		mysqli_close($conn);
		return $value;
	}

	public function setUsed($Used){
		$this->Used = $Used;
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
