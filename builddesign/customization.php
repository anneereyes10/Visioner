<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Finish.php");
require_once ("../App_Code/FinishModel.php");
require_once ("../App_Code/Project.php");
require_once ("../App_Code/ProjectModel.php");
require_once ("../App_Code/UserProject.php");
require_once ("../App_Code/UserProjectModel.php");
require_once ("../App_Code/Image.php");
require_once ("../App_Code/ImageModel.php");

require_once ("../App_Code/Layout.php");
require_once ("../App_Code/LayoutModel.php");
require_once ("../App_Code/LayoutFloor.php");
require_once ("../App_Code/LayoutFloorModel.php");
require_once ("../App_Code/Floor.php");
require_once ("../App_Code/FloorModel.php");
require_once ("../App_Code/FloorRoom.php");
require_once ("../App_Code/FloorRoomModel.php");
require_once ("../App_Code/Room.php");
require_once ("../App_Code/RoomModel.php");
require_once ("../App_Code/RoomPart.php");
require_once ("../App_Code/RoomPartModel.php");
require_once ("../App_Code/Parts.php");
require_once ("../App_Code/PartsModel.php");
require_once ("../App_Code/PartMaterial.php");
require_once ("../App_Code/PartMaterialModel.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/MaterialModel.php");
require_once ("../App_Code/MaterialUpgrade.php");
require_once ("../App_Code/MaterialUpgradeModel.php");
require_once ("../App_Code/Upgrade.php");
require_once ("../App_Code/UpgradeModel.php");

$clsFn->IsLogged();

$_SESSION['projectId'] = (empty($_GET['project']) ?'':$_GET['project']);
$initialLayoutId = $clsProject->GetLayout_IdById($_SESSION['projectId']);
$lstFinish = $clsFinish->Get();
$lstLayout = $clsLayout->Get();

$msg = "";
$err = "";

?>
<!DOCTYPE html>
<html class="no-js">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Visioner Design and Builders | Dashboard page</title>
  <meta name="description" content="Visioner Design and Builders">
  <meta name="author" content="Visioner">
  <meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , ../bootstrap template">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
  <link rel="icon" href="../favicon.ico" type="image/x-icon">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/normalize.css">
  <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/fontello.css">
  <link href="../assets/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
  <link href="../assets/fonts/icon-7-stroke/css/helper.css" rel="stylesheet">
  <link href="../assets/css/animate.css" rel="stylesheet" media="screen">
  <link rel="stylesheet" href="../assets/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/icheck.min_all.css">
  <link rel="stylesheet" href="../assets/css/price-range.css">
  <link rel="stylesheet" href="../assets/css/owl.carousel.css">
  <link rel="stylesheet" href="../assets/css/owl.theme.css">
  <link rel="stylesheet" href="../assets/css/owl.transitions.css">
  <link rel="stylesheet" href="../assets/css/wizard.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/responsive.css">

  <!-- <link href="../assets/styles/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet"> -->
  <script type="text/javascript" src="../JumEE/js/Customization.js"></script>
  <style>
    .row {
      margin: 0px!important;
    }
    .img-featured{
      width: 100%;
      height: 15vw;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: 50% 50%;
      margin: 0px;
    }
    .dot-hr {
      margin-top: 5px;
    }
    ul ul {
      padding-left: 20px !important;
    }
    .tab-content ul li {
      margin-right: 0px !important;
    }
    .container {
      width:100%;
    }
    .radio-jumee {
      cursor: pointer;
    }
  </style>
</head>

<body onload="getItems();<?php echo (empty($initialLayoutId))?'':'selLayout('.$initialLayoutId.');'; ?>">

  <?php include "header.php"; ?>

  <!-- Customization Area -->
  <div class="content-area submit-property" style="background-color: #FCFCFC;">&nbsp;
    <div class="container">
      <div class="clearfix">
        <div class="wizard-container">

          <div class="wizard-card ct-wizard-orange" id="wizardProperty">
            <form name="myForm" action="" method="">
              <div class="wizard-header">
                <h3>
                  <b>Customize</b> YOUR DREAM HOUSE <br>
                  <small>Online Design and Build</small>
                </h3>
              </div>

              <ul>
                <li><a href="#step1" data-toggle="tab">Step 1 </a></li>
                <li <?php echo ((isset($_GET['project']))?'class="active"':''); ?>><a href="#step2" data-toggle="tab">Step 2 </a></li>
                <li <?php echo ((isset($_GET['finalP']))?'class="active"':''); ?>><a href="#step3" data-toggle="tab">Step 3 </a></li>
              </ul>

              <div class="tab-content">

                <div class="tab-pane" id="step1">
                  <div class="row p-b-15  ">
                    <h4 class="info-text"> Create Project</h4>
                    <div class="row" id="msg_Project">
                    </div>
                    <div class="row">
                      <div class="col-md-12">
          							<label class="form-control-label" for="inputProject">Project Name</label>
          							<input type="text" class="form-control" id="inputProject_Name" name="Project_Name" placeholder="Project Name">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-primary" onclick="addProject();" style="margin-top:10px;">Create</button>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="panel">
                          <div class="panel-heading">
                            <h3 class="panel-title">Transaction</h3>
                          </div>
                          <div class="panel-body">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                              <thead>
                                <tr>
                                  <th>Project Name</th>
                                  <th>Date Created</th>
                                  <th></th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Project Name</th>
                                  <th>Date Created</th>
                                  <th></th>
                                </tr>
                              </tfoot>
                              <tbody>
                                <?php
                                $lstProject = $clsProject->GetByUser_Id($_SESSION['uid']);

                                foreach($lstProject as $mdlProject)
                                {
                                  $Project_Date = date_format(date_create($mdlProject->getDateCreated()),"m/d/Y, g:i:s A");
                                ?>
                                <tr>
                                  <td><?php echo $mdlProject->getName(); ?></td>
                                  <td><?php echo $Project_Date; ?></td>
                                  <td>
                                    <a href="customization.php?project=<?php echo $mdlProject->getId(); ?>" class="btn btn-next btn-primary"> Select </a>
                                    <button class="btn btn-primary w-full" onclick="DeleteProject(<?php echo $mdlProject->getId(); ?>);"> Delete </button>
                                  </td>
                                </tr>
                                <?php
                                } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--  End step 1 -->

                <div class="tab-pane  <?php echo ((isset($_GET['project']))?'active':''); ?>" id="step2">
                  <h4 class="info-text"><strong>CUSTOMIZE</strong> YOUR SPECIFICATIONS </h4>
                  <p>Interior and exterior options
                    Select a room to customize with the specifications you want.
                    Some of the images are stylized and may not not look exactly like the end-product.</p>
                  <div class="row">
                    <div class="col-lg-8">



                      <!-- Flooring Options -->
                      <div class="well well-lg col-md-12" id="Layout">
                        <strong>Plan Options</strong><br><br>



                        <?php
                        foreach ($lstLayout as $mdlLayout) {
                          $imgLocation = "";
                          $lstImage = $clsImage->GetByDetail("layout",$mdlLayout->getId(),"original");
                          foreach($lstImage as $mdlImage){
                            $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
                          }
                          ?>
                            <div class="thumbnail col-md-3">
                              <a href="#plan<?php echo $mdlLayout->getId(); ?>" data-toggle="modal">
                                <div class="img-featured" style="background-image: url('<?php echo $imgLocation; ?>');" alt="<?php echo $mdlLayout->getName(); ?>"></div>
                              </a>
                              <div class="dot-hr"></div>
                              <!-- <div class="caption" click="alert('hello')"> -->
                              <div class="caption">
                                <center>
                                  <label class="radio-jumee">
                                    <input
                                      type="radio"
                                      style="margin:0px;"
                                      name="plan"
                                      onchange="selLayout(<?php echo $mdlLayout->getId(); ?>);getItems();"
                                      <?php echo ($mdlLayout->getId() == $clsProject->GetLayout_IdById($_SESSION['projectId']))?'checked':''; ?>
                                    />
                                    <br>
                                    <strong>
                                      <?php echo $mdlLayout->getName(); ?>
                                    </strong>
                                  </label>
                                </center>
                              </div>

                            </div>


                            <div class="modal fade" id="plan<?php echo $mdlLayout->getId(); ?>" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><?php echo $mdlLayout->getName(); ?></h4>
                                  </div>
                                  <div class="modal-body text-center">
                                    <img src="<?php echo $imgLocation; ?>" alt="plan" style="width:50%">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <?php
                          }
                          ?>

                      </div>
                      <!-- Finish Options -->
                      <div class="well well-lg col-md-12" id="Finishes">
                        <strong>Finishes Options</strong><br><br>

                        <?php
                        foreach ($lstFinish as $mdlFinish) {
                          ?>
                            <div class="thumbnail col-md-3">
                              <div class="caption">
                                <center>
                                  <label class="radio-jumee">
                                    <input
                                      type="radio"
                                      style="margin:0px;"
                                      name="plan"
                                      onchange="selFinish(<?php echo $mdlFinish->getId().",".$_SESSION['projectId']; ?>);"
                                    />
                                    <br>
                                    <strong>
                                      <?php echo $mdlFinish->getName(); ?>
                                    </strong>
                                  </label>
                                </center>
                              </div>
                            </div>


                            <div class="modal fade" id="plan<?php echo $mdlLayout->getId(); ?>" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><?php echo $mdlLayout->getName(); ?></h4>
                                  </div>
                                  <div class="modal-body text-center">
                                    <img src="<?php echo $imgLocation; ?>" alt="plan" style="width:50%">
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <?php
                          }
                          ?>

                      </div>


                      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                      <!-- Floor Options -->
                      <div class="well well-lg col-md-12">
                        <strong>Floor Options</strong><br><br>
                        <div id="Floor">

                        </div>
                      </div>
                      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                      <!-- Room Options -->
                      <div class="well well-lg col-md-12">
                        <strong>Room Options</strong><br><br>
                        <div id="Room">

                        </div>
                      </div>
                      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                      <!-- Parts Options -->
                      <div class="well well-lg col-md-12">
                        <strong>Parts Options</strong><br><br>
                        <div id="Parts">

                        </div>
                      </div>
                      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                      <!-- Material Options -->
                      <div class="well well-lg col-md-12">
                        <strong>Material Options</strong><br><br>
                        <div id="Material">

                        </div>
                      </div>
                      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->
                      <!-- Upgrade Options -->
                      <div class="well well-lg col-md-12">
                        <strong>Upgrade Options</strong><br><br>
                        <div id="Upgrade">

                        </div>
                      </div>
                      <!-- ////////////////////////////////////////////////////////////////////////////////////////////////////// -->

                      <div class="well well-lg col-md-12">
                        <div class="row">
                          <div class="col-md-3">
                            <a href="customization.php" class='btn btn-previous btn-primary' style="width:100%;">Previous</a>
                          </div>
                          <div class="col-md-3 col-md-offset-6">
                            <a href="?finalP=<?php echo (empty($_GET['project']))?'':$_GET['project']; ?>" class='btn btn-next btn-primary pull-right' style="width:100%;">Next</a>
                          </div>
                        </div>

                      </div>
                    </div>



                    <!-- Specification Summary -->
                    <div class="col-lg-4">
                      <div class="row">
                        <div id="order-summary" class="box mt-0 mb-4 p-0">
                          <div class="box-header mt-0">
                            <h3>Filter Plans</h3>
                          </div>
                          <p class="text-muted">Set your home specifications.</p>
                          <div class="table-responsive" id="layoutfilter">

                          <div class="row">
                            <div class="col-md-12">
                              <div class="row">
                                <div class="col-md-12">
                                  <label><strong>Size</strong></label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Layout_Size_Min" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Layout_Size_Max" class="form-control radius" placeholder="Max" />
                                </div>
                              </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Price</strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Layout_Price_Min" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Layout_Price_Max" class="form-control radius" placeholder="Max" />
                                </div>
                              </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Bedroom</strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Layout_Bedroom_Min" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Layout_Bedroom_Max" class="form-control radius" placeholder="Max" />
                                </div>
                              </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Bathroom</strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Layout_Bathroom_Min" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Layout_Bathroom_Max" class="form-control radius" placeholder="Max" />
                                </div>
                              </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Parking</strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Layout_Parking_Min" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Layout_Parking_Max" class="form-control radius" placeholder="Max" />
                                </div>
                              </div>
                              <div class="row" style="padding-top: 10px;">
                                <div class="col-md-12">
                                  <a id="filter" class="btn form-control radius" onclick="filterLayout();">Search</a>
                                </div>
                              </div>
                            </div>
                          </div>

                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div id="order-summary" class="box mt-0 mb-4 p-0">
                          <div class="box-header mt-0">
                            <h3>Specification Summary</h3>
                          </div>
                          <p class="text-muted">Your new home specifications.</p>
                          <div class="table-responsive" id="projectlist">
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
                <!--  End step 1 -->





                <!-- Start Step 3 -->



                <!-- Start Step 4 (Finished Tab) -->
                <div class="tab-pane <?php echo ((empty($_GET['finalP']))?'':'active'); ?>" id="step3">
                  <h4 class="info-text"> Build your dream home </h4>
                  <div class="row">
                    <div class="col-sm-12">

<!--
                      <div id="basket" class="col-lg-12">
                        <div class="box mt-0 pb-0 no-horizontal-padding">
                          <form method="get" action="">
                            <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th>Layout</th>
                                    <th>Floor</th>
                                    <th>Room</th>
                                    <th>Parts</th>
                                    <th>Material</th>
                                    <th>Upgrade</th>
                                    <th>Unit price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $totalPrice = 0;
                                  $FinalProj = (empty($_GET['finalP']))?'0':$_GET['finalP'];
                                  $Layout_Id = $clsProject->GetLayout_IdById($FinalProj);
                                  $mdlLayout = $clsLayout->GetById($Layout_Id);
                                  ?>
                                  <tr>
                                    <td><?php echo $mdlLayout->getName(); ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                  </tr>
                                  <?php
                                  $lstLayoutFloor = $clsLayoutFloor->GetByLayout_Id($Layout_Id);
                                  foreach ($lstLayoutFloor as $mdlLayoutFloor){
                                    $mdlFloor = $clsFloor->GetById($mdlLayoutFloor->getFloor_Id());
                                    ?>
                                    <tr>
                                      <td></td>
                                      <td><?php echo $mdlFloor->getName(); ?></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                    </tr>
                                    <?php
                                    $lstFloorRoom = $clsFloorRoom->GetByLayoutFloor_Id($mdlLayoutFloor->getId());
                                		foreach ($lstFloorRoom as $mdlFloorRoom) {
                                      $mdlRoom = $clsRoom->GetById($mdlFloorRoom->getRoom_Id());
                                      ?>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td><?php echo $mdlRoom->getName(); ?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                      </tr>
                                      <?php
                                			$lstRoomPart = $clsRoomPart->GetByFloorRoom_Id($mdlFloorRoom->getId());
                                			foreach ($lstRoomPart as $mdlRoomPart) {
                                				$mdlPart = $clsParts->GetById($mdlRoomPart->getParts_Id());
                                        ?>
                                        <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td><?php echo $mdlPart->getName(); ?></td>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                        </tr>
                                        <?php
                                        $lstPartMaterial = $clsPartMaterial->GetByRoomPart_Id($mdlRoomPart->getId());
                                				foreach ($lstPartMaterial as $mdlPartMaterial) {

                                					$mdlUserProject->setProject_Id($FinalProj);
                                					$mdlUserProject->setPartMaterial_Id($mdlPartMaterial->getId());
                                					$mdlUserProject->setMaterialUpgrade_Id('0');
                                					if ($clsUserProject->IsExist($mdlUserProject)) {
                                						$mdlMaterial = $clsMaterial->GetById($mdlPartMaterial->getMaterial_Id());
                                						$totalPrice += $mdlMaterial->getPrice();
                                            ?>
                                            <tr>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td></td>
                                              <td><?php echo $mdlMaterial->getName(); ?></td>
                                              <td></td>
                                              <td>₱ <?php echo $mdlMaterial->getPrice(); ?></td>
                                            </tr>
                                            <?php
                                            $lstMaterialUpgrade = $clsMaterialUpgrade->GetByPartMaterial_Id($mdlPartMaterial->getId());
                                						foreach ($lstMaterialUpgrade as $mdlMaterialUpgrade) {

                                							$mdlUserProject->setProject_Id($FinalProj);
                                							$mdlUserProject->setPartMaterial_Id($mdlPartMaterial->getId());
                                							$mdlUserProject->setMaterialUpgrade_Id($mdlMaterialUpgrade->getId());
                                							if ($clsUserProject->IsExist($mdlUserProject)) {
                                								$mdlUpgrade = $clsUpgrade->GetById($mdlMaterialUpgrade->getUpgrade_Id());
                                								$totalPrice += $mdlUpgrade->getPrice();
                                                ?>
                                                <tr>
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td></td>
                                                  <td><?php echo $mdlUpgrade->getName(); ?></td>
                                                  <td>₱ <?php echo $mdlUpgrade->getPrice(); ?></td>
                                                </tr>
                                                <?php
                                              }
                                            }
                                          }
                                        }
                                      }
                                    }
                                  }
                                  ?>
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th colspan="6">Total</th>
                                    <th>₱ <?php echo $totalPrice; ?></th>
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                            <div class="box-footer d-flex justify-content-between align-items-center">
                            </div>
                          </form>
                        </div>
                      </div>
-->
                      <div id="basket" class="col-md-offset-4 col-md-4">
                        <div class="box mt-0 pb-0 no-horizontal-padding">
                          <form method="get" action="">
                            <div class="table-responsive">
                                  <?php
                                  $totalPrice = 0;
                                  $FinalProj = (empty($_GET['finalP']))?'0':$_GET['finalP'];
                                  $Layout_Id = $clsProject->GetLayout_IdById($FinalProj);
                                  $mdlLayout = $clsLayout->GetById($Layout_Id);
                                  ?>
                                  <ul>
                                    <li><?php echo $mdlLayout->getName(); ?></li>
                                  <?php
                                  $lstLayoutFloor = $clsLayoutFloor->GetByLayout_Id($Layout_Id);
                                  foreach ($lstLayoutFloor as $mdlLayoutFloor){
                                    $mdlFloor = $clsFloor->GetById($mdlLayoutFloor->getFloor_Id());
                                    ?>
                                    <ul>
                                      <li><?php echo $mdlFloor->getName(); ?></li>
                                    <?php
                                    $lstFloorRoom = $clsFloorRoom->GetByLayoutFloor_Id($mdlLayoutFloor->getId());
                                    foreach ($lstFloorRoom as $mdlFloorRoom) {
                                      $mdlRoom = $clsRoom->GetById($mdlFloorRoom->getRoom_Id());
                                      ?>
                                      <ul>
                                        <li><?php echo $mdlRoom->getName(); ?></li>
                                      <?php
                                      $lstRoomPart = $clsRoomPart->GetByFloorRoom_Id($mdlFloorRoom->getId());
                                      foreach ($lstRoomPart as $mdlRoomPart) {
                                        $mdlPart = $clsParts->GetById($mdlRoomPart->getParts_Id());
                                        ?>
                                        <ul>
                                          <li><?php echo $mdlPart->getName(); ?></li>
                                        <?php
                                        $lstPartMaterial = $clsPartMaterial->GetByRoomPart_Id($mdlRoomPart->getId());
                                        foreach ($lstPartMaterial as $mdlPartMaterial) {

                                          $mdlUserProject->setProject_Id($FinalProj);
                                          $mdlUserProject->setPartMaterial_Id($mdlPartMaterial->getId());
                                          $mdlUserProject->setMaterialUpgrade_Id('0');
                                          if ($clsUserProject->IsExist($mdlUserProject)) {
                                            $mdlMaterial = $clsMaterial->GetById($mdlPartMaterial->getMaterial_Id());
                                            $totalPrice += $mdlMaterial->getPrice();
                                            ?>
                                            <ul>
                                              <li>
                                                <div class="col-sm-6" style="padding:0px;"><?php echo $mdlMaterial->getName(); ?></div>
                                                <div class="col-sm-6 text-right" style="padding:0px;">₱ <?php echo $mdlMaterial->getPrice(); ?></div>
                                              </li>
                                            <?php
                                            $lstMaterialUpgrade = $clsMaterialUpgrade->GetByPartMaterial_Id($mdlPartMaterial->getId());
                                            foreach ($lstMaterialUpgrade as $mdlMaterialUpgrade) {

                                              $mdlUserProject->setProject_Id($FinalProj);
                                              $mdlUserProject->setPartMaterial_Id($mdlPartMaterial->getId());
                                              $mdlUserProject->setMaterialUpgrade_Id($mdlMaterialUpgrade->getId());
                                              if ($clsUserProject->IsExist($mdlUserProject)) {
                                                $mdlUpgrade = $clsUpgrade->GetById($mdlMaterialUpgrade->getUpgrade_Id());
                                                $totalPrice += $mdlUpgrade->getPrice();
                                                ?>
                                                <ul>
                                                  <li>
                                                    <div class="col-sm-6" style="padding:0px;"><?php echo $mdlUpgrade->getName(); ?></div>
                                                    <div class="col-sm-6 text-right" style="padding:0px;">₱ <?php echo $mdlUpgrade->getPrice(); ?></div>
                                                  </li>
                                                </ul>
                                                <?php
                                              }
                                            }
                                            ?>
                                          </ul>
                                          <?php
                                          }
                                        }
                                        ?>
                                      </ul>
                                      <?php
                                      }
                                      ?>
                                    </ul>
                                    <?php
                                    }
                                    ?>
                                  </ul>
                                  <?php
                                  }
                                  ?>
                                </ul>
                                <tfoot>
                                  <ul>
                                    <th colspan="6">Total</th>
                                    <th>₱ <?php echo $totalPrice; ?></th>
                                  </ul>
                                </tfoot>
                            </div>
                            <div class="box-footer d-flex justify-content-between align-items-center">
                            </div>
                          </form>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <p>
                          <label><strong>Terms and Conditions</strong></label>
                          By accessing or using <strong>Visioner Design and Builders services</strong>, such as
                          posting your personal information on our website you agree to the
                          collection, use and disclosure of your personal information
                          in the legal proper manner.
                        </p>

                        <div class="col-sm-offset-4">
                          <div class="checkbox">
                            <label>
                              <strong>You Accept the terms and conditions when you proceed to Checkout.</strong>
                            </label>
                          </div>
                        </div>

                      </div>





                    </div>
                  </div>
                </div>
                <!--  End step 4 -->

              </div>

              <div class="wizard-footer">
                <div class="pull-right">
                  <a href="../user/payment.php" class='btn btn-finish btn-primary'>Proceed to Checkout</a>
                </div>

                <div class="pull-left">
                  <a href="?project=<?php echo $_GET['finalP']; ?>" class='btn btn-finish btn-primary'>Previous</a>
                </div>
                <div class="clearfix"></div>
              </div>
            </form>
          </div>
          <!-- End submit form -->
        </div>
      </div>
    </div>
  </div>

  <!-- Footer area-->
  <div class="footer-area">

    <div class=" footer">
      <div class="container">
        <div class="row">

          <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="single-footer">
              <h4>About us </h4>
              <div class="footer-title-line"></div>

              <img src="../assets/img/footer-logo.png" alt="" class="wow pulse" data-wow-delay="1s">
              <p>Visioner Design and Builders is a design & build firm based in Metro Manila, Philippines.</p>
              <ul class="footer-adress">
                <li><i class="pe-7s-map-marker strong"> </i> 30-B Bascom St. North Fairview, Quezon City, Philippines.</li>
                <li><i class="pe-7s-mail strong"> </i> visioneridesign@gmail.com</li>
                <li><i class="pe-7s-call strong"> </i> (02) 423 4351 </li>
              </ul>
            </div>
          </div>
          <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="single-footer">
              <h4>Quick links </h4>
              <div class="footer-title-line"></div>
              <ul class="footer-menu">
                <li><a href="../index.php?about">About</a> </li>
                <li><a href="../index.php?services">Service</a> </li>
                <li><a href="../index.php?login">Login</a></li>
                <li><a href="../index.php?contact">Contact</a></li>

              </ul>
            </div>
          </div>

          <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="single-footer">
              <h4>Gallery</h4>
              <div class="footer-title-line"></div>
              <ul class="footer-blog">
                <li>
                  <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                    <a href="../index.php?gallery">
                      <img src="../assets/img/visioners/2.jpg">
                    </a>
                    <span class="blg-date">View</span>

                  </div>

                  <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                    <h6> <a href="../index.php/?gallery">Project I</a></h6>
                    <p style="line-height: 17px; padding: 8px 2px;">View Gallery</p>
                  </div>
                </li>

                <li>
                  <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                    <a href="../index.php/?gallery">
                      <img src="../assets/img/visioners/3.jpg">
                    </a>
                    <span class="blg-date">View</span>

                  </div>
                  <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                    <h6> <a href="../index.php/?gallery">Project II </a></h6>
                    <p style="line-height: 17px; padding: 8px 2px;">View Gallery</p>
                  </div>
                </li>

                <li>
                  <div class="col-md-3 col-sm-4 col-xs-4 blg-thumb p0">
                    <a href="../index.php/?gallery">
                      <img src="../assets/img/visioners/4.jpg">
                    </a>
                    <span class="blg-date">View</span>

                  </div>
                  <div class="col-md-8  col-sm-8 col-xs-8  blg-entry">
                    <h6> <a href="../index.php/?gallery">Project III</a></h6>
                    <p style="line-height: 17px; padding: 8px 2px;">View Gallery</p>
                  </div>
                </li>


              </ul>
            </div>
          </div>


          <div class="col-md-3 col-sm-6 wow fadeInRight animated">
            <div class="single-footer news-letter">
              <h4>Stay in touch</h4>
              <div class="footer-title-line"></div>
              <p> </p>

              <form>
                <div class="input-group">
                  <input class="form-control" type="email" placeholder="E-mail ... ">
                  <span class="input-group-btn">
                    <button class="btn btn-primary subscribe" type="submit"><i class="pe-7s-paper-plane pe-2x"></i></button>
                  </span>
                </div>
                <!-- /input-group -->
              </form>

              <div class="social pull-right">
                <ul>

                  <li><a class="wow fadeInUp animated" href="https://www.facebook.com/Visioner-Design-and-Builders-432801973461175/" data-wow-delay="0.2s"><i class="fa fa-facebook"></i></a></li>
                  <li><a class="wow fadeInUp animated" href="https://www.facebook.com/Visioner-Design-and-Builders-432801973461175/" data-wow-delay="0.4s"><i class="fa fa-instagram"></i></a></li>

                </ul>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="footer-copy text-center">
      <div class="container">
        <div class="row">
          <div class="pull-left">
            <span> (C) <a href="https://www.facebook.com/Visioner-Design-and-Builders-432801973461175/">Visioner Design and Builders</a> , All rights reserved 2018 </span>
          </div>
          <div class="bottom-menu pull-right">
            <ul>
              <li><a class="wow fadeInUp animated" href="../index.php?home" data-wow-delay="0.2s">Home</a></li>
              <li><a class="wow fadeInUp animated" href="../index.php?gallery" data-wow-delay="0.3s">Gallery</a></li>
              <li><a class="wow fadeInUp animated" href="../index.php?privacypolicy" data-wow-delay="0.4s">Privacy Policy</a></li>
              <li><a class="wow fadeInUp animated" href="../index.php?contact" data-wow-delay="0.6s">Contact</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>

  </div>

  <!-- <script src="../assets/js/vendor/modernizr-2.6.2.min.js"></script> -->
  <script src="../assets/js//jquery-1.10.2.min.js"></script>
  <script src="../bootstrap/js/bootstrap.min.js"></script>
  <script src="../assets/js/bootstrap-select.min.js"></script>
  <script src="../assets/js/bootstrap-hover-dropdown.js"></script>
  <script src="../assets/js/easypiechart.min.js"></script>
  <script src="../assets/js/jquery.easypiechart.min.js"></script>
  <script src="../assets/js/owl.carousel.min.js"></script>
  <script src="../assets/js/wow.js"></script>
  <!-- <script src="../assets/js/icheck.min.js"></script> -->

  <script src="../assets/js/price-range.js"></script>
  <script src="../assets/js/jquery.bootstrap.wizard.js" type="text/javascript"></script>
  <script src="../assets/js/jquery.validate.min.js"></script>
  <script src="../assets/js/wizard.js"></script>

  <script src="../assets/js/main.js"></script>


  <script type="text/javascript" src="../JumEE/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="../JumEE/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
  <script>
    $(function() {
      $('#datepicker').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true,
        showOtherMonths: true,
        selectOtherMonths: true,
        autoclose: true,
        changeMonth: true,
        changeYear: true,
        orientation: "button"
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#example').DataTable();

    });
  </script>

</body>

</html>
