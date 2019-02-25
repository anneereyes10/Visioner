<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Services.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

$msg = "";
$msg2 = "";
$err = "";
if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$mdlServices = $clsServices->GetById($_GET['Id']);
}else{
	header('Location: AddServices.php');
	die();
}

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
			$clsServices->Update($mdlServices);
			$msg .= '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h6>
					Successfully Updated Services.
				</h6>
				</div>
			     ';
			$imgResult = $clsServices->SetImage($_FILES["fileToUpload"],$mdlServices->getId());
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
							console.log(table);
							table.rows('#tr'+Id).remove().draw();

							var xmlhttp = new XMLHttpRequest();
							var url = "";
							var btn = "";
							xmlhttp.onreadystatechange = function() {
								if (this.readyState == 4 && this.status == 200) {
									document.getElementById("modalContent").innerHTML = this.responseText;
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
  							<div class="panel">
  								<div class="panel-heading">
  									<h3 class="panel-title">Services Details</h3>
  								</div>
  								<?php echo $msg; ?>
  								<div class="panel-body">
  									<div class="row">
  										<div class="form-group col-md-12">
  											<label class="form-control-label" for="inputName">Name</label>
  											<input type="text" class="form-control" id="inputName" name="Name" placeholder="Name" value="<?php echo $mdlServices->getName(); ?>" onblur="checkInput('inputName')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
  									<div class="row mb-2">
  										<div class="col-12">
  											<label class="form-control-label" for="inputDescription">Description</label>
  											<input type="text" class="form-control" id="inputDescription" name="Description" placeholder="Description" value="<?php echo $mdlServices->getDescription(); ?>" onblur="checkInput('inputDescription')">
  											<small id="notif-inputName" class="invalid-feedback">This is required</small>
  										</div>
  									</div>
										<div class="row mb-2">
  										<div class="col-12">
  											<label class="form-control-label" for="inputPrice">Price</label>
  											<input type="text" class="form-control" id="inputPrice" name="Price" placeholder="Price" value="<?php echo $mdlServices->getPrice(); ?>" onblur="checkInput('inputPrice')">
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
												<a href="AddServices.php" class="btn btn-secondary w-100">Back</a>
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
