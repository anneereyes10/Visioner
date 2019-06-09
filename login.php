<?php

// header("Location: index.php?login");

include("includes/db.php");
?>

        <div class="page-head">
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">LOG-IN</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->


        <!-- Login-area -->
                <div class="register-area" style="background-color: rgb(249, 249, 249);">
            <div class="container">

	<!-- Login Area -->
  <?php
  if (!empty($_GET['rp'])) {
    // code...
    $msg = '<div class="alert alert-success">
    <strong>Success!</strong> Password has been changed.
    </div>';
    echo $msg;
  }
  ?>
                <div class="col-md-6">
                  <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 login-blocks">
                      <center><h4><strong>LOG</strong>-IN</h4></center>
                      <hr>
                      <form action="" method="post">
                        <div class="form-group">
                          <label for="email">Email Address:</label>
                          <input type="email" class="form-control" name="u_email" placeholder="Enter Email Address" required />
                        </div>
                        <div class="form-group">
                          <label for="password">Password:</label>
                          <input type="password" class="form-control" name="u_pass" placeholder="Enter Password" required />
                        </div>
                        <div class="text-center">
                          <input type="submit" class="btn btn-finish btn-primary pull-right" name="login" value="Login" />
                        </div>
                        <div class="form-group">
                          <a href="user/forgotpassword.php">Forgot Password?</a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
          			<div class="col-md-6">
                  <div class="box-for overflow">
                    <div class="col-md-12 col-xs-12 register-blocks">
                      <center><h4>NOT YET <strong>REGISTERED?</strong></h4></center>
                      <hr>
                      <form action="" method="post">
                        <br><br>
                        <div class="text-center">
                          <h2><a href="register.php" class="btn btn-finish btn-primary pull-right" >New? Register here</a></h2><br><br><br>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>


<?php
	if(isset($_POST['login']))
	{

		$email = $_POST['u_email'];
		$pass = $_POST['u_pass'];

		$sel_u = "select * from user_account where user_pass='$pass' AND user_email='$email'";

		$run_u = mysqli_query($con, $sel_u);
    while($row = mysqli_fetch_array($run_u))
		{
			$uid = $row['user_id'];
		}

		$check_user = mysqli_num_rows($run_u);

		if($check_user==0)
		{
			echo "<script>alert('Password or email is incorrect, please try again!')</script>";
			echo "<script>window.open('index.php?login','_self')</script>";
			exit();
		}

		$ip = getIP();


		if($check_user>0)
		{

      		$_SESSION['user_email']=$email;
          		$_SESSION['uid']=$uid;


		echo "<script>window.open('index.php?home','_self')</script>";

		}
		else
		{
		echo "<script>alert('User not found!')</script>";
		echo "<script>window.open('index.php?login','_self')</script>";
		}
	}
?>
