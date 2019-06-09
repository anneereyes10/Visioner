<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Upgrade.php");
require_once ("../App_Code/Image.php");
if(!isset($_SESSION['email'])){

	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
$msg = "";
$err = "";

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$mdlUpgrade = $clsUpgrade->GetById($_GET['Id']);
}else{
	header('Location: ViewUpgrade.php');
	die();
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

				function deleteShow(UpgradeId) {
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
					url = "../Ajax/ViewUpgrade.php";
					url += "?call=deleteShow";
					url += "&Id=" + UpgradeId;
					xmlhttp.open("GET", url, true);
					xmlhttp.send();

				}
				function deleteUpgrade(UpgradeId) {
					var modal = document.getElementById("ModalWrapper");
					modal.classList.add("modal-success");
					modal.classList.remove("modal-danger");

					var xmlhttp = new XMLHttpRequest();
					var url = "";
					var btn = "";
					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
							document.getElementById("modalContent").innerHTML = this.responseText;
						}
					};
					url = "../Ajax/ViewUpgrade.php";
					url += "?call=deleteDisplay";
					url += "&Id=" + UpgradeId;
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
                  <h3 class="panel-title">Upgrade Details</h3>
                </div>
                <?php echo $msg; ?>
                <div class="panel-body">
                  <div class="row mb-2">
                    <div class="form-group col-md-12 text-center">
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("upgrade",$mdlUpgrade->getId(),"original");
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
                      <p class="font-weight-bold"><?php echo $mdlUpgrade->getName(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputDescription">Description:</label>
                      <p class="font-weight-bold"><?php echo $mdlUpgrade->getDescription(); ?></p>
                    </div>
                  </div>
									<div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputPrice">Price:</label>
                      <p class="font-weight-bold"><?php echo $mdlUpgrade->getPrice(); ?></p>
                    </div>
                  </div>
									<!-- <div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputPriceType">PriceType:</label>
                      <p class="font-weight-bold"><?php echo ($mdlUpgrade->getPriceType() == "0")?'per Area':'per Piece'; ?></p>
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="col-sm-4 offset-sm-4">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 offset-sm-3">
											<a href="EditUpgrade.php?Id=<?php echo $mdlUpgrade->getId(); ?>" id="submit" class="btn btn-primary w-100">Edit</a>
                    </div>
                    <div class="col-sm-3">
											<a href="DisplayPart.php?Id=<?php echo $mdlUpgrade->getPart_Id(); ?>" class="btn btn-secondary w-100">Back</a>
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


  </body>

</html>
<?php } ?>