<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Part.php");
require_once ("../App_Code/PartModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

$msg = "";
$err = "";

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$mdlPart = $clsPart->GetById($_GET['Id']);
}else{
	header('Location: ViewPart.php');
	die();
}

if(isset($_POST['Name'])){

	$err .= $clsFn->setForm('Name',$mdlPart,true);
	// $err .= $clsFn->setForm('Area',$mdlPart,true);
	// $err .= $clsFn->setForm('Piece',$mdlPart,true);
	$mdlPart->setArea("1");
	$mdlPart->setPiece("1");

	if($err == ""){
		$duplicate = $clsPart->IsExist($mdlPart);
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
			$clsPart->Update($mdlPart);
			$msg .= '
			<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
			<span class="sr-only">Close</span>
			</button>
			<h6>Successfully Updated Part. </h6>
			</div>';
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
  									<h3 class="panel-title">Part Details</h3>
  								</div>
  								<?php echo $msg; ?>
  								<div class="panel-body">
  									<div class="row">
  										<div class="form-group col-md-12">
  											<label class="form-control-label" for="inputName">Name</label>
  											<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlPart->getName(); ?>" onblur="checkInput('inputName')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<!-- <div class="row mb-2">
  										<div class="col-12">
  											<label class="form-control-label" for="inputArea">Area</label>
  											<input type="number" class="form-control" id="inputArea" name="Area" placeholder="Area" value="<?php echo $mdlPart->getArea(); ?>" onblur="checkInput('inputArea')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2">
  										<div class="col-12">
  											<label class="form-control-label" for="inputPiece">Pieces</label>
  											<input type="number" class="form-control" id="inputPiece" name="Piece" placeholder="Piece" value="<?php echo $mdlPart->getPiece(); ?>" onblur="checkInput('inputPiece')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div> -->
  									<div class="row">
  										<div class="col-sm-4 offset-sm-4">
  										</div>
  									</div>
	                  <div class="row">
	                    <div class="col-sm-3 offset-sm-3">
												<button type="submit" id="submit" class="btn btn-primary w-100">Submit</button>
	                    </div>
	                    <div class="col-sm-3">
												<a href="DisplayPart.php?Id=<?php echo $mdlPart->getId(); ?>" class="btn btn-secondary w-100">Back</a>
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
