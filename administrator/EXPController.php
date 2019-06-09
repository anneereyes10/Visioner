<?php
require_once(dirname(__FILE__)."/../App_Code/DatabaseModel.php");
class EXPController {
	private $conn;
  function __construct() {
  	$this->conn = $this->connectEXP();
	}
	function connectEXP() {
		$conn = mysqli_connect($mdlDB->getHost(),$mdlDB->getUser(),$mdlDB->getPassword(),$mdlDB->getDbName());
		return $conn;
	}
	function runEXP($query) {
	  $result = mysqli_query($this->conn,$query);
	  while($row=mysqli_fetch_assoc($result)) {
	  $resultset[] = $row;
	  }
	  if(!empty($resultset))
	  return $resultset;
	}
}
?>
