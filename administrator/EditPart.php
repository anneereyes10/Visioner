<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Part.php");
require_once ("../App_Code/PartModel.php");
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
	$mdlPart = $clsPart->GetById($_GET['Id']);
}else{
	header('Location: ViewPart.php');
	die();
}

if(isset($_POST['Name'])){

	$err .= $clsFn->setForm('Name',$mdlPart,true);
	$err .= $clsFn->setForm('Area',$mdlPart,true);
	$err .= $clsFn->setForm('Unit_Id',$mdlPart,true);
	$err .= $clsFn->setForm('Piece',$mdlPart,true);

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
						    <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Part Details</h6>
                  </div>
  								<?php echo $msg; ?>
  								<div class="card-body">
  									<div class="row">
  										<div class="form-group col-md-12">
  											<label class="form-control-label" for="inputName"><b>Rename Part Details Name: </b></label>
  											<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlPart->getName(); ?>">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2" id="div_area">
  										<div class="col-6">
  											<label class="form-control-label" for="inputArea">Area</label>
  											<input type="number" class="form-control" id="inputArea" name="Area" placeholder="Area" value="<?php echo $mdlPart->getArea(); ?>">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  										<div class="col-6" >
												<label class="form-control-label" for="inputArea">Unit of Area: </label>
												<select class="form-control" id="inputUnit" name="Unit_Id">
													<?php
													$lstUnit = $clsUnit->Get();
													foreach ($lstUnit as $mdlUnit) {
														if ($mdlPart->getUnit_Id() == $mdlUnit->getId()) {
															echo '<option value="'.$mdlUnit->getId().'" selected>'.$mdlUnit->getName().'</option>';
														} else {
															echo '<option value="'.$mdlUnit->getId().'">'.$mdlUnit->getName().'</option>';
														}
													}
													?>
												</select>
												<small id="notif-inputArea" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2" id="div_pieces">
  										<div class="col-12">
  											<label class="form-control-label" for="inputPiece">Pieces</label>
  											<input type="number" class="form-control" id="inputPiece" name="Piece" placeholder="Piece" value="<?php echo $mdlPart->getPiece(); ?>">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row">
  										<div class="col-sm-4 offset-sm-4">
  										</div>
  									</div>
	                  <div class="row">
	                    <div class="col-sm-2 offset-sm-4">
												<button type="submit" id="submit" class="btn btn-primary w-100">Submit</button>
	                    </div>
	                    <div class="col-sm-2">
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
		<script>
		$("#sel_Type").change(function () {
			$("#sel_Type option:selected").each(function() {
				if ($(this).val() == "1") {
					console.log("1");
					$("#div_area").removeClass("d-none");
					$("#div_pieces").addClass("d-none");

					$("#inputArea").val("");
					$("#inputUnit").val("1");
					$("#inputPiece").val("1");
				} else {
					console.log("2");
					$("#div_area").addClass("d-none");
					$("#div_pieces").removeClass("d-none");

					$("#inputArea").val("1");
					$("#inputUnit").val("1");
					$("#inputPiece").val("");
				}
			});
		}).change();
		</script>

  </body>

</html>
<?php } ?>
