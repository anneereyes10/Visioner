<?php
// After uploading to online server, change this connection accordingly

$con = mysqli_connect("localhost","u841288402_build","4L;sw0^JdrL|RxE","u841288402_build");
// $con = mysqli_connect("localhost","root","","designbuild3");

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


?>
