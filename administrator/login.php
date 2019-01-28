<?php 
session_start();

?>
<!DOCTYPE>
<html>
  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator Panel</title>

    <!-- Bootstrap core CSS-->
    <link href="styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="styles/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="styles/css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-light">
<h2 style="color:Red; text-align:center;"><?php echo @$_GET['not_admin']; ?></h2>

<h2 style="color:Red; text-align:center;"><?php echo @$_GET['logged_out']; ?></h2>
    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form method="post" action="login.php">
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required="required" autofocus="autofocus"/>
                <label for="inputEmail">Email address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required="required" autofocus="autofocus"/>
                <label for="inputPassword">Password</label>
              </div>
            </div>
			<button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="styles/vendor/jquery/jquery.min.js"></script>
    <script src="styles/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="styles/vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>


<?php 
include("includes/db.php"); 
	
	if(isset($_POST['login'])){
	
		$email = $_POST['email'];
		$pass = $_POST['password'];
	
		$sel_user = "select * from admin_account where email='$email' AND password='$pass'";
		
		$run_user = mysqli_query($con, $sel_user); 
		
		$check_user = mysqli_num_rows($run_user); 
	
		if($check_user==1)
		{
	
			$_SESSION['email']=$email; 
	
			echo "<script>window.open('index.php?logged_in=You Have Successfully Logged In!','_self')</script>";
	
		}
		else 
		{
			echo "<script>alert('Password or Email is wrong, try again!')</script>";
		}
	}
	
	
	
	
	








?>