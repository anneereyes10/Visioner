<?php
$mdltransaction_type = new transaction_typeModel();
class transaction_typeModel{

	private $user_id = "";
	private $user_email = "";
	private $ip_address = "";
	private $transaction_type = "";

	public function __construct(){}

	//user_id
	public function getuser_id(){
		return $this->user_id;
	}

	public function getsqluser_id(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->user_id);
		mysqli_close($conn);
		return $value;
	}

	public function setuser_id($user_id){
		$this->user_id = $user_id;
	}


	//user_email
	public function getuser_email(){
		return $this->user_email;
	}

	public function getsqluser_email(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->user_email);
		mysqli_close($conn);
		return $value;
	}

	public function setuser_email($user_email){
		$this->user_email = $user_email;
	}


	//ip_address
	public function getip_address(){
		return $this->ip_address;
	}

	public function getsqlip_address(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->ip_address);
		mysqli_close($conn);
		return $value;
	}

	public function setip_address($ip_address){
		$this->ip_address = $ip_address;
	}


	//transaction_type
	public function gettransaction_type(){
		return $this->transaction_type;
	}

	public function getsqltransaction_type(){
		$Database = new Database();
		$conn = $Database->GetConn();
		$value = mysqli_real_escape_string($conn,$this->transaction_type);
		mysqli_close($conn);
		return $value;
	}

	public function settransaction_type($transaction_type){
		$this->transaction_type = $transaction_type;
	}


}
