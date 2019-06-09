<?php

require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Category.php");
require_once ("../App_Code/Part.php");
require_once ("../App_Code/Image.php");
if(!isset($_SESSION['email'])){

	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
$msg = "";
$err = "";

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$mdlCategory = $clsCategory->GetById($_GET['Id']);
}else{
	header('Location: ViewCategory.php');
	die();
}


$msg2 = "";
$err2 = "";

if(isset($_POST['Name'])){

	$mdlPart->setCategory_Id($mdlCategory->getId());
	$err2 .= $clsFn->setForm('Name',$mdlPart,true);
	$err2 .= $clsFn->setForm('Area',$mdlPart,true);
	$err2 .= $clsFn->setForm('Piece',$mdlPart,true);

	if($err2 == ""){
		$duplicate = $clsPart->IsExist($mdlPart);
		if($duplicate['val']){
			$msg2 .= '
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Duplicate of Information Detected. </h4>
			'.$duplicate['msg'].'
			</div>';
		}else{
			$partsId = $clsPart->Add($mdlPart);
			$msg2 .= '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h6>
					Successfully Added New Part.
				</h6>
				</div>
			     ';
			// Clear all data if success
			$mdlPart = new PartModel();
		}
	}else{
		$msg2 .= '
		<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
		<span class="sr-only">Close</span>
		</button>
		<h4>Please Complete All Required Fields. </h4>
		'.$err2.'
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
				url = "../Ajax/DisplayCategory.php";
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
				url = "../Ajax/DisplayCategory.php";
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


					<div class="row">
						<div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Category Details</h6>
            </div>
                <?php echo $msg; ?>
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label class="form-control-label" for="inputName"><b>Rename Category Name:</b></label>
                      <p class="form-control" readonly><?php echo $mdlCategory->getName(); ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-1 offset-sm-5">
                      <a href="EditCategory.php?Id=<?php echo $mdlCategory->getId(); ?>" id="submit" class="btn btn-primary w-100">Edit</a>
                    </div>
                    <div class="col-sm-1">
											<a href="DisplayPlan.php?Id=<?php echo $mdlCategory->getPlan_Id(); ?>" class="btn btn-secondary w-100">Back</a>
                    </div>
                  </div>
                </div>
              </div>
						</div>
					</div>



					<div class="row mt-4">
						<div class="col-12">

			<div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Part</h6>
                </div>

                <?php echo $msg2; ?>

								<div class="card-body">
									<div class="row m-4">
										<div class="col-sm-12">
											<form action="?Id=<?php echo $_GET['Id']; ?>" method="post">
		  									<div class="row">
		  										<div class="form-group col-md-12">
		  											<label class="form-control-label" for="inputName"><b>Name: </b></label>
														<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlPart->getName(); ?>" onblur="checkInput('inputName')">
														<small id="notif-inputName" class="invalid-feedback">This is required</small>
													</div>
													<div class="form-group col-md-3">
														<label class="form-control-label" for="inputArea">Area: </label>
														<input type="number" class="form-control" id="inputArea" name="Area" placeholder="Area in SQM" value="<?php echo $mdlPart->getArea(); ?>" onblur="checkInput('inputArea')">
														<small id="notif-inputArea" class="invalid-feedback">This is required</small>
													</div>
		  										<div class="form-group col-md-3">
		  											<label class="form-control-label" for="inputPiece">Pieces: </label>
														<input type="number" class="form-control" id="inputPiece" name="Piece" placeholder="Number of Pieces" value="<?php echo $mdlPart->getPiece(); ?>" onblur="checkInput('inputPiece')">
														<small id="notif-inputPiece" class="invalid-feedback">This is required</small>
													</div>
												</div>
												<div class="row">
		  										<div class="col-sm-4">
		  											<button type="submit" id="submit" class="btn btn-primary w-full">Submit</button>
		  										</div>
		  									</div>
											</form>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-12">
											<table id="example" class="table table-striped table-bordered" style="width:100%">
		                    <thead>
		                      <tr>
		                        <th>Name</th>
		                        <th>Action</th>
		                      </tr>
		                    </thead>
		                    <tfoot>
		                      <tr>
		                        <th>Name</th>
		                        <th>Action</th>
		                      </tr>
		                    </tfoot>
		                    <tbody>
		                      <?php
		                      $lstPart = $clsPart->GetByCategory_Id($mdlCategory->getId());

		                      foreach($lstPart as $mdlPart)
		                      {

		                      ?>
		                      <tr id="tr<?php echo $mdlPart->getId(); ?>">
		                        <td><?php echo $mdlPart->getName(); ?></td>
		                        <td>
															<a href="DisplayPart.php?Id=<?php echo $mdlPart->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="View">
																<i class="fa fa-eye" aria-hidden="true"></i>
															</a>

															<a href="EditPart.php?Id=<?php echo $mdlPart->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Edit">
																<i class="fa fa-edit" aria-hidden="true"></i>
															</a>

															<span data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShow(<?php echo $mdlPart->getId(); ?>);">
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
