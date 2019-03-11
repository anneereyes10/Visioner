<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Upgrade.php");
require_once ("../App_Code/UpgradeModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

$msg = "";
$err = "";

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$mdlUpgrade = $clsUpgrade->GetById($_GET['Id']);
}else{
	header('Location: ViewUpgrade.php');
	die();
}

if(isset($_POST['Name'])){

	$err .= $clsFn->setForm('Name',$mdlUpgrade,true);
	$err .= $clsFn->setForm('Description',$mdlUpgrade,true);
	$err .= $clsFn->setForm('Price',$mdlUpgrade,true);
	$err .= $clsFn->setForm('PriceType',$mdlUpgrade,true);

	if($err == ""){
		$duplicate = $clsUpgrade->IsExist($mdlUpgrade);
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
			$clsUpgrade->Update($mdlUpgrade);
			$msg .= '
			<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h6>Successfully Updated Upgrade. </h6>
			</div>';
			$imgResult = $clsUpgrade->SetImage($_FILES["fileToUpload"],$mdlUpgrade->getId());
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
  							<div class="panel">
  								<div class="panel-heading">
  									<h3 class="panel-title">Upgrade Details</h3>
  								</div>
  								<?php echo $msg; ?>
  								<div class="panel-body">
  									<div class="row">
  										<div class="form-group col-md-12">
  											<label class="form-control-label" for="inputName">Name</label>
  											<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlUpgrade->getName(); ?>" onblur="checkInput('inputName')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2">
  										<div class="col-12">
  											<label class="form-control-label" for="inputDescription">Description</label>
  											<input type="text" class="form-control" id="inputDescription" name="Description" placeholder="Description" value="<?php echo $mdlUpgrade->getDescription(); ?>" onblur="checkInput('inputDescription')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
										<div class="row mb-2">
  										<div class="col-12">
  											<label class="form-control-label" for="inputPrice">Price</label>
  											<input type="text" class="form-control" id="inputPrice" name="Price" placeholder="Price" value="<?php echo $mdlUpgrade->getPrice(); ?>" onblur="checkInput('inputPrice')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
										<div class="row mb-2">
  										<div class="col-12">
  											<label class="form-control-label" for="inputPriceType">Price Type</label>
												<select class="form-control" id="inputPriceType" name="PriceType" onblur="checkInput('inputPriceType')">
													<option value="0" <?php echo ($mdlUpgrade->getPriceType() == "0")?'selected':''; ?>>per Area</option>
													<option value="1" <?php echo ($mdlUpgrade->getPriceType() == "1")?'selected':''; ?>>per Piece</option>
												</select>
												<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2">
  										<div class="form-group col-md-12">
  											<label class="form-control-label" for="inputImage">Picture</label>
  											<input type="file" class="form-control-file" id="inputImage" accept="image/*" name="fileToUpload"/>
  										</div>
  									</div>
	                  <div class="row">
	                    <div class="col-sm-3 offset-sm-3">
												<button type="submit" id="submit" class="btn btn-primary w-100">Submit</button>
	                    </div>
	                    <div class="col-sm-3">
												<a href="DisplayUpgrade.php?Id=<?php echo $mdlUpgrade->getId(); ?>" class="btn btn-secondary w-100">Back</a>
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
