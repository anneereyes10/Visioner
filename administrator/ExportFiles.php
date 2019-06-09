<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Place.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

include ("EXPController.php");
if(!isset($_SESSION['email'])){

	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
$db_handle = new EXPController();
$CustomerResult = $db_handle->runEXP("select user_email as Email, full_name as Name, birthdate as Birthdate, gender as Gender, contact as Contact, address as Address from user_account");
$AllPResult = $db_handle->runEXP("Select payment_status.user_email AS Email, project.Project_Name as Project, paymenttype.PaymentType_Name as Type, payment.Payment_ReceiptStatus as Status FROM
payment_status
INNER JOIN project
ON payment_status.user_id = project.User_Id
INNER JOIN payment
ON project.Project_Id = payment.Project_Id
INNER JOIN paymenttype
ON payment.PaymentType_Id = paymenttype.PaymentType_Id");
$PendPResult = $db_handle->runEXP("Select payment_status.user_email AS Email, project.Project_Name as Project, paymenttype.PaymentType_Name as Type FROM payment_status
INNER JOIN project
ON payment_status.user_id = project.User_Id
INNER JOIN payment
ON project.Project_Id = payment.Project_Id
INNER JOIN paymenttype
ON payment.PaymentType_Id = paymenttype.PaymentType_Id
WHERE payment.Payment_ReceiptStatus = 0");
$AllAResult = $db_handle->runEXP("Select appointment.user_email AS Email, project.Project_Name as Project, payment.Payment_AppointmentDate as Date, place.Place_Name as Place, payment.Payment_AppointmentStatus as Status
FROM appointment
INNER JOIN project
ON appointment.user_id = project.User_Id
INNER JOIN payment
ON project.Project_Id = payment.Project_Id
INNER JOIN place
ON payment.Place_Id = place.Place_Id
WHERE NOT Payment_AppointmentDate = '1111-11-11'");
$PendAResult = $db_handle->runEXP("Select appointment.user_email AS Email, project.Project_Name as Project, payment.Payment_AppointmentDate as Date, place.Place_Name as Place
FROM appointment
INNER JOIN project
ON appointment.user_id = project.User_Id
INNER JOIN payment
ON project.Project_Id = payment.Project_Id
INNER JOIN place
ON payment.Place_Id = place.Place_Id
WHERE NOT Payment_AppointmentDate = '1111-11-11' AND payment.Payment_AppointmentStatus = 0");
$PrioAResult = $db_handle->runEXP("Select appointment.user_email AS Email, project.Project_Name as Project, uploadplace.UploadPlace_Place as Place, uploadplace.UploadPlace_DateTime as Schedule
FROM appointment
INNER JOIN project
ON appointment.user_id = project.User_Id
INNER JOIN payment
ON project.Project_Id = payment.Project_Id
INNER JOIN uploadplace
ON payment.Place_Id = uploadplace.UploadPlace_Id
WHERE Payment_AppointmentDate = '1111-11-11'");

if (isset($_POST["Customer"])) {
    $filename = "CustomerList.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($CustomerResult)) {
        foreach ($CustomerResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
}
elseif (isset($_POST["AllPayments"])) {
    $filename = "All_PaymentsList.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($AllPResult)) {
        foreach ($AllPResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
}
elseif (isset($_POST["PendingPayments"])) {
    $filename = "Pending_PaymentsList.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($PendPResult)) {
        foreach ($PendPResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
}
elseif (isset($_POST["AllAppointments"])) {
    $filename = "All_AppointmentsList.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($AllAResult)) {
        foreach ($AllAResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
}
elseif (isset($_POST["PendingAppointments"])) {
    $filename = "Pending_AppointmentsList.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($PendAResult)) {
        foreach ($PendAResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
}
elseif (isset($_POST["PriorityAppointments"])) {
    $filename = "Priority_AppointmentsList.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($PrioAResult)) {
        foreach ($PrioAResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Administrator Account for Visioner Design and Builders</title>

    <!-- Bootstrap core CSS-->
    <link href="styles/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="styles/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="styles/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="styles/css/sb-admin.css" rel="stylesheet">
				<!-- JumEE Css -->
		    <link href="../JumEE/css/bootstrap-extended.css" rel="stylesheet">
		<script>

						function deleteShow(Id) {
							var modal = document.getElementById("ModalWrapper");
							modal.classList.remove("modal-success");
							modal.classList.add("modal-danger");

							var xmlhttp = new XMLHttpRequest();
							var url = "";
							var btn = "";
							xmlhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									document.getElementById("modalContent").innerHTML = this.responseText;
								}
							};
							url = "../Ajax/DisplayPlace.php";
							url += "?call=deleteShow";
							url += "&Id=" + Id;
							xmlhttp.open("GET", url, true);
							xmlhttp.send();

						}
						function deleteItem(Id) {
							var modal = document.getElementById("ModalWrapper");
							modal.classList.add("modal-success");
							modal.classList.remove("modal-danger");
							var table = $('#example').DataTable();

							table.rows('#tr'+Id).remove().draw();

							var xmlhttp = new XMLHttpRequest();
							var url = "";
							var btn = "";
							xmlhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									document.getElementById("modalContent").innerHTML = this.responseText;
								}
							};
							url = "../Ajax/DisplayPlace.php";
							url += "?call=deleteItem";
							url += "&Id=" + Id;
							xmlhttp.open("GET", url, true);
							xmlhttp.send();

						}
		</script>

  </head>

                    


  <body id="page-top">
    <?php include 'nav.php'; ?>
    <div id="wrapper">
      <?php include 'sidebar.php'; ?>
     
                    
  						<div class="col-10">
  						<div class="card shadow mb-8">
  								<div class="card-header py-3">
  									<h6 class="m-0 font-weight-bold text-info">Export</h6>
  								</div>
  							
  								<?php echo $msg; ?>
  								<div class="card-body">
  								    <div class="card-body">
  								       
    <div class="btn">
        <form action="" method="post">
            <button type="submit" name='Customer'
                value="Export to Excel" class="btn btn-info btn-lg">Customers List</button>
        </form>
    </div><hr><br>
	<div class="btn">
        <form action="" method="post">
            <button type="submit" name='AllPayments'
                value="Export to Excel" class="btn btn-info btn-lg">All Payments</button>
        </form>
    </div>
    <div class="btn">
        <form action="" method="post">
            <button type="submit" name='PendingPayments'
                value="Export to Excel" class="btn btn-info btn-lg">Pending Payments</button>
        </form>
    </div><hr><br>
    <div class="btn">
        <form action="" method="post">
            <button type="submit" name='AllAppointments'
                value="Export to Excel" class="btn btn-info btn-lg">All Appointments</button>
        </form>
    </div>
    <div class="btn">
        <form action="" method="post">
            <button type="submit" name='PendingAppointments'
                value="Export to Excel" class="btn btn-info btn-lg">Pending Appointments</button>
        </form>
    </div>
    
     <div class="btn">
        <form action="" method="post">
            <button type="submit" name='PriorityAppointments'
                value="Export to Excel" class="btn btn-info btn-lg">Priority Appointments</button>
        </form>
    </div>
    
    </div>
    </div>
    </div>
    </div>
    
  <?php include 'footer.php'; ?>
      </div>
    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <?php include 'logoutmodal.php';?>

    <!-- Bootstrap core JavaScript-->
    <script src="styles/vendor/jquery/jquery.min.js"></script>
    <script src="styles/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="styles/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="styles/js/sb-admin.min.js"></script>
		<script type="text/javascript" src="../JumEE/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="../JumEE/js/dataTables.bootstrap4.min.js"></script>

    <!-- JumEE Plugin -->

				    <script>
				    $(document).ready(function() {
				        $('#example').DataTable();
				    } );
				    </script>
				    
				    
				    
  </body>

</html>
<?php } ?>