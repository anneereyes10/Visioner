<?php
require_once(dirname(__FILE__)."/../../App_Code/DatabaseModel.php");
// After uploading to online server, change this connection accordingly

$con = mysqli_connect($mdlDB->getHost(),$mdlDB->getUser(),$mdlDB->getPassword(),$mdlDB->getDbName());

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


?>
