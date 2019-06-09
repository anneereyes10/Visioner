hi <?php
require_once(dirname(__FILE__)."/../App_Code/DatabaseModel.php");
$con = mysqli_connect($mdlDB->getHost(),$mdlDB->getUser(),$mdlDB->getPassword(),$mdlDB->getDbName());

        $payquery = "SELECT COUNT(*) as PP FROM payment WHERE Payment_ReceiptStatus = 0";

        $payselect = mysqli_query($con,$payquery);
		while ($row_p=mysqli_fetch_array($payselect))
		{
		$result=$row_p['PP'];
		echo $result;
		}
	?>
