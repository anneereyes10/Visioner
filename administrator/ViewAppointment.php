<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Project.php");
require_once ("../App_Code/Upload.php");
require_once ("../App_Code/UploadPlace.php");
require_once ("../App_Code/Payment.php");
require_once ("../App_Code/Place.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
if(!isset($_SESSION['email'])){

	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
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

		function UpdateStatApproved(PaymentId) {

      var xmlhttp = new XMLHttpRequest();
      var url = "";
      var txt = document.getElementById("payment_message"+PaymentId).value;
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("modalContent").innerHTML = this.responseText;
          document.getElementById("status_"+PaymentId).innerHTML = "Approved";
        }
      };
      url = "../Ajax/ViewAppointment.php";
      url += "?call=Approved";
      url += "&Id=" + PaymentId;
      url += "&txt=" + txt;
      xmlhttp.open("GET", url, true);
      xmlhttp.send();
		}

    function UpdateStatDeclined(PaymentId) {

      var xmlhttp = new XMLHttpRequest();
      var url = "";
      var txt = document.getElementById("payment_message"+PaymentId).value;
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("modalContent").innerHTML = this.responseText;

          document.getElementById("status_"+PaymentId).innerHTML = "Declined";
        }
      };
      url = "../Ajax/ViewAppointment.php";
      url += "?call=Declined";
      url += "&Id=" + PaymentId;
      url += "&txt=" + txt;
      xmlhttp.open("GET", url, true);
      xmlhttp.send();
		}

    function displayDetail(id){

      var xmlhttp = new XMLHttpRequest();
      var url = "";
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("modalContent").innerHTML = this.responseText;
        }
      };
      url = "../Ajax/ViewPayment.php";
      url += "?call=displayDetail";
      url += "&Id=" + id;
      xmlhttp.open("GET", url, true);
      xmlhttp.send();
    }
    </script>
  </head>

  <body id="page-top">
    <?php include 'nav.php'; ?>
    <div id="wrapper">
      <?php include 'sidebar.php'; ?>
      <div id="content-wrapper">
        <div class="container-fluid">


					<div class="row">
						<div class="col-12">
						    <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">Appointments</h6>
                                </div>
						    
						
								<div class="card-body">
                  <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Project</th>
                        <th>Appointment Date</th>
                        <th>Place</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      $lstPayment = $clsPayment->GetByReceiptStatus(1);

                      foreach($lstPayment as $mdlPayment)
                      {

                        ?>
                        <tr>
                          <td><?php echo $clsUser->GetNameById($clsProject->GetUser_IdById($mdlPayment->getProject_Id())); ?></td>
                          <td>
                            <?php echo $clsProject->GetNameById($mdlPayment->getProject_Id()); ?>
                            <br />
                            <button class="btn btn-default" data-toggle="modal" data-target="#ModalWrapper" onclick="displayDetail(<?php echo $mdlPayment->getProject_Id(); ?>)"> View </button>
                          </td>
                          <?php
                          $mdlProject = $clsProject->GetById($mdlPayment->getProject_Id());
                          if ($mdlProject->getType() == "2"){
                            $mdlUploadPlace = $clsUploadPlace->GetById($mdlPayment->getPlace_Id());
                            ?>
                              <td><?php echo $mdlUploadPlace->getDateTime(); ?></td>
                              <td><?php echo $mdlUploadPlace->getPlace(); ?></td>
                            <?php

                          } else {?>
                            <td><?php echo $mdlPayment->getAppointmentDate(); ?></td>
                            <td><?php echo $clsPlace->GetNameById($mdlPayment->getPlace_Id());?></td>
                          <?php
                        }

                      ?>

                        <td id="status_<?php echo $mdlPayment->getId();?>">
                          <?php
                          if($mdlPayment->getAppointmentStatus() == 0){
                            echo "Pending";
                          } elseif($mdlPayment->getAppointmentStatus() == 1){
                            echo "Approved";
                          } else {
                            echo "Declined";
                          }
                          ?>
                        </td>
                        <td>
                            <?php
                            $type = $clsProject->GetTypeById($mdlPayment->getProject_Id());
                            if ($type != "2") {
                              ?>
                              <button type="submit" id="submit" class="btn btn-primary w-full" data-toggle="modal" data-target="#modal_approve<?php echo $mdlPayment->getId(); ?>">Confirm</button>
                              <button type="submit" id="submit" class="btn btn-primary w-full" data-toggle="modal" data-target="#modal_decline<?php echo $mdlPayment->getId(); ?>">Deny</button>
                              <br />
              							  (Optional) Send a message to the user for suggestions
              							  <br />
                              <textarea id="payment_message<?php echo $mdlPayment->getId();?>"><?php echo $mdlPayment->getMessage();?></textarea>


                      				<!-- Modal -->
                      				<div class="modal fade" id="modal_approve<?php echo $mdlPayment->getId(); ?>" aria-hidden="true" aria-labelledby="MW<?php echo $mdlPayment->getId(); ?>" role="dialog" tabindex="-1">
                      					<div class="modal-dialog modal-lg">
                      						<div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Approve Appointment</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                      							<div class="modal-body text-center" style="overflow: auto;">
                      								Are you sure you want to approve this Appointment?
                      							</div>
                      							<div class="modal-footer">
                      								<button type="button" class="btn btn-success" data-dismiss="modal" onclick="UpdateStatApproved(<?php echo $mdlPayment->getId(); ?>);">Confirm</button>
                      								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      							</div>
                      						</div>
                      					</div>
                      				</div>
                      				<!-- End Modal -->
                      				<!-- Modal -->
                      				<div class="modal fade" id="modal_decline<?php echo $mdlPayment->getId(); ?>" aria-hidden="true" aria-labelledby="MW<?php echo $mdlPayment->getId(); ?>" role="dialog" tabindex="-1">
                      					<div class="modal-dialog modal-lg">
                      						<div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Decline Appointment</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                      </button>
                                    </div>
                      							<div class="modal-body text-center" style="overflow: auto;">
                                      Are you sure you want to decline this Appointment?
                      							</div>
                      							<div class="modal-footer">
                                      <button type="button" class="btn btn-success" data-dismiss="modal" onclick="UpdateStatDeclined(<?php echo $mdlPayment->getId(); ?>);">Confirm</button>
                      								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      							</div>
                      						</div>
                      					</div>
                      				</div>
                      				<!-- End Modal -->
                              <?php
                            }
                            ?>
                        </td>
                      </tr>
                      <?php
                      } ?>
                    </tbody>
                  </table>
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

				<!-- Modal -->
				<div class="modal fade" id="ModalWrapper" aria-hidden="true" aria-labelledby="ModalWrapper" role="dialog" tabindex="-1">
					<div class="modal-dialog modal-lg">
						<div class="modal-content" id="modalContent">
							<div class="modal-header">
								<h4 class="modal-title">Modal Title</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<p>Loading..</p>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="button" class="btn btn-primary">Save changes</button>
							</div>
						</div>
					</div>
				</div>
				<!-- End Modal -->

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

    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>
  </body>

</html>
<?php } ?>