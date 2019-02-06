<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Project.php");
require_once ("../App_Code/Payment.php");
require_once ("../App_Code/PaymentModel.php");
require_once ("../App_Code/User.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

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
      var btn = "";
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("modalContent").innerHTML = this.responseText;
          document.getElementById("status_"+PaymentId).innerHTML = "Approved";
        }
      };
      url = "../Ajax/ViewAppointment.php";
      url += "?call=Approved";
      url += "&Id=" + PaymentId;
      xmlhttp.open("GET", url, true);
      xmlhttp.send();
		}

    function UpdateStatDeclined(PaymentId) {

      var xmlhttp = new XMLHttpRequest();
      var url = "";
      var btn = "";
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("modalContent").innerHTML = this.responseText;

          document.getElementById("status_"+PaymentId).innerHTML = "Declined";
        }
      };
      url = "../Ajax/ViewAppointment.php";
      url += "?call=Declined";
      url += "&Id=" + PaymentId;
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
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Appointments</h3>
								</div>
								<div class="panel-body">
                  <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>User_Id</th>
                        <th>Project</th>
                        <th>Appointment Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Image</th>
                        <th>User_Id</th>
                        <th>Project</th>
                        <th>Appointment Date</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                      $lstPayment = $clsPayment->GetByReceiptStatus(1);

                      foreach($lstPayment as $mdlPayment)
                      {

                      ?>
                      <tr>
                        <td>
                          <?php
                          $imgLocation = "";
                          $lstImage = $clsImage->GetByDetail("payment",$mdlPayment->getId(),"original");
                          foreach($lstImage as $mdlImage){
                            $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
                          }
                          if ($imgLocation != '') {
                            echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
                          }
                          ?>
                        </td>
                        <td><?php echo $clsUser->GetNameById($clsProject->GetUser_IdById($mdlPayment->getProject_Id())); ?></td>
                        <td><?php echo $clsProject->GetNameById($mdlPayment->getProject_Id()); ?></td>
                        <td><?php echo $mdlPayment->getAppointmentDate(); ?></td>
                        <td id="status_<?php echo $mdlPayment->getId();?>">
                          <?php
                          if($mdlPayment->getAppointmentStatus() == 0){
                            echo "Pending";
                          } elseif($mdlPayment->getAppointmentStatus() == 1){
                            echo "Aprroved";
                          } else {
                            echo "Declined";
                          }
                          ?>
                        </td>
                        <td>
                            <button type="submit" id="submit" class="btn btn-primary w-full" onclick="UpdateStatApproved(<?php echo $mdlPayment->getId(); ?>);">Approved</button>
                            <button type="submit" id="submit" class="btn btn-primary w-full" onclick="UpdateStatDeclined(<?php echo $mdlPayment->getId(); ?>);">Declined</button>
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
								<p>One fine body…</p>
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
