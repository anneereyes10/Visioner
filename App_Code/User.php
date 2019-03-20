<?php
$clsUser = new User();

class User{

	private $table = "user_account";

	public function __construct(){}

  public function UpdatePasswordByEmail($email,$password){

		$Database = new Database();
		$conn = $Database->GetConn();

		$sql="UPDATE `".$this->table."` SET `user_pass`='".$password."' WHERE `user_email`='".$email."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

		mysqli_close($conn);
	}

  public function GetNameById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
    $name = '';
		$sql="SELECT * FROM `".$this->table."`
				WHERE `user_id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

    while($row = mysqli_fetch_array($result))
    {
      $name = $row['full_name'];
    }
		mysqli_close($conn);

		return $name;
	}

  public function GetEmailById($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
    $name = '';
		$sql="SELECT `user_email` FROM `".$this->table."`
				WHERE `user_id` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

    while($row = mysqli_fetch_array($result))
    {
      $name = $row['user_email'];
    }
		mysqli_close($conn);

		return $name;
	}



  public function GetCodeByEmail($id){

		$Database = new Database();
		$conn = $Database->GetConn();

		$id = mysqli_real_escape_string($conn,$id);
    $code = '';
		$sql="SELECT * FROM `".$this->table."`
				WHERE `user_email` = '".$id."'";

		$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));

    while($row = mysqli_fetch_array($result))
    {
      $code = md5($row['user_id'].$row['user_email'].$row['user_pass']."JumEE");
    }
		mysqli_close($conn);

		return $code;
	}
}
