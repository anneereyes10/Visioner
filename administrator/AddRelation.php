<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Layout.php");
require_once ("../App_Code/LayoutModel.php");
require_once ("../App_Code/Floor.php");
require_once ("../App_Code/FloorModel.php");
require_once ("../App_Code/Room.php");
require_once ("../App_Code/RoomModel.php");
require_once ("../App_Code/Parts.php");
require_once ("../App_Code/PartsModel.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/MaterialModel.php");
require_once ("../App_Code/Upgrade.php");
require_once ("../App_Code/UpgradeModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");


$lstLayout = $clsLayout->Get();
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
    <script type="text/javascript" src="../JumEE/js/AddRelation.js"></script>

		<style>
		.row{
			margin: 0px;
		}
		.card-deck{
			margin: 0px;
		}
    .img-featured{
      width: 100%;
      height: 100px;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: 50% 50%;
    }
    .featured{
      text-decoration: none !important;
    }
		</style>
  </head>

  <body id="page-top">
    <?php include 'nav.php'; ?>
    <div id="wrapper">
      <?php include 'sidebar.php'; ?>
      <div id="content-wrapper">
    <div class="container-fluid">

					<div class="page">
						<div class="page-content">
							<div class="row m-0 p-0">
								<div class="col-md-12">
									<div class="panel item-wrapper">
										<div class="panel-heading">
											<h4 class="panel-title">Select Layout</h4>
										</div>
										<div class="panel-body mb-4">
											<div class="row">
												<div class="col-xs-12" style="width:100% !important;">
													<div class="card-deck">
														<div class="row" style="width:100% !important;" id="Layout">
															<?php
		                          foreach ($lstLayout as $mdlLayout) {
		                            $imgLocation = "";
		                            $lstImage = $clsImage->GetByDetail("layout",$mdlLayout->getId(),"original");
		                            foreach($lstImage as $mdlImage){
		                              $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
		                            }
		                            ?>
																<div class="col-md-2 col-sm-3 mb-10 p-0 mt-4">
																	<a href="javascript:void(0);" onclick="selLayout(<?php echo $mdlLayout->getId(); ?>);" class="card shadow featured bg-light" style="color:#666;" id="Layout_<?php echo $mdlLayout->getId(); ?>">
																		<div class="card-img-top img-featured" style="background-image: url('<?php echo $imgLocation; ?>')" alt="<?php echo $mdlLayout->getName(); ?>"></div>
																		<div class="card-body">
																			<h5 class="card-title">
																				<?php echo $mdlLayout->getName(); ?>
																			</h5>
																			<p class="card-text">
																				<?php echo $mdlLayout->getDescription(); ?>
																			</p>
																		</div>
																	</a>
																</div>
																<?php
	                            }
	                            ?>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="panel-heading">
											<h4 class="panel-title">Select Floor</h4>
										</div>
										<div class="panel-body mb-4">
											<div class="row">
												<div class="col-xs-12" style="width:100% !important;">
													<div class="card-deck">
														<div class="row" style="width:100% !important;" id="Floor">
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="panel-heading">
											<h4 class="panel-title">Select Room</h4>
										</div>
										<div class="panel-body mb-4">
											<div class="row">
												<div class="col-xs-12" style="width:100% !important;">
													<div class="card-deck">
														<div class="row" style="width:100% !important;" id="Room">
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="panel-heading">
											<h4 class="panel-title">Select Parts</h4>
										</div>
										<div class="panel-body mb-4">
											<div class="row">
												<div class="col-xs-12" style="width:100% !important;">
													<div class="card-deck">
														<div class="row" style="width:100% !important;" id="Parts">
														</div>
													</div>
												</div>
											</div>
										</div>

                    <div class="panel-heading">
											<h4 class="panel-title">Select Material</h4>
										</div>
										<div class="panel-body mb-4">
											<div class="row">
												<div class="col-xs-12" style="width:100% !important;">
													<div class="card-deck">
														<div class="row" style="width:100% !important;" id="Material">
														</div>
													</div>
												</div>
											</div>
										</div>

                    <div class="panel-heading">
											<h4 class="panel-title">Select Upgrade</h4>
										</div>
										<div class="panel-body mb-4">
											<div class="row">
												<div class="col-xs-12" style="width:100% !important;">
													<div class="card-deck">
														<div class="row" style="width:100% !important;" id="Upgrade">
														</div>
													</div>
												</div>
											</div>
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
