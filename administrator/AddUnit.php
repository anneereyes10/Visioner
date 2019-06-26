<?php

require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Unit.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
if(!isset($_SESSION['email'])){

	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
$msg = "";
$msg2 = "";
$err = "";

if(isset($_POST['Name'])){

	$err .= $clsFn->setForm('Name',$mdlUnit,true);

	if($err == ""){
		$duplicate = $clsUnit->IsExist($mdlUnit);
		if($duplicate['val']){
			$msg .= '
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Duplicate of Information Detected. </h4>
			'.$duplicate['msg'].'
			</div>';
		}else{
			$materialId = $clsUnit->Add($mdlUnit);
			$msg .= '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h6>
					Successfully Added New Unit.
				</h6>
				</div>
			     ';
			// Clear all data if success
			$mdlUnit = new UnitModel();
		}
	}else{
		$msg .= '
		<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
		<span class="sr-only">Close</span>
		</button>
		<h4>Please Complete All Required Fields. </h4>
		'.$err.'
		</div>';
	}
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
							url = "../Ajax/DisplayUnit.php";
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
							url = "../Ajax/DisplayUnit.php";
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
      <div id="content-wrapper">
        <div class="container-fluid">


          <form method="post" action="" enctype="multipart/form-data" autocomplete="off">
  					<div class="row">
  						<div class="col-12">

  							<div class="card shadow mb-4">
                                <div class="card-header py-3">
                                  <h6 class="m-0 font-weight-bold text-primary">Unit Details</h6>
                                </div>

  								<?php echo $msg; ?>
  								<div class="card-body">
  									<div class="row">
  										<div class="form-group col-md-12">
  											<label class="form-control-label" for="inputName"><b>Name:</b></label>
  											<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlUnit->getName(); ?>" onblur="checkInput('inputName')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row">
  										<div class="col-sm-4 offset-sm-5">
  											<button type="submit" id="submit" class="btn btn-primary w-full">Submit</button>
  										</div>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  				</form>


										<div class="row mt-4">
											<div class="col-12">

												<div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Unit</h6>
            </div>
					                <?php echo $msg2; ?>

													<div class="card-body">
														<div class="row">
															<div class="col-sm-12">
																<table id="example" class="table table-striped table-bordered" style="width:100%">
							                    <thead>
							                      <tr>
							                        <th>Name</th>
							                        <th>Action</th>
							                      </tr>
							                    </thead>

							                    <tbody>
							                      <?php
							                      $lstUnit = $clsUnit->Get();

							                      foreach($lstUnit as $mdlUnit)
							                      {

							                      ?>
							                      <tr id="tr<?php echo $mdlUnit->getId(); ?>">
							                        <td><?php echo $mdlUnit->getName(); ?></td>
							                        <td>


																				<a href="EditUnit.php?Id=<?php echo $mdlUnit->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Edit">
																					<i class="fa fa-edit" aria-hidden="true"></i>
																				</a>

																				<span data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShow(<?php echo $mdlUnit->getId(); ?>);">
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
										</div>


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
