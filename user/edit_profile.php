<!DOCTYPE>
<?php
include("../includes/db.php");

$user = $_SESSION['user_email'];

$get_pro = "select * from user_account where user_email='$user'";
	
$run_pro=mysqli_query($con,$get_pro);

$row_pro=mysqli_fetch_array($run_pro);

$u_id=$row_pro['user_id'];
$name=$row_pro['full_name'];
$add=$row_pro['address'];
$date=$row_pro['birthdate'];
$cont=$row_pro['contact'];
$gend=$row_pro['gender'];
?>

		
	 <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 profiel-container">

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="profiel-header">
                                <h3>
                                    <b>UPDATE</b> YOUR INFORMATION <br>
                                    <small>This information will let us know more about you.</small>
                                </h3>
                                <hr>
                            </div>
                            <div class="clear">
                                <br>
                                <hr>
                                <br>
                                <div class="col-sm-5 col-sm-offset-1">
                                    
                                    <div class="form-group">
                                        <label>Full Name :</label>
                                        <input type="text" class="form-control" name="fullname" required placeholder="Full Name" value="<?php echo $name; ?>"/>
                                    </div>
									<div class="form-group">
										<label>Birthdate :</label>
											<div class='input-group date' id='datepicker'>
												<input type='text' class="form-control" name = "birthday" required value="<?php echo $date; ?>" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
									</div>
									<div class="form-group">
                                        <label>Address:</label>
                                        <input type="text" class="form-control" placeholder="Address" required name="address" value="<?php echo $add;?>"/>
                                    </div>
                                </div>  

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>Contact Number : (+63) </label>
                                        <input type="text" class="form-control" placeholder="Contact Number" required name="contact" value="<?php echo $cont; ?>">
                                    </div>
									<div class="form-group">
                                        <label>Gender: </label>
										<br>
										<input type="radio" name="gender"
                                        <?php if (isset($gend) && $gend=="female") echo "checked";?>
										value="female">Female
										<input type="radio" name="gender"
										<?php if (isset($gend) && $gend=="male") echo "checked";?>
										value="male">Male
										<input type="radio" name="gender"
										<?php if (isset($gend) && $gend=="other") echo "checked";?>
										value="other">Other
									</div>
                                </div>
								
 
                            </div>
                    
                            <div class="col-sm-5 col-sm-offset-1">
                                <br>
                                <input type="submit" class='btn btn-finish btn-primary' name="edit"  value="Edit Information" />
                            </div>
                            <br>
                    </form>

                </div>
            </div><!-- end row -->

        </div>
    </div>




<?php 

	if(isset($_POST['edit']))
	{
		$ip = getIP();
		$id = $u_id;
		
		$new_name= $_POST['fullname'];
		$new_add= $_POST['address'];
		$new_date= $_POST['birthday'];
		$new_cont= $_POST['contact'];
		$new_gend= $_POST['gender'];
	
		 $update_user = "update user_account set full_name='$new_name',birthdate='$new_date',contact='$new_cont',address='$new_add',gender='$new_gend' where user_id='$id'";
		 
		 $run_user = mysqli_query($con, $update_user);
		 
		 if($run_user){
		 
		 echo "<script>alert('Account has been updated!')</script>";
		 
		 echo "<script>window.open('user_account.php?edit_profile','_self')</script>";
		 
		 }
	}

?>
         