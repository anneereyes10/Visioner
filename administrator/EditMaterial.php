<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/MaterialModel.php");
require_once ("../App_Code/Unit.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
if(!isset($_SESSION['email'])){

	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
$msg = "";
$err = "";

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$mdlMaterial = $clsMaterial->GetById($_GET['Id']);
}else{
	header('Location: ViewMaterial.php');
	die();
}

if(isset($_POST['Name'])){

	$err .= $clsFn->setForm('Name',$mdlMaterial,true);
	$err .= $clsFn->setForm('Description',$mdlMaterial,true);
	$err .= $clsFn->setForm('Price',$mdlMaterial,true);
	$err .= $clsFn->setForm('PriceType',$mdlMaterial,true);
	$err .= $clsFn->setForm('Width',$mdlMaterial);
	$err .= $clsFn->setForm('Height',$mdlMaterial);
	$err .= $clsFn->setForm('Unit_Id',$mdlMaterial,true);
	if ($mdlMaterial->getWidth() == "") {
		$mdlMaterial->setWidth("1");
	}
	if ($mdlMaterial->getHeight() == "") {
		$mdlMaterial->setHeight("1");
	}

	if($err == ""){
		$duplicate = $clsMaterial->IsExist($mdlMaterial);
		if($duplicate['val']){
			$msg .= '
			<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h6>Duplicate of Information Detected. </h6>
			'.$duplicate['msg'].'
			</div>';
		}else{
			$clsMaterial->Update($mdlMaterial);
			$msg .= '
			<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h6>Successfully Updated Material. </h6>
			</div>';
			$imgResult = $clsMaterial->SetImage($_FILES["fileToUpload"],$mdlMaterial->getId());
			if($imgResult['msg'] != ""){
				$msg .= '
				<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h6>Image Upload Failed </h6>
				'.$imgResult['msg'].'
				</div>';
			}
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
                    <h6 class="m-0 font-weight-bold text-primary">Material Details</h6>
                  </div>
  								<?php echo $msg; ?>
  								<div class="card-body">
  									<div class="row">
  										<div class="form-group col-md-12">
  											<label class="form-control-label" for="inputName"><b>Name:</b></label>
  											<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlMaterial->getName(); ?>" onblur="checkInput('inputName')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2">
  										<div class="col-12">
  											<label class="form-control-label" for="inputDescription"><b>Description:</b></label>
  											<input type="text" class="form-control" id="inputDescription" name="Description" placeholder="Description" value="<?php echo $mdlMaterial->getDescription(); ?>" onblur="checkInput('inputDescription')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
										<div class="row mb-2">
  										<div class="col-12">
  											<label class="form-control-label" for="inputPrice"><b>Price:</b></label>
  											<input type="number" class="form-control" id="inputPrice" name="Price" placeholder="Price" value="<?php echo $mdlMaterial->getPrice(); ?>" onblur="checkInput('inputPrice')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
										<div class="row mb-2">
  										<div class="col-12">
  											<label class="form-control-label" for="inputPriceType">Price Type</label>
												<select class="form-control" id="inputPriceType" name="PriceType" onblur="checkInput('inputPriceType')">
													<option value="0" <?php echo ($mdlMaterial->getPriceType() == "0")?'selected':''; ?>>per Item Area</option>
													<option value="2" <?php echo ($mdlMaterial->getPriceType() == "2")?'selected':''; ?>>per Base Area</option>
													<option value="1" <?php echo ($mdlMaterial->getPriceType() == "1")?'selected':''; ?>>per Piece</option>
												</select>
												<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="card mb-3">
													<div class="card-header">Details needed if Price Type is per Item Area</div>
													<div class="card-body text-secondary">
														<div class="row">
															<div class="form-group col-md-4">
																<label class="form-control-label" for="inputWidth"><b>Width:</b> </label>
																<input type="text" class="form-control" id="inputWidth" name="Width" placeholder="Width" value="<?php echo $mdlMaterial->getWidth(); ?>" onblur="checkInput('inputWidth')">
																<small id="notif-inputWidth" class="invalid-feedback">This is required</small>
															</div>
															<div class="form-group col-md-4">
																<label class="form-control-label" for="inputHeight"><b>Height:</b> </label>
																<input type="text" class="form-control" id="inputHeight" name="Height" placeholder="Height" value="<?php echo $mdlMaterial->getHeight(); ?>" onblur="checkInput('inputHeight')">
																<small id="notif-inputHeight" class="invalid-feedback">This is required</small>
															</div>
															<div class="form-group col-md-4">
																<label class="form-control-label" for="inputUnit"><b>Unit:</b> </label>
																<select class="form-control" id="inputUnit" name="Unit_Id">
																	<?php
																	$lstUnit = $clsUnit->Get();
																	foreach ($lstUnit as $mdlUnit) {
																		if ($mdlMaterial->getUnit_Id() == $mdlUnit->getId()) {
																			echo '<option value="'.$mdlUnit->getId().'" selected>'.$mdlUnit->getName().'</option>';
																		} else {
																			echo '<option value="'.$mdlUnit->getId().'">'.$mdlUnit->getName().'</option>';
																		}
																	}
																	?>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
  									<div class="row mb-2">
  										<div class="form-group col-md-12">
												<center>
											    <div class="card" style="width: 18rem;">
	          								<div class="card-body">
															<label class="form-control-label" for="inputImage"><b>Picture: </b></label>
															<input type="file" class="form-control-file" id="inputImage" accept="image/*" name="fileToUpload"/>
	  												</div>
													</div>
												</center>
											</div>
  									</div>
	                  <div class="row">
	                    <div class="col-sm-1 offset-sm-5">
												<button type="submit" id="submit" class="btn btn-primary w-100">Submit</button>
	                    </div>
	                    <div class="col-sm-1">
												<a href="DisplayMaterial.php?Id=<?php echo $mdlMaterial->getId(); ?>" class="btn btn-secondary w-100">Back</a>
	                    </div>
	                  </div>
  								</div>
  							</div>
  						</div>
  					</div>
  				</form>






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

    <!-- JumEE Plugin -->

  </body>

</html>
<?php } ?>
