<?php
session_start();
include("functions/functions.php");
include("includes/db.php");
$u = $_GET['u'];
$e = $_GET['e'];

	$sql="SELECT * FROM `user_account_p`
			WHERE `hashcode` = '".$u."'
      AND `user_email` = '".$e."'
      ";

	$result=mysqli_query($con,$sql) or die(mysqli_error($con));
	$num_rows = mysqli_num_rows($result);

  $userID = '';

  if ($num_rows > 0) {
    while($row = mysqli_fetch_array($result))
    {
      $sqli = "INSERT INTO `user_account`
  				(
  					`ip_address`,
  					`user_email`,
            `user_pass`,
            `full_name`
  				) VALUES (
  					'".$row['ip_address']."',
            '".$row['user_email']."',
            '".$row['user_pass']."',
            '".$row['full_name']."'
  				)";
          $userID = $row['user_id'];
    }
		$result=mysqli_query($con,$sqli) or die(mysqli_error($con));
    $sqli="DELETE FROM `user_account_p`
				WHERE `user_id` = '".$userID."'";
		$result=mysqli_query($con,$sqli) or die(mysqli_error($con));
    echo 'Email Verified';
  }else{
    echo 'Link is either used or not accessible';
  }

	mysqli_close($con);
?>
