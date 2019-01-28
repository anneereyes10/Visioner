<?php
$clsFinishItem = new FinishItem();
class FinishItem{

	private $table = "finishitem";

	public function __construct(){}

	public function Add($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$sql = "INSERT INTO `".$this->table."`
			(
				`Finish_Id`,
				`Layout_Id`,
				`PartMaterial_Id`,
				`MaterialUpgrade_Id`
			) VALUES (
				 '".$mdl->getsqlFinish_Id()."',
				 '".$mdl->getsqlLayout_Id()."',
				 '".$mdl->getsqlPartMaterial_Id()."',
				 '".$mdl->getsqlMaterialUpgrade_Id()."'
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
				 `Finish_Id`='".$mdl->getsqlFinish_Id()."',
				 `Layout_Id`='".$mdl->getsqlLayout_Id()."',
				 `PartMaterial_Id`='".$mdl->getsqlPartMaterial_Id()."'
				 `MaterialUpgrade_Id`='".$mdl->getsqlMaterialUpgrade_Id()."'
		 WHERE `FinishItem_Id`='".$mdl->getsqlId()."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		 mysqli_close($conn);
	}

	public function UpdateFinish_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Finish_Id`='".$value."'
			WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdateLayout_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`Layout_Id`='".$value."'
			WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdatePartMaterial_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`PartMaterial_Id`='".$value."'
			WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function UpdateMaterialUpgrade_Id($id,$value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);
		$id = mysqli_real_escape_string($conn,$id);

		$sql="UPDATE `".$this->table."` SET
			`MaterialUpgrade_Id`='".$value."'
			WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function Delete($id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$id = mysqli_real_escape_string($conn,$id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `FinishItem_Id` = '".$id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

			mysqli_close($conn);

	}

	public function DeleteMaterialChange($Finish_Id,$RoomPart_Id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$Finish_Id = mysqli_real_escape_string($conn,$Finish_Id);
		$RoomPart_Id = mysqli_real_escape_string($conn,$RoomPart_Id);
		$sql="DELETE `FI` FROM `".$this->table."` AS `FI`
			INNER JOIN `PartMaterial` AS `PM`
			ON `PM`.`PartMaterial_Id` = `FI`.`PartMaterial_Id`
			WHERE `FI`.`Finish_Id` = '".$Finish_Id."'
			AND `PM`.`RoomPart_Id` = '".$RoomPart_Id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

	}

	public function DeleteUpgradeChange($Finish_Id,$PartMaterial_Id){

		$Database = new Database();
		$conn = $Database->GetConn();
		$Finish_Id = mysqli_real_escape_string($conn,$Finish_Id);
		$PartMaterial_Id = mysqli_real_escape_string($conn,$PartMaterial_Id);
		$sql="DELETE FROM `".$this->table."`
			WHERE `PartMaterial_Id` = '".$PartMaterial_Id."'
			AND `MaterialUpgrade_Id` != '0'
			AND `Finish_Id` != '".$Finish_Id."'";
		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

	}

	public function IsExist($mdl){

		$Database = new Database();
		$conn = $Database->GetConn();
		$val = false;
		$msg = "";
		$sql = "SELECT * FROM `".$this->table."` AS `count`
			WHERE
			`FinishItem_Id` != '".$mdl->getsqlId()."'AND
			`Finish_Id` = '".$mdl->getsqlFinish_Id()."'AND
			`Layout_Id` = '".$mdl->getsqlLayout_Id()."'AND
			`PartMaterial_Id` = '".$mdl->getsqlPartMaterial_Id()."'AND
			`MaterialUpgrade_Id` = '".$mdl->getsqlMaterialUpgrade_Id()."'";
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

	public function GetFinish_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Finish_Id` FROM `".$this->table."`
		WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Finish_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetLayout_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `Layout_Id` FROM `".$this->table."`
		WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['Layout_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetPartMaterial_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `PartMaterial_Id` FROM `".$this->table."`
		WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['PartMaterial_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetMaterialUpgrade_IdById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = "";
		$id = mysqli_real_escape_string($conn,$id);

		$sql="SELECT `MaterialUpgrade_Id` FROM `".$this->table."`
		WHERE `FinishItem_Id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		while($row = mysqli_fetch_array($result))
		{
			$value = $row['MaterialUpgrade_Id'];
		}

		mysqli_close($conn);

		return $value;
	}

	public function GetById($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `FinishItem_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ModelTransfer($result);
	}

	public function GetByFinish_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Finish_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByFinish_IdLayout_Id($Finish_Id,$Layout_Id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$Finish_Id = mysqli_real_escape_string($conn,$Finish_Id);
		$Layout_Id = mysqli_real_escape_string($conn,$Layout_Id);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Finish_Id` = '$Finish_Id'
		AND `Layout_Id` = '$Layout_Id'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByLayout_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `Layout_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByPartMaterial_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `PartMaterial_Id` = '".$value."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);

		return $this->ListTransfer($result);
	}

	public function GetByMaterialUpgrade_Id($value){

		$Database = new Database();
		$conn = $Database->GetConn();

		$value = mysqli_real_escape_string($conn,$value);

		$sql="SELECT * FROM `".$this->table."`
		WHERE `MaterialUpgrade_Id` = '".$value."'";

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

		$mdl = new FinishItemModel();
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
			$mdl = new FinishItemModel();
			$mdl = $this->ToModel($row);
			array_push($lst,$mdl);
		}
		return $lst;
	}

	public function ToModel($row){
		$mdl = new FinishItemModel();
		$mdl->setId((isset($row['FinishItem_Id'])) ? $row['FinishItem_Id'] : '');
		$mdl->setFinish_Id((isset($row['Finish_Id'])) ? $row['Finish_Id'] : '');
		$mdl->setLayout_Id((isset($row['Layout_Id'])) ? $row['Layout_Id'] : '');
		$mdl->setPartMaterial_Id((isset($row['PartMaterial_Id'])) ? $row['PartMaterial_Id'] : '');
		$mdl->setMaterialUpgrade_Id((isset($row['MaterialUpgrade_Id'])) ? $row['MaterialUpgrade_Id'] : '');
		return $mdl;
	}
}
