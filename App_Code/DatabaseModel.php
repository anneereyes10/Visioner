<?php
$mdlDB = new DatabaseModel();
class DatabaseModel{

	private $Host = "localhost";
	private $User = "u841288402_build";
	private $Password = "4L;sw0^JdrL|RxE";
	private $DbName = "u841288402_build";

	// private $Host = "localhost";
	// private $User = "root";
	// private $Password = "";
	// private $DbName = "designbuild3";

	public function __construct(){}

	//Host
	public function getHost(){
		return $this->Host;
	}

	//User
	public function getUser(){
		return $this->User;
	}

	//Password
	public function getPassword(){
		return $this->Password;
	}

	//DbName
	public function getDbName(){
		return $this->DbName;
	}
}
?>
