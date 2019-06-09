<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Finish.php");
require_once ("../App_Code/FinishItem.php");
require_once ("../App_Code/Plan.php");
require_once ("../App_Code/Category.php");
require_once ("../App_Code/Part.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/Upgrade.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

if(!isset($_SESSION['email'])){

	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
$lstFinish = $clsFinish->Get();
$lstPlan = $clsPlan->Get();
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
    <script type="text/javascript" src="../JumEE/js/AddFinish.js"></script>

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


<hr>

                                    <div class="panel-body m-4">
										<div class="panel-heading">
											<h6 class="panel-title">Select Finish</h6>
										</div>
										<div class="panel-body mb-4">
											<div class="row">
												<div class="col-xs-12" style="width:100% !important;">
													<div class="card-deck">
														<div class="row" style="width:100% !important;" id="Finish">
															<?php
		                          foreach ($lstFinish as $mdlFinish) {
		                            ?>
																<div class="col-md-2 col-sm-3 mb-10 p-0 mt-4">
																	<a href="javascript:void(0);" onclick="selFinish(<?php echo $mdlFinish->getId(); ?>);" class="card shadow featured bg-light" style="color:#666;" id="Finish_<?php echo $mdlFinish->getId(); ?>">
																		<div class="card-body">
																			<h5 class="card-title">
																				<?php echo $mdlFinish->getName(); ?>
																			</h5>
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
										</div>
										
										<hr>

										<!-- <div class="panel-heading">
											<h4 class="panel-title">Select Plan</h4>
										</div>
										<div class="panel-body mb-4">
											<div class="row">
												<div class="col-xs-12" style="width:100% !important;">
													<div class="card-deck">
														<div class="row" style="width:100% !important;" id="Plan">
															<?php
		                          foreach ($lstPlan as $mdlPlan) {
		                            $imgLocation = "";
		                            $lstImage = $clsImage->GetByDetail("layout",$mdlPlan->getId(),"original");
		                            foreach($lstImage as $mdlImage){
		                              $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
		                            }
		                            ?>
																<div class="col-md-2 col-sm-3 mb-10 p-0 mt-4">
																	<a href="javascript:void(0);" onclick="selPlan(<?php echo $mdlPlan->getId(); ?>);" class="card shadow featured bg-light" style="color:#666;" id="Plan_<?php echo $mdlPlan->getId(); ?>">
																		<div class="card-img-top img-featured" style="background-image: url('<?php echo $imgLocation; ?>')" alt="<?php echo $mdlPlan->getName(); ?>"></div>
																		<div class="card-body">
																			<h5 class="card-title">
																				<?php echo $mdlPlan->getName(); ?>
																			</h5>
																			<p class="card-text">
																				<?php echo $mdlPlan->getDescription(); ?>
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
											</div> -->
										</div>
<div class="panel-body m-4">
                    <div class="panel-heading">
											<h6 class="panel-title">Select Plan</h6>
										</div>
										<div class="panel-body mb-4">
											<div class="row">
												<div class="col-xs-12" style="width:100% !important;">
													<div class="card-deck">
														<div class="row" style="width:100% !important;" id="Plan">
														</div>
													</div>
												</div>
											</div>
										</div>
										</div>
										
										<hr>
<div class="panel-body m-4">
										<div class="panel-heading">
											<h6 class="panel-title">Select Category</h6>
										</div>
										<div class="panel-body mb-4">
											<div class="row">
												<div class="col-xs-12" style="width:100% !important;">
													<div class="card-deck">
														<div class="row" style="width:100% !important;" id="Category">
														</div>
													</div>
												</div>
											</div>
										</div>
										</div>

                                        <hr>
<div class="panel-body m-4">
										<div class="panel-heading">
											<h6 class="panel-title">Select Part</h6>
										</div>
										<div class="panel-body mb-4">
											<div class="row">
												<div class="col-xs-12" style="width:100% !important;">
													<div class="card-deck">
														<div class="row" style="width:100% !important;" id="Part">
														</div>
													</div>
												</div>
											</div>
										</div>
										</div>
										<hr>

                    <div class="panel-body m-4">
                      <div class="panel-heading">
  											<h6 class="panel-title">Select Material</h6>
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

  									</div>
  									
  									<hr>
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