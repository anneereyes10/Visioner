<?php
$mdlPayment = new PaymentModel();
class PaymentModel{

	private $Id = "";
	private $Project_Id = "";
	private $ReceiptDate = "";
	private $ReceiptStatus = "";
	private $AppointmentDate = "";
	private $AppointmentStatus = "";
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


	//ReceiptDate
	public function getReceiptDate(){
		return $this->ReceiptDate;
	}

	public function getsqlReceiptDate(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->ReceiptDate);
		mysqli_close($conn);
		return $value;
	}

	public function setReceiptDate($ReceiptDate){
		$this->ReceiptDate = $ReceiptDate;
	}


	//ReceiptStatus
	public function getReceiptStatus(){
		return $this->ReceiptStatus;
	}

	public function getsqlReceiptStatus(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->ReceiptStatus);
		mysqli_close($conn);
		return $value;
	}

	public function setReceiptStatus($ReceiptStatus){
		$this->ReceiptStatus = $ReceiptStatus;
	}


	//AppointmentDate
	public function getAppointmentDate(){
		return $this->AppointmentDate;
	}

	public function getsqlAppointmentDate(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->AppointmentDate);
		mysqli_close($conn);
		return $value;
	}

	public function setAppointmentDate($AppointmentDate){
		$this->AppointmentDate = $AppointmentDate;
	}


	//AppointmentStatus
	public function getAppointmentStatus(){
		return $this->AppointmentStatus;
	}

	public function getsqlAppointmentStatus(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->AppointmentStatus);
		mysqli_close($conn);
		return $value;
	}

	public function setAppointmentStatus($AppointmentStatus){
		$this->AppointmentStatus = $AppointmentStatus;
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
