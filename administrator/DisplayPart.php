<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Part.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/Upgrade.php");
require_once ("../App_Code/Image.php");

$msg = "";
$err = "";

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$mdlPart = $clsPart->GetById($_GET['Id']);
}else{
	header('Location: ViewPart.php');
	die();
}


$msg2 = "";
$err2 = "";
$msg3 = "";
$err3 = "";

if(isset($_POST['Name'])){
	if (empty($_GET['add'])) {
		$mdlMaterial->setPart_Id($mdlPart->getId());
		$err2 .= $clsFn->setForm('Name',$mdlMaterial,true);
		$err2 .= $clsFn->setForm('Description',$mdlMaterial,true);
		$err2 .= $clsFn->setForm('Price',$mdlMaterial,true);
		$err2 .= $clsFn->setForm('PriceType',$mdlMaterial,true);

		if($err2 == ""){
			$duplicate = $clsMaterial->IsExist($mdlMaterial);
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
				$partsId = $clsMaterial->Add($mdlMaterial);
				$msg2 .= '
					<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Close</span>
					</button>
					<h6>Successfully Added New Material.</h6>
					</div>
				     ';

				$imgResult = $clsMaterial->SetImage($_FILES["fileToUpload"],$partsId);
				if($imgResult['msg'] != ""){
					$msg .= '
					<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Close</span>
					</button>
					<h4>Image Upload Failed </h4>
					'.$imgResult['msg'].'
					</div>';
				}
				// Clear all data if success
				$mdlMaterial = new MaterialModel();
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
	}else{
		$mdlUpgrade->setPart_Id($mdlPart->getId());
		$err3 .= $clsFn->setForm('Name',$mdlUpgrade,true);
		$err3 .= $clsFn->setForm('Description',$mdlUpgrade,true);
		$err3 .= $clsFn->setForm('Price',$mdlUpgrade,true);
		$err3 .= $clsFn->setForm('PriceType',$mdlUpgrade,true);

		if($err3 == ""){
			$duplicate = $clsUpgrade->IsExist($mdlUpgrade);
			if($duplicate['val']){
				$msg3 .= '
				<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h4>Duplicate of Information Detected. </h4>
				'.$duplicate['msg'].'
				</div>';
			}else{
				$partsId = $clsUpgrade->Add($mdlUpgrade);
				$msg3 .= '
					<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Close</span>
					</button>
					<h6>Successfully Added New Upgrade.</h6>
					</div>
				     ';

				$imgResult = $clsUpgrade->SetImage($_FILES["fileToUpload"],$partsId);
				if($imgResult['msg'] != ""){
					$msg .= '
					<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">×</span>
					<span class="sr-only">Close</span>
					</button>
					<h4>Image Upload Failed </h4>
					'.$imgResult['msg'].'
					</div>';
				}
				// Clear all data if success
				$mdlUpgrade = new UpgradeModel();
			}
		}else{
			$msg3 .= '
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Please Complete All Required Fields. </h4>
			'.$err3.'
			</div>';
		}

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
				url = "../Ajax/DisplayPart.php";
				url += "?call=deleteShow";
				url += "&Id=" + Id;
				xmlhttp.open("GET", url, true);
				xmlhttp.send();

			}
			function deleteItem(Id) {
				var modal = document.getElementById("ModalWrapper");
				modal.classList.add("modal-success");
				modal.classList.remove("modal-danger");
				var table = $('#table1').DataTable();

				table.rows('#tr'+Id).remove().draw();

				var xmlhttp = new XMLHttpRequest();
				var url = "";
				var btn = "";
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("modalContent").innerHTML = this.responseText;
					}
				};
				url = "../Ajax/DisplayPart.php";
				url += "?call=deleteItem";
				url += "&Id=" + Id;
				xmlhttp.open("GET", url, true);
				xmlhttp.send();

			}


				function deleteShow2(Id) {
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
					url = "../Ajax/DisplayPart.php";
					url += "?call=deleteShow2";
					url += "&Id=" + Id;
					xmlhttp.open("GET", url, true);
					xmlhttp.send();

				}
				function deleteItem2(Id) {
					var modal = document.getElementById("ModalWrapper");
					modal.classList.add("modal-success");
					modal.classList.remove("modal-danger");
					var table = $('#table2').DataTable();

					table.rows('#tr2'+Id).remove().draw();

					var xmlhttp = new XMLHttpRequest();
					var url = "";
					var btn = "";
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("modalContent").innerHTML = this.responseText;
						}
					};
					url = "../Ajax/DisplayPart.php";
					url += "?call=deleteItem2";
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
              <div class="panel">
                <div class="panel-heading">
                  <h3 class="panel-title">Part Details</h3>
                </div>
                <?php echo $msg; ?>
                <div class="panel-body">
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label class="form-control-label" for="inputName">Name:</label>
                      <p class="font-weight-bold"><?php echo $mdlPart->getName(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputArea">Area:</label>
                      <p class="font-weight-bold"><?php echo $mdlPart->getArea(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputPiece">Piece:</label>
                      <p class="font-weight-bold"><?php echo $mdlPart->getPiece(); ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 offset-sm-3">
											<a href="EditPart.php?Id=<?php echo $mdlPart->getId(); ?>" id="submit" class="btn btn-primary w-100">Edit</a>
                    </div>
                    <div class="col-sm-3">
											<a href="DisplayCategory.php?Id=<?php echo $mdlPart->getCategory_Id(); ?>" class="btn btn-secondary w-100">Back</a>
                    </div>
                  </div>
                </div>
              </div>
						</div>
					</div>


					<div class="row mt-4">
						<div class="col-12">
							<hr />
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Material</h3>
									<?php echo $msg2; ?>
								</div>

								<div class="panel-body">
									<div class="row m-4">
										<div class="col-sm-12">
											<form action="?Id=<?php echo $_GET['Id']; ?>" method="post" enctype="multipart/form-data" autocomplete="off">
		  									<div class="row">
		  										<div class="form-group col-md-6">
		  											<label class="form-control-label" for="inputName">Name: </label>
														<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlMaterial->getName(); ?>" onblur="checkInput('inputName')">
														<small id="notif-inputName" class="invalid-feedback">This is required</small>
		  										</div>
		  										<div class="form-group col-md-3">
		  											<label class="form-control-label" for="inputPrice">Price: </label>
														<input type="text" class="form-control" id="inputPrice" name="Price" placeholder="Price" value="<?php echo $mdlMaterial->getPrice(); ?>" onblur="checkInput('inputPrice')">
														<small id="notif-inputPrice" class="invalid-feedback">This is required</small>
		  										</div>
		  										<div class="form-group col-md-3">
		  											<label class="form-control-label" for="inputPriceType">Price Type: </label>
														<select class="form-control" id="inputPriceType" name="PriceType" onblur="checkInput('inputPriceType')">
															<option value="0" <?php echo ($mdlMaterial->getPriceType() == "0")?'selected':''; ?>>per Area</option>
															<option value="1" <?php echo ($mdlMaterial->getPriceType() == "1")?'selected':''; ?>>per Piece</option>
														</select>
														<small id="notif-inputPriceType" class="invalid-feedback">This is required</small>
		  										</div>
												</div>
		  									<div class="row">
		  										<div class="form-group col-md-12">
		  											<label class="form-control-label" for="inputDescription">Description: </label>
														<textarea type="text" class="form-control" id="inputDescription" name="Description" placeholder="Description"><?php echo $mdlMaterial->getDescription(); ?> </textarea>
														<small id="notif-inputDescription" class="invalid-feedback">This is required</small>
		  										</div>
												</div>
		  									<div class="row mb-2">
		  										<div class="form-group col-md-12">
		  											<label class="form-control-label" for="inputImage">Picture</label>
		  											<input type="file" class="form-control-file" id="inputImage" accept="image/*" name="fileToUpload"/>
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
											<table id="table1" class="table table-striped table-bordered" style="width:100%">
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
		                      $lstMaterial = $clsMaterial->GetByPart_Id($mdlPart->getId());

		                      foreach($lstMaterial as $mdlMaterial)
		                      {

		                      ?>
		                      <tr id="tr<?php echo $mdlMaterial->getId(); ?>">

		                        <td>
		                          <?php
		                          $imgLocation = "";
		                          $lstImage = $clsImage->GetByDetail("material",$mdlMaterial->getId(),"original");
		                          foreach($lstImage as $mdlImage){
		                            $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
		                          }
		                          if ($imgLocation != '') {
		                            echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
		                          }
		                          ?>
		                        </td>
		                        <td><?php echo $mdlMaterial->getName(); ?></td>
		                        <td>
															<a href="DisplayMaterial.php?Id=<?php echo $mdlMaterial->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="View">
																<i class="fa fa-eye" aria-hidden="true"></i>
															</a>

															<a href="EditMaterial.php?Id=<?php echo $mdlMaterial->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Edit">
																<i class="fa fa-edit" aria-hidden="true"></i>
															</a>

															<span data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShow(<?php echo $mdlMaterial->getId(); ?>);">
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



					<div class="row mt-4">
						<div class="col-12">
							<hr />
						</div>
					</div>

					<div class="row mt-4">
						<div class="col-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Upgrade</h3>
									<?php echo $msg3; ?>
								</div>

								<div class="panel-body">
									<div class="row m-4">
										<div class="col-sm-12">
											<form action="?Id=<?php echo $_GET['Id']; ?>&add=upgrade" method="post" enctype="multipart/form-data" autocomplete="off">
		  									<div class="row">
		  										<div class="form-group col-md-6">
		  											<label class="form-control-label" for="inputName">Name: </label>
														<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlUpgrade->getName(); ?>" onblur="checkInput('inputName')">
														<small id="notif-inputName" class="invalid-feedback">This is required</small>
		  										</div>
		  										<div class="form-group col-md-3">
		  											<label class="form-control-label" for="inputPrice">Price: </label>
														<input type="text" class="form-control" id="inputPrice" name="Price" placeholder="Price" value="<?php echo $mdlUpgrade->getPrice(); ?>" onblur="checkInput('inputPrice')">
														<small id="notif-inputPrice" class="invalid-feedback">This is required</small>
		  										</div>
		  										<div class="form-group col-md-3">
		  											<label class="form-control-label" for="inputPriceType">Price Type: </label>
														<select class="form-control" id="inputPriceType" name="PriceType" onblur="checkInput('inputPriceType')">
															<option value="0" <?php echo ($mdlUpgrade->getPriceType() == "0")?'selected':''; ?>>per Area</option>
															<option value="1" <?php echo ($mdlUpgrade->getPriceType() == "1")?'selected':''; ?>>per Piece</option>
														</select>
														<small id="notif-inputPriceType" class="invalid-feedback">This is required</small>
		  										</div>
												</div>
		  									<div class="row">
		  										<div class="form-group col-md-12">
		  											<label class="form-control-label" for="inputDescription">Description: </label>
														<textarea type="text" class="form-control" id="inputDescription" name="Description" placeholder="Description"><?php echo $mdlUpgrade->getDescription(); ?> </textarea>
														<small id="notif-inputDescription" class="invalid-feedback">This is required</small>
		  										</div>
												</div>
		  									<div class="row mb-2">
		  										<div class="form-group col-md-12">
		  											<label class="form-control-label" for="inputImage">Picture</label>
		  											<input type="file" class="form-control-file" id="inputImage" accept="image/*" name="fileToUpload"/>
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
											<table id="table2" class="table table-striped table-bordered" style="width:100%">
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
		                      $lstUpgrade = $clsUpgrade->GetByPart_Id($mdlPart->getId());

		                      foreach($lstUpgrade as $mdlUpgrade)
		                      {

		                      ?>
		                      <tr id="tr2<?php echo $mdlUpgrade->getId(); ?>">

		                        <td>
		                          <?php
		                          $imgLocation = "";
		                          $lstImage = $clsImage->GetByDetail("upgrade",$mdlUpgrade->getId(),"original");
		                          foreach($lstImage as $mdlImage){
		                            $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
		                          }
		                          if ($imgLocation != '') {
		                            echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
		                          }
		                          ?>
		                        </td>
		                        <td><?php echo $mdlUpgrade->getName(); ?></td>
		                        <td>
															<a href="DisplayUpgrade.php?Id=<?php echo $mdlUpgrade->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="View">
																<i class="fa fa-eye" aria-hidden="true"></i>
															</a>

															<a href="EditUpgrade.php?Id=<?php echo $mdlUpgrade->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Edit">
																<i class="fa fa-edit" aria-hidden="true"></i>
															</a>

															<span data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShow2(<?php echo $mdlUpgrade->getId(); ?>);">
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
        $('#table1').DataTable();
        $('#table2').DataTable();
    } );
    </script>

  </body>

</html>
