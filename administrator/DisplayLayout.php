<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Layout.php");
require_once ("../App_Code/LayoutModel.php");
require_once ("../App_Code/Floor.php");
require_once ("../App_Code/FloorModel.php");
require_once ("../App_Code/LayoutFloor.php");
require_once ("../App_Code/LayoutFloorModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");
if(!isset($_SESSION['email'])){

	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
$msg = "";
$err = "";

if(isset($_GET['Id']) && $_GET['Id'] != ""){
	$mdlLayout = $clsLayout->GetById($_GET['Id']);
}else{
	header('Location: ViewLayout.php');
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

		function add(pid,cid) {

			var xmlhttp = new XMLHttpRequest();
			var url = "";
			var btn = "";
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("modalContent").innerHTML = this.responseText;
					location.reload();
				}
			};
			url = "../Ajax/DisplayLayout.php";
			url += "?call=add";
			url += "&pid=" + pid;
			url += "&cid=" + cid;
			xmlhttp.open("GET", url, true);
			xmlhttp.send();

		}

		function remove(id) {
			console.log(id);
			var xmlhttp = new XMLHttpRequest();
			var url = "";
			var btn = "";
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("modalContent").innerHTML = this.responseText;
					location.reload();
				}
			};
			url = "../Ajax/DisplayLayout.php";
			url += "?call=remove";
			url += "&Id=" + id;
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
                  <h3 class="panel-title">Layout Details</h3>
                </div>
                <?php echo $msg; ?>
                <div class="panel-body">
                  <div class="row mb-2">
                    <div class="form-group col-md-12 text-center">
											<?php
											$imgLocation = "";
											$lstImage = $clsImage->GetByDetail("layout",$mdlLayout->getId(),"original");
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
                      <p class="font-weight-bold"><?php echo $mdlLayout->getName(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputDescription">Description:</label>
                      <p class="font-weight-bold"><?php echo $mdlLayout->getDescription(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputSize">Size:</label>
                      <p class="font-weight-bold"><?php echo $mdlLayout->getSize(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputPrice">Price:</label>
                      <p class="font-weight-bold"><?php echo $mdlLayout->getPrice(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputBedroom">Bedroom:</label>
                      <p class="font-weight-bold"><?php echo $mdlLayout->getBedroom(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputBathroom">Bathroom:</label>
                      <p class="font-weight-bold"><?php echo $mdlLayout->getBathroom(); ?></p>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-12">
                      <label class="form-control-label" for="inputParking">Parking:</label>
                      <p class="font-weight-bold"><?php echo $mdlLayout->getParking(); ?></p>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-3 offset-sm-3">
                      <a href="EditLayout.php?Id=<?php echo $mdlLayout->getId(); ?>" id="submit" class="btn btn-primary w-100">Edit</a>
                    </div>
                    <div class="col-sm-3">
                      <a href="EditLayout.php?Id=<?php echo $mdlLayout->getId(); ?>" id="submit" class="btn btn-danger w-100" data-toggle="modal" data-target="#ModalWrapper" onclick="deleteShow(<?php echo $mdlLayout->getId(); ?>);">Delete</a>
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
									<span aria-hidden="true">??</span>
								</button>
							</div>
							<div class="modal-body">
								<p>One fine body???</p>
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
<?php } ?>