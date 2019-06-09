<?php

require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Services.php");
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

	$err .= $clsFn->setForm('Name',$mdlServices,true);
	$err .= $clsFn->setForm('Description',$mdlServices,true);
	$err .= $clsFn->setForm('Price',$mdlServices,true);

	if($err == ""){
		$duplicate = $clsServices->IsExist($mdlServices);
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
			$materialId = $clsServices->Add($mdlServices);
			$msg .= '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h6>
					Successfully Added New Services.
				</h6>
				</div>
			     ';
			$imgResult = $clsServices->SetImage($_FILES["fileToUpload"],$materialId);
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
			$mdlServices = new ServicesModel();
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
									document.getElementById("modalContentDelete").innerHTML = this.responseText;
								}
							};
							url = "../Ajax/DisplayServices.php";
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
									document.getElementById("modalContentDelete").innerHTML = this.responseText;
								}
							};
							url = "../Ajax/DisplayServices.php";
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
                                     <h6 class="m-0 font-weight-bold text-primary">Services Details</h6>
                                 </div>
  								
  								<?php echo $msg; ?>
  								<div class="card-body">
  									<div class="row">
  										<div class="form-group col-md-6 offset-sm-3"> 
  											<label class="form-control-label" for="inputName"><b>Service Name:</b></label>
  											<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlServices->getName(); ?>" onblur="checkInput('inputName')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2">
  										<div class="col-6 offset-sm-3">
  											<label class="form-control-label" for="inputDescription"><b>Service Description:</b></label>
												<textarea name="Description" class="form-control" id="inputDescription"><?php echo $mdlServices->getDescription(); ?></textarea>
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
										<div class="row mb-2">
  										<div class="col-6 offset-sm-3">
  											<label class="form-control-label" for="inputPrice"><b>Service Price:</b></label>
  											<input type="number" class="form-control" id="inputPrice" name="Price" placeholder="Price" value="<?php echo $mdlServices->getPrice(); ?>" onblur="checkInput('inputPrice')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2">
  										<div class="form-group col-md-6 offset-sm-3">
  											<label class="form-control-label" for="inputImage"><b>Upload Image:</b> </label>
  											<input type="file" class="form-control-file" id="inputImage" accept="image/*" name="fileToUpload"/>
  										</div>
  									</div>
  									<hr>
  									<div class="row">
  										<div class="col-sm-4 offset-sm-6">
  											<button type="submit" id="submit" class="btn btn-primary w-full">Submit</button>
  										</div>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  				</form>


										 <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">List of Services</h6>
            </div>
            <div class="card-body">
					                <?php echo $msg2; ?>

												
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
							                      $lstServices = $clsServices->Get();

							                      foreach($lstServices as $mdlServices)
							                      {

							                      ?>
							                      <tr id="tr<?php echo $mdlServices->getId(); ?>">
							                        <td><?php echo $mdlServices->getName(); ?></td>
							                        <td>

																				<span data-toggle="modal" data-target="#ModalItem<?php echo $mdlServices->getId(); ?>">
																					<a href="JavaScript:void(0);" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="View">
																						<i class="fa fa-eye" aria-hidden="true"></i>
																					</a>
																				</span>

																				<a href="EditServices.php?Id=<?php echo $mdlServices->getId(); ?>" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Edit">
																					<i class="fa fa-edit" aria-hidden="true"></i>
																				</a>

																				<span data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShow(<?php echo $mdlServices->getId(); ?>);">
																					<a href="JavaScript:void(0);" class="btn btn-sm btn-icon btn-pure btn-default" data-toggle="tooltip" title="Remove">
																						<i class="fa fa-trash" aria-hidden="true"></i>
																					</a>
																				</span>


																				<!-- Modal -->
																				<div class="modal fade" id="ModalItem<?php echo $mdlServices->getId(); ?>" aria-hidden="true" aria-labelledby="ModalWrapper" role="dialog" tabindex="-1">
																					<div class="modal-dialog modal-lg">
																						<div class="modal-content" id="modalContent">
																							<div class="modal-header">
																								<h4 class="modal-title">Service</h4>
																								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																									<span aria-hidden="true">×</span>
																								</button>
																							</div>
																							<div class="modal-body">
																					      <div class="row">
																					        <div class="col-md-12 text-center">
																					            <?php
																											$imgLoc = '';
																					            $lstImage = $clsImage->GetByDetail("services",$mdlServices->getId(),"original");
																					            foreach($lstImage as $mdlImage){
																												$imgLoc = "../" . $clsImage->ToLocation($mdlImage);
																					            }
																					            ?>
																											<img src="<?php echo $imgLoc; ?>" style="max-height:200px;" />
																					        </div>
																					      </div>
														  									<div class="row">
														  										<div class="form-group col-md-3">
														  											Name:
																									</div>
														  										<div class="form-group col-md-9">
																										<?php echo $mdlServices->getName(); ?>
														  										</div>
														  									</div>
														  									<div class="row mb-2">
														  										<div class="form-group col-md-3">
														  											Description:
																									</div>
														  										<div class="form-group col-md-9">
																										<?php echo $mdlServices->getDescription(); ?>
														  										</div>
														  									</div>
														  									<div class="row mb-2">
														  										<div class="form-group col-md-3">
														  											Price:
																									</div>
														  										<div class="form-group col-md-9">
																										Php <?php echo $mdlServices->getPrice(); ?>
														  										</div>
														  									</div>
																							</div>
																							<div class="modal-footer">
																								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																							</div>
																						</div>
																					</div>
																				</div>
																				<!-- End Modal -->

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


														<!-- Modal -->
														<div class="modal fade" id="ModalWrapper" aria-hidden="true" aria-labelledby="ModalWrapper" role="dialog" tabindex="-1">
															<div class="modal-dialog modal-lg">
																<div class="modal-content" id="modalContentDelete">
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