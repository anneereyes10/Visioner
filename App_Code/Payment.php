<?php
require_once ("PaymentModel.php");
$clsPayment = new Payment();
class Payment{

	private $table = "payment";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`Project_Id`,
				`Payment_ReceiptDate`,
				`Payment_ReceiptStatus`,
				`Payment_AppointmentDate`,
				`Payment_AppointmentStatus`
			) VALUES (
				'".$mdl->getsqlProject_Id()."',
				'".$mdl->getsqlReceiptDate()."',
				'".$mdl->getsqlReceiptStatus()."',
				'".$mdl->getsqlAppointmentDate()."',
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
				 `Payment_ReceiptDate`='".$mdl->getsqlReceiptDate()."',
				 `Payment_ReceiptStatus`='".$mdl->getsqlReceiptStatus()."',
				 `Payment_AppointmentDate`='".$mdl->getsqlAppointmentDate()."',
				 `Payment_AppointmentStatus`='".$mdl->getsqlAppointmentStatus()."',
				 `Payment_Status`='".$mdl->getsqlStatus()."'
		 WHERE `Payment_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function UpdateProject_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Project_Id`='".$value."'
			WHERE `Payment_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateReceiptDate($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Payment_ReceiptDate`='".$value."'
			WHERE `Payment_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateReceiptStatus($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Payment_ReceiptStatus`='".$value."'
			WHERE `Payment_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateAppointmentDate($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Payment_AppointmentDate`='".$value."'
			WHERE `Payment_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateAppointmentStatus($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Payment_AppointmentStatus`='".$value."'
			WHERE `Payment_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateStatus($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Payment_Status`='".$value."'
			WHERE `Payment_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `Payment_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";


		// Project_Id
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`Payment_Id` != '".$mdl->getsqlId()."'AND
			`Project_Id` = '".$mdl->getsqlProject_Id()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputProject_Id\")'>Project</a>: Already Paid</p>";
			$val = true;
		}


		mysqli_close($conn);

		return array("val"=>"$val","msg"=>"$msg");

	}

	public function Get($status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Payment_Status` = '".$status."'";
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

	public function GetProject_IdById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Project_Id` FROM `".$this->table."`
		WHERE `Payment_Id` = '".$id."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Project_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetReceiptDateById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Payment_ReceiptDate` FROM `".$this->table."`
		WHERE `Payment_Id` = '".$id."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Payment_ReceiptDate'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetReceiptStatusById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Payment_ReceiptStatus` FROM `".$this->table."`
		WHERE `Payment_Id` = '".$id."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Payment_ReceiptStatus'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetAppointmentDateById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Payment_AppointmentDate` FROM `".$this->table."`
		WHERE `Payment_Id` = '".$id."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Payment_AppointmentDate'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetAppointmentStatusById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Payment_AppointmentStatus` FROM `".$this->table."`
		WHERE `Payment_Id` = '".$id."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Payment_AppointmentStatus'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetStatusById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Payment_Status` FROM `".$this->table."`
		WHERE `Payment_Id` = '".$id."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Payment_Status'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetById($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Payment_Id` = '".$value."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByProject_Id($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Project_Id` = '".$value."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByReceiptDate($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Payment_ReceiptDate` = '".$value."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByReceiptStatus($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Payment_ReceiptStatus` = '".$value."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByAppointmentDate($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Payment_AppointmentDate` = '".$value."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByAppointmentStatus($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Payment_AppointmentStatus` = '".$value."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByDateCreated($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Payment_DateCreated` = '".$value."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByStatus($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Payment_Status` = '".$value."'
		AND `Payment_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function SetImage($image,$id){

		$val = true;
		$msg = "";
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
			array_push($lst,$mdl);
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
