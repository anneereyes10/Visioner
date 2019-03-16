<?php
require_once ("UploadplaceModel.php");
$clsUploadplace = new Uploadplace();
class Uploadplace{

	private $table = "uploadplace";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`Uploadplace_Place`,
				`Uploadplace_DateTime`,
				`Uploadplace_Used`
			) VALUES (
				'".$mdl->getsqlPlace()."',
				'".$mdl->getsqlDateTime()."',
				'".$mdl->getsqlUsed()."'
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
				 `Uploadplace_Place`='".$mdl->getsqlPlace()."',
				 `Uploadplace_DateTime`='".$mdl->getsqlDateTime()."',
				 `Uploadplace_Used`='".$mdl->getsqlUsed()."',
				 `Uploadplace_Status`='".$mdl->getsqlStatus()."'
		 WHERE `Uploadplace_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function UpdatePlace($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Uploadplace_Place`='".$value."'
			WHERE `Uploadplace_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateDateTime($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Uploadplace_DateTime`='".$value."'
			WHERE `Uploadplace_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateUsed($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Uploadplace_Used`='".$value."'
			WHERE `Uploadplace_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function UpdateStatus($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Uploadplace_Status`='".$value."'
			WHERE `Uploadplace_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `Uploadplace_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();

		$val = false;
		$msg = "";

		// Uploadplace_Id
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`Uploadplace_Id` != '".$mdl->getsqlId()."' AND
			`Uploadplace_Id` = '".$mdl->getsqlId()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputId\")'>Id</a>: " . $mdl->getId() . "</p>";
			$val = true;
		}

		// Uploadplace_Place
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`Uploadplace_Id` != '".$mdl->getsqlId()."' AND
			`Uploadplace_Place` = '".$mdl->getsqlPlace()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputPlace\")'>Place</a>: " . $mdl->getPlace() . "</p>";
			$val = true;
		}

		// Uploadplace_DateTime
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`Uploadplace_Id` != '".$mdl->getsqlId()."' AND
			`Uploadplace_DateTime` = '".$mdl->getsqlDateTime()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputDateTime\")'>DateTime</a>: " . $mdl->getDateTime() . "</p>";
			$val = true;
		}

		// Uploadplace_Used
		$sql = "SELECT COUNT(*) FROM `".$this->table."`
			WHERE
			`Uploadplace_Id` != '".$mdl->getsqlId()."' AND
			`Uploadplace_Used` = '".$mdl->getsqlUsed()."'
		";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		$rows = mysqli_fetch_row($result);
		if($rows[0] > 0)
		{
			$msg .= "<p><a href='javascript:void(0)' class='alert-link' onclick='setFocus(\"inputUsed\")'>Used</a>: " . $mdl->getUsed() . "</p>";
			$val = true;
		}

		mysqli_close($conn);

		return array("val"=>"$val","msg"=>"$msg");

	}

	public function Get($status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Uploadplace_Status` = '".$status."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetPlaceById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Uploadplace_Place` FROM `".$this->table."`
		WHERE `Uploadplace_Id` = '".$id."'
		AND `Uploadplace_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Uploadplace_Place'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetDateTimeById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Uploadplace_DateTime` FROM `".$this->table."`
		WHERE `Uploadplace_Id` = '".$id."'
		AND `Uploadplace_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Uploadplace_DateTime'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetUsedById($id,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT `Uploadplace_Used` FROM `".$this->table."`
		WHERE `Uploadplace_Id` = '".$id."'
		AND `Uploadplace_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Uploadplace_Used'];
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

		$sql="SELECT `Uploadplace_Status` FROM `".$this->table."`
		WHERE `Uploadplace_Id` = '".$id."'
		AND `Uploadplace_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Uploadplace_Status'];
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
		WHERE `Uploadplace_Id` = '".$value."'
		AND `Uploadplace_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByPlace($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Uploadplace_Place` = '".$value."'
		AND `Uploadplace_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByDateTime($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Uploadplace_DateTime` = '".$value."'
		AND `Uploadplace_Status` = '".$status."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByUsed($value,$status=0){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$status = mysqli_real_escape_string($conn,$status);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Uploadplace_Used` = '".$value."'
		AND `Uploadplace_Status` = '".$status."'";

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
		WHERE `Uploadplace_DateCreated` = '".$value."'
		AND `Uploadplace_Status` = '".$status."'";

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
		WHERE `Uploadplace_Status` = '".$value."'
		AND `Uploadplace_Status` = '".$status."'";

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

		$mdl = new UploadplaceModel();
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
			$mdl = new UploadplaceModel();
			$mdl = $this->ToModel($row);
			array_push($lst,$mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new UploadplaceModel();
		$mdl->setId((isset($row['Uploadplace_Id'])) ? $row['Uploadplace_Id'] : '');
		$mdl->setPlace((isset($row['Uploadplace_Place'])) ? $row['Uploadplace_Place'] : '');
		$mdl->setDateTime((isset($row['Uploadplace_DateTime'])) ? $row['Uploadplace_DateTime'] : '');
		$mdl->setUsed((isset($row['Uploadplace_Used'])) ? $row['Uploadplace_Used'] : '');
		$mdl->setDateCreated((isset($row['Uploadplace_DateCreated'])) ? $row['Uploadplace_DateCreated'] : '');
		$mdl->setStatus((isset($row['Uploadplace_Status'])) ? $row['Uploadplace_Status'] : '');
		return $mdl;
	}
}
