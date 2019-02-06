<?php
$clsPayment = new Payment();

class Payment{

	private $table = "payment";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$ap = (empty($mdl->getsqlAppointmentDate()))?'':date_format(date_create($mdl->getsqlAppointmentDate()),"Y-m-d");

		$sql = "INSERT INTO `".$this->table."`
				(
					`Project_Id`,
					`Payment_ReceiptDate`,
					`Payment_ReceiptStatus`,
					`Payment_AppointmentDate`,
					`Payment_AppointmentStatus`
					-- `Payment_Description`
				) VALUES (
					'".$mdl->getsqlProject_Id()."',
					'".date_format(date_create($mdl->getsqlReceiptDate()),"Y-m-d")."',
					'".$mdl->getsqlReceiptStatus()."',
					'".$ap."',
					'".$mdl->getsqlAppointmentStatus()."'

				)";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$id = mysqli_insert_id($conn);

		mysqli_close($conn);

		return $id;
	}

	public function Update($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="UPDATE `".$this->table."` SET
			`Project_Id`='".$mdl->getsqlProject_Id()."',
			`Payment_ReceiptDate`='".date_format(date_create($mdl->getsqlReceiptDate()),"Y-m-d")."',
			`Payment_ReceiptStatus`='".$mdl->getsqlReceiptStatus()."',,
			`Payment_AppointmentDate`='".date_format(date_create($mdl->getsqlAppointmentDate()),"Y-m-d")."',
			`Payment_AppointmentStatus`='".$mdl->getsqlAppointmentStatus()."',
			`Payment_Status`='".$mdl->getsqlStatus()."'
			WHERE `Payment_Id`='".$mdl->getsqlId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateReceiptStatus($id,$status){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="UPDATE `".$this->table."` SET
			`Payment_ReceiptStatus`='".$status."'
			WHERE `Payment_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateAppointmentStatus($id,$status){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="UPDATE `".$this->table."` SET
			`Payment_AppointmentStatus`='".$status."'
			WHERE `Payment_Id`='".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateAppointmentDate($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql="UPDATE `".$this->table."` SET
			`Payment_AppointmentDate`='".$mdl->getAppointmentDate()."',
			`Payment_AppointmentStatus`='0'
			WHERE `Payment_Id`='".$mdl->getId()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";

		$sql = "SELECT `Payment_Id` FROM `".$this->table."` AS `count`
				WHERE
				`Payment_Id` != '".$mdl->getsqlId()."' AND
				`Project_Id` = '".$mdl->getsqlProject_Id()."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		mysqli_close($conn);

		if($num_rows > 0)
		{
			return true;
		}

		return false;
	}

	public function IsDateTaken($Payment_Id, $Payment_AppointmentDate){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";

		$sql = "SELECT `Payment_Id` FROM `".$this->table."` AS `count`
				WHERE
				`Payment_Id` != '".$Payment_Id."' AND
				`Payment_AppointmentDate` = '".$Payment_AppointmentDate."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$num_rows = mysqli_num_rows($result);

		mysqli_close($conn);

		if($num_rows > 0)
		{
			return true;
		}

		return false;
	}

	public function Get(){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByUserId($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."` AS `pay`
					INNER JOIN `project` AS `proj`
					ON `pay`.`Project_Id` = `proj`.`Project_Id`
				WHERE `User_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `Payment_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByReceiptStatus($value=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
				WHERE `Payment_ReceiptStatus` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function SetImage($image,$id){
		$val = true; // true - upload success | false - upload failed
		$msg = ""; // error message
		$clsImage = new Image();

		if(isset($image["name"]) && ($image["name"]!=""))
		{
			$result = $clsImage->Upload($image,$this->table,$id);
			if($result[0] != ""){
				$msg = $result[0];
			}
		}

		return array("val"=>$val,"msg"=>$msg);
	}

	public function ModelTransfer($result){

		$mdl = new PaymentModel();
		while($row = mysqli_fetch_array($result))
		{
			$mdl = $this->ToModel($row);
		}
		return $mdl;
	}

	public function ListTransfer($result){

		$lst = array();
		while($row = mysqli_fetch_array($result))
		{
			$mdl = new PaymentModel();
			$mdl = $this->ToModel($row);
			array_push($lst, $mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new PaymentModel();

		$mdl->setId((isset($row['Payment_Id'])) ? $row['Payment_Id'] : '');
		$mdl->setProject_Id((isset($row['Project_Id'])) ? $row['Project_Id'] : '');
		$mdl->setReceiptDate((isset($row['Payment_ReceiptDate'])) ? $row['Payment_ReceiptDate'] : '');
		$mdl->setReceiptStatus((isset($row['Payment_ReceiptStatus'])) ? $row['Payment_ReceiptStatus'] : '');
		$mdl->setAppointmentDate((isset($row['Payment_AppointmentDate'])) ? $row['Payment_AppointmentDate'] : '');
		$mdl->setAppointmentStatus((isset($row['Payment_AppointmentStatus'])) ? $row['Payment_AppointmentStatus'] : '');
		$mdl->setDateCreated((isset($row['Payment_DateCreated'])) ? $row['Payment_DateCreated'] : '');
		$mdl->setStatus((isset($row['Payment_Status'])) ? $row['Payment_Status'] : '');
		return $mdl;
	}

}
?>
