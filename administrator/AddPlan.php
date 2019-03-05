<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Plan.php");
require_once ("../App_Code/Image.php");

$msg = "";
$err = "";

if(isset($_POST['Name'])){

	$err .= $clsFn->setForm('Name',$mdlPlan,true);
	$err .= $clsFn->setForm('Description',$mdlPlan,true);
	$err .= $clsFn->setForm('Size',$mdlPlan,true);
	$err .= $clsFn->setForm('Price',$mdlPlan,true);
	$err .= $clsFn->setForm('Bedroom',$mdlPlan,true);
	$err .= $clsFn->setForm('Bathroom',$mdlPlan,true);
	$err .= $clsFn->setForm('Parking',$mdlPlan,true);

	if($err == ""){
		$duplicate = $clsPlan->IsExist($mdlPlan);
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
			$layoutId = $clsPlan->Add($mdlPlan);
			$msg .= '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h6>
					Successfully Added New Plan.
				</h6>
				</div>
			     ';
			$imgResult = $clsPlan->SetImage($_FILES["fileToUpload"],$layoutId);
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
			$mdlPlan = new PlanModel();
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
  									<h3 class="panel-title">Plan Details</h3>
  								</div>
  								<?php echo $msg; ?>
  								<div class="panel-body">
  									<div class="row">
  										<div class="form-group col-md-12">
  											<label class="form-control-label" for="inputName">Name</label>
  											<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlPlan->getName(); ?>" onblur="checkInput('inputName')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2">
  										<div class="col-12">
  											<label class="form-control-label" for="inputDescription">Description</label>
												<textarea class="form-control" id="inputDescription" name="Description"><?php echo $mdlPlan->getDescription(); ?></textarea>
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2">
  										<div class="col-6">
  											<label class="form-control-label" for="inputSize">Size (in sqm)</label>
  											<input type="number" class="form-control" id="inputSize" name="Size" placeholder="Size" value="<?php echo $mdlPlan->getSize(); ?>" onblur="checkInput('inputSize')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  										<div class="col-6">
  											<label class="form-control-label" for="inputPrice">Price</label>
  											<input type="number" class="form-control" id="inputPrice" name="Price" placeholder="Price" value="<?php echo $mdlPlan->getPrice(); ?>" onblur="checkInput('inputPrice')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2">
  										<div class="col-4">
  											<label class="form-control-label" for="inputBedroom">Bedroom</label>
  											<input type="number" class="form-control" id="inputBedroom" name="Bedroom" placeholder="Bedroom" value="<?php echo $mdlPlan->getBedroom(); ?>" onblur="checkInput('inputBedroom')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  										<div class="col-4">
  											<label class="form-control-label" for="inputBathroom">Bathroom</label>
  											<input type="number" class="form-control" id="inputBathroom" name="Bathroom" placeholder="Bathroom" value="<?php echo $mdlPlan->getBathroom(); ?>" onblur="checkInput('inputBathroom')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  										<div class="col-4">
  											<label class="form-control-label" for="inputParking">Parking</label>
  											<input type="number" class="form-control" id="inputParking" name="Parking" placeholder="Parking" value="<?php echo $mdlPlan->getParking(); ?>" onblur="checkInput('inputParking')">
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
  										<div class="col-sm-4 offset-sm-4">
  											<button type="submit" id="submit" class="btn btn-primary w-full">Submit</button>
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
