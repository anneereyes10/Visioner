<?php
session_start();

class Database{
/**
 * Connect to the mysql database.
 */
	private $conn;
	public function __construct(){


		// $dbhost = 'localhost';
		// $dbuser = 'u841288402_build';
		// $dbpass = '4L;sw0^JdrL|RxE';
		// $dbname = 'u841288402_build';

		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'designbuild3';

		$this->conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname) or die("Connection Error");
	}

	public function GetConn(){
		return $this->conn;
	}

}
?>
