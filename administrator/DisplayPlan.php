<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Plan.php");
require_once ("../App_Code/Category.php");
require_once ("../App_Code/Image.php");

$msg = "";
$err = "";

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$mdlPlan = $clsPlan->GetById($_GET['Id']);
}else{
	header('Location: ViewPlan.php');
	die();
}

$msgCategory = "";
$errCategory = "";

if(isset($_POST['Name'])){

	$mdlCategory->setPlan_Id($mdlPlan->getId());
	$errCategory .= $clsFn->setForm('Name',$mdlCategory,true);

	if($errCategory == ""){
		$duplicate = $clsCategory->IsExist($mdlCategory);
		if($duplicate['val']){
			$msgCategory .= '
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h4>Duplicate of Information Detected. </h4>
			'.$duplicate['msg'].'
			</div>';
		}else{
			$partsId = $clsCategory->Add($mdlCategory);
			$msgCategory .= '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h6>
					Successfully Added New Category.
				</h6>
				</div>
			     ';
			// Clear all data if success
			$mdlCategory = new CategoryModel();
		}
	}else{
		$msgCategory .= '
		<div class="alert alert-danger alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">×</span>
		<span class="sr-only">Close</span>
		</button>
		<h4>Please Complete All Required Fields. </h4>
		'.$errCategory.'
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
					url = "../Ajax/DisplayPlan.php";
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
					url = "../Ajax/DisplayPlan.php";
					url += "?call=deletePlan";
					url += "&Id=" + PlanId;
					xmlhttp.open("GET", url, true);
					xmlhttp.send();

				}


				function deleteShowCat(PlanId) {
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
					url = "../Ajax/DisplayPlan.php";
					url += "?call=deleteShowCat";
					url += "&Id=" + PlanId;
					xmlhttp.open("GET", url, true);
					xmlhttp.send();

				}
				function deleteCategory(PlanId) {
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
					url = "../Ajax/DisplayPlan.php";
					url += "?call=deleteCategory";
					url += "&Id=" + PlanId;
					xmlhttp.open("GET", url, true);
					xmlhttp.send();

				}
		</script>
		<style>
			td > * {
				vertical-align: middle;
			}
		</style>
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
                  <h3 class="panel-title">Plan Details</h3>
                </div>
                <?php echo $msg; ?>
                <div class="panel-body">
                  <div class="row mb-2">
                    <div class="form-group col-md-12 text-center">
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("layout",$mdlPlan->getId(),"original");
											foreach($lstImage as $mdlImage){
												$imgLocation = "../" . $clsImage->ToLocation($mdlImage);
											}
											?>
                      <img src="<?php echo $imgLocation; ?>" style="max-height:200px;">
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-md-12">
                      <label class="form-control-label" for="inputName">Name:</label>
                      <p class="font-weight-bold"><?php echo $mdlPlan->getName(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputDescription">Description:</label>
                      <p class="font-weight-bold"><?php echo $mdlPlan->getDescription(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-4">
                      <label class="form-control-label" for="inputSize">Size:</label>
                      <p class="font-weight-bold"><?php echo $mdlPlan->getSize(); ?></p>
                    </div>
                    <div class="col-4">
                      <label class="form-control-label" for="inputPrice">Price:</label>
                      <p class="font-weight-bold"><?php echo $mdlPlan->getPrice(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-4">
                      <label class="form-control-label" for="inputBedroom">Bedroom:</label>
                      <p class="font-weight-bold"><?php echo $mdlPlan->getBedroom(); ?></p>
                    </div>
                    <div class="col-4">
                      <label class="form-control-label" for="inputBathroom">Bathroom:</label>
                      <p class="font-weight-bold"><?php echo $mdlPlan->getBathroom(); ?></p>
                    </div>
                    <div class="col-4">
                      <label class="form-control-label" for="inputParking">Parking:</label>
                      <p class="font-weight-bold"><?php echo $mdlPlan->getParking(); ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 offset-sm-3">
                      <a href="EditPlan.php?Id=<?php echo $mdlPlan->getId(); ?>" id="submit" class="btn btn-primary w-100">Edit</a>
                    </div>
                    <div class="col-sm-3">
                      <a href="EditPlan.php?Id=<?php echo $mdlPlan->getId(); ?>" id="submit" class="btn btn-danger w-100" data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShow(<?php echo $mdlPlan->getId(); ?>);">Delete</a>
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
									<h3 class="panel-title">Categories</h3>
								</div>
                <?php echo $msgCategory; ?>

								<div class="panel-body">
									<div class="row m-4">
										<div class="col-sm-12">
											<form action="?Id=<?php echo $_GET['Id']; ?>" method="post">
		  									<div class="row">
		  										<div class="col-md-1">
		  											<label class="form-control-label" for="inputName">Name: </label>
		  										</div>
		  										<div class="col-sm-4">
														<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlCategory->getName(); ?>" onblur="checkInput('inputName')">
														<small id="notif-inputName" class="invalid-feedback">This is required</small>
		  										</div>
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
		                      $lstCategory = $clsCategory->GetByPlan_Id($mdlPlan->getId());

		                      foreach($lstCategory as $mdlCategory)
		                      {

		                      ?>
		                      <tr id="tr<?php echo $mdlCategory->getId(); ?>">
		                        <td><?php echo $mdlCategory->getName(); ?></td>
		                        <td>
															<a href="DisplayCategory.php?Id=<?php echo $mdlCategory->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="View">
																<i class="fa fa-eye" aria-hidden="true"></i>
															</a>

															<a href="EditCategory.php?Id=<?php echo $mdlCategory->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Edit">
																<i class="fa fa-edit" aria-hidden="true"></i>
															</a>

															<span data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShowCat(<?php echo $mdlCategory->getId(); ?>);">
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
