        <div class="content-area user-profiel" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">   
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 profiel-container">

                        <form action="" method="post">

                            <div class="profiel-header">
                                <h3>
                                    <b>UPDATE</b> YOUR PASSWORD <br>
                                </h3>
                                <hr>
                            </div>

                            <div class="clear">

                                <div class="col-sm-10 col-sm-offset-1">
									<div class="form-group">
                                        <label>Enter Current Password:</label>
                                        <input type="password" class="form-control" name="current_pass" required >
                                    </div>
                                    <div class="form-group">
                                        <label>Enter New Password:</label>
                                        <input type="password" class="form-control" name="new_pass" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm New Password:</label>
                                        <input type="password" class="form-control" name = "new_pass_again" required />
                                    </div> 
                                </div>
								
                                <div class="col-sm-10 col-sm-offset-1">
                                    <input type="submit" class="btn btn-finish btn-primary pull-right" name="change_pass" value="Update" />
                                </div> 
								
								
	
							</div>       
						</form>
					</div>
				</div><!-- end row -->
			</div>
		</div>
<?php
include("../includes/db.php");

if(isset($_POST['change_pass']))
{
	$user=$_SESSION['user_email'];
	
	$current_pass = $_POST['current_pass'];
	$new_pass = $_POST['new_pass'];
	$new_pass_again = $_POST['new_pass_again'];
	
	$sel_pass = "select * from user_account where user_pass='$current_pass' AND user_email='$user'";
	
	$run_pass = mysqli_query($con, $sel_pass);
	
	$check_pass = mysqli_num_rows($run_pass);
	
	if($check_pass==0)
	{
		echo "<script>alert('Your current password is wrong!')</script>";
		exit();
	}
	
	if($new_pass!=$new_pass_again)
	{
		echo "<script>alert('Passwords do not match')</script>";
		exit();
	}
	else
	{
		$update_pass = "update user_account set user_pass='$new_pass' where user_email='$user'";
		
		$run_update = mysqli_query($con,$update_pass);
		
		echo "<script>alert('Your password has been changed!')</script>";
		echo "<script>window.open('user_account.php?change_password','_self')</script>";
	}
}

?>