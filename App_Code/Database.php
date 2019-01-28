<?php
session_start();
class Database{
/**
 * Connect to the mysql database.
 */
	private $conn;
	public function __construct(){
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'designbuild';

		$this->conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname) or die("Connection Error");
	}

	public function GetConn(){
		return $this->conn;
	}

}
?>
