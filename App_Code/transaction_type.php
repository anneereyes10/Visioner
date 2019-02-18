<?php
require_once ("transaction_typeModel.php");
$clstransaction_type = new transaction_type();
class transaction_type{

	private $table = "transaction_type";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`user_id`,
				`user_email`,
				`ip_address`,
				`transaction_type`
			) VALUES (
				'".$mdl->getsqluser_id()."',
				'".$mdl->getsqluser_email()."',
				'".$mdl->getsqlip_address()."',
				'".$mdl->getsqltransaction_type()."'
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
				 `user_id`='".$mdl->getsqluser_id()."',
				 `user_email`='".$mdl->getsqluser_email()."'
				 `ip_address`='".$mdl->getsqlip_address()."'
				 `transaction_type`='".$mdl->getsqltransaction_type()."'
		 WHERE `transaction_type_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function Updateuser_id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`user_id`='".$value."'
			WHERE `transaction_type_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Updateuser_email($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`user_email`='".$value."'
			WHERE `transaction_type_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Updateip_address($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`ip_address`='".$value."'
			WHERE `transaction_type_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Updatetransaction_type($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`transaction_type`='".$value."'
			WHERE `transaction_type_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `transaction_type_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";

		// user_id
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`transaction_type_Id` != '".$mdl->getsqlId()."'AND
			`user_id` = '".$mdl->getsqluser_id()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputuser_id\")'>user_id</a>: " . $mdl->getuser_id() . "</p>";
			$val = true;
		}

		// user_email
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`transaction_type_Id` != '".$mdl->getsqlId()."'AND
			`user_email` = '".$mdl->getsqluser_email()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputuser_email\")'>user_email</a>: " . $mdl->getuser_email() . "</p>";
			$val = true;
		}

		// ip_address
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`transaction_type_Id` != '".$mdl->getsqlId()."'AND
			`ip_address` = '".$mdl->getsqlip_address()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputip_address\")'>ip_address</a>: " . $mdl->getip_address() . "</p>";
			$val = true;
		}

		// transaction_type
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`transaction_type_Id` != '".$mdl->getsqlId()."'AND
			`transaction_type` = '".$mdl->getsqltransaction_type()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputtransaction_type\")'>transaction_type</a>: " . $mdl->gettransaction_type() . "</p>";
			$val = true;
		}

		mysqli_close($conn);

		return array("val"=>"$val","msg"=>"$msg");

	}

	public function Get($status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`
		WHERE `transaction_type_Status` = '".$status."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function Getuser_idById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `user_id` FROM `".$this->table."`
		WHERE `transaction_type_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['user_id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function Getuser_emailById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `user_email` FROM `".$this->table."`
		WHERE `transaction_type_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['user_email'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function Getip_addressById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `ip_address` FROM `".$this->table."`
		WHERE `transaction_type_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['ip_address'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function Gettransaction_typeById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `transaction_type` FROM `".$this->table."`
		WHERE `transaction_type_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['transaction_type'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetByuser_id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `user_id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByuser_email($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `user_email` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByip_address($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `ip_address` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetBytransaction_type($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `transaction_type` = '".$value."'";

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

		$mdl = new transaction_typeModel();
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
			$mdl = new transaction_typeModel();
			$mdl = $this->ToModel($row);
			array_push($lst,$mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new transaction_typeModel();
		$mdl->setuser_id((isset($row['user_id'])) ? $row['user_id'] : '');
		$mdl->setuser_email((isset($row['user_email'])) ? $row['user_email'] : '');
		$mdl->setip_address((isset($row['ip_address'])) ? $row['ip_address'] : '');
		$mdl->settransaction_type((isset($row['transaction_type'])) ? $row['transaction_type'] : '');
		return $mdl;
	}
}
