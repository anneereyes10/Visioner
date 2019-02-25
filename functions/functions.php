<?php

// $con = mysqli_connect("localhost","u841288402_build","4L;sw0^JdrL|RxE","u841288402_build");
$con = mysqli_connect("localhost","root","","designbuild3");

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}



//getting IP address of user
function getIP()
{
	$ip=$_SERVER['REMOTE_ADDR'];

	if(!empty($_SERVER['HTTP_CLIENT_IP']))
	{
		$ip=$_SERVER['HTTP_CLIENT_IP'];
	}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	}

	return $ip;
}


?>
