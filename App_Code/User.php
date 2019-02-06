<?php
$clsUser = new User();

class User{

	private $table = "user_account";

	public function __construct(){}

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


}
