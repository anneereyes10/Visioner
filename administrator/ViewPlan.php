<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Plan.php");
require_once ("../App_Code/Image.php");
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

		function deleteShow(PlanId) {
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
			url = "../Ajax/ViewPlan.php";
			url += "?call=deleteShow";
			url += "&Id=" + PlanId;
			xmlhttp.open("GET", url, true);
			xmlhttp.send();

		}
		function deletePlan(PlanId) {
			var modal = document.getElementById("ModalWrapper");
			modal.classList.add("modal-success");
			modal.classList.remove("modal-danger");
			var table = $('#example').DataTable();
			console.log(table);
			table.rows('#tr'+PlanId).remove().draw();

			var xmlhttp = new XMLHttpRequest();
			var url = "";
			var btn = "";
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("modalContent").innerHTML = this.responseText;
				}
			};
			url = "../Ajax/ViewPlan.php";
			url += "?call=deletePlan";
			url += "&Id=" + PlanId;
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
						     
							<div class="card shadow mb-8">
  								<div class="card-header py-3">
  									<h6 class="m-0 font-weight-bold text-info">Plan List</h6>
  								</div>
								 <div class="card-body">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead>
											<tr>
                        <th>Image</th>
												<th>Name</th>
												<th>Action</th>
											</tr>
										</thead>
										<tfoot>
											<tr>
                        <th>Image</th>
												<th>Name</th>
												<th>Action</th>
											</tr>
										</tfoot>
										<tbody>
											<?php
											$lstPlan = $clsPlan->Get();
											foreach($lstPlan as $mdlPlan)
											{
											?>
											<tr id="tr<?php echo $mdlPlan->getId(); ?>">
                        <td class="text-center">
                          <?php
                          $imgLocation = "";
                          $lstImage = $clsImage->GetByDetail("plan",$mdlPlan->getId(),"original");
                          foreach($lstImage as $mdlImage){
                            $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
                          }
                          if ($imgLocation != '') {
                            echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
                          }
                          ?>
                        </td>
												<td><?php echo $mdlPlan->getName(); ?></td>
												<td>

													<a href="DisplayPlan.php?Id=<?php echo $mdlPlan->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="View">
														<i class="fa fa-eye" aria-hidden="true"></i>
													</a>

													<a href="EditPlan.php?Id=<?php echo $mdlPlan->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Edit">
														<i class="fa fa-edit" aria-hidden="true"></i>
													</a>

													<span data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShow(<?php echo $mdlPlan->getId(); ?>);">
														<a href="JavaScript:void(0);" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Remove">
															<i class="fa fa-trash" aria-hidden="true"></i>
														</a>
													</span>
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
<?php } ?>