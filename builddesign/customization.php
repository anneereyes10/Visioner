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

require_once ("../App_Code/Plan.php");
require_once ("../App_Code/Category.php");
require_once ("../App_Code/Part.php");
require_once ("../App_Code/Material.php");
require_once ("../App_Code/Upgrade.php");

require_once ("../App_Code/Payment.php");

$clsFn->IsLogged();

$_SESSION['projectId'] = (empty($_GET['project']) ?'':$_GET['project']);
$initialPlanId = $clsProject->GetPlan_IdById($_SESSION['projectId']);
$lstFinish = $clsFinish->Get();
$lstPlan = $clsPlan->Get();

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

<body onload="getItems();<?php echo (empty($initialPlanId))?'':'selPlan('.$initialPlanId.');'; ?>">

  <?php include "header.php"; ?>

    <div class="page-head">
      <div class="container">
        <div class="row">
          <div class="page-head-content">
            <h1 class="page-title">Online Design and Build</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- End page header -->
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
                                  <th></th>
                                </tr>
                              </thead>
                              <tfoot>
                                <tr>
                                  <th>Project Name</th>
                                  <th></th>
                                </tr>
                              </tfoot>
                              <tbody>
                                <?php
                                $lstProject = $clsProject->GetByUser_IdType($_SESSION['uid'],0);

                                foreach($lstProject as $mdlProject)
                                {
                                ?>
                                <tr>
                                  <td><?php echo $mdlProject->getName(); ?></td>
                                  <td>
                                    <?php
                                    $mdlPayment->setProject_Id($mdlProject->getId());
                                    $r_Payment = $clsPayment->IsExist($mdlPayment);
                                    if($r_Payment['val']){
                                      echo "Already Paid.";
                                    }else{
                                      ?>
                                      <a href="customization.php?project=<?php echo $mdlProject->getId(); ?>" class="btn btn-next btn-primary"> Select </a>
                                      <button class="btn btn-primary w-full" onclick="DeleteProject(<?php echo $mdlProject->getId(); ?>);"> Delete </button>
                                      <?php
                                    }
                                    ?>
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



                      <!-- Categorying Options -->
                      <div class="well well-lg col-md-12" id="Plan">
                        <strong>Plan Options</strong><br><br>



                        <?php
                        foreach ($lstPlan as $mdlPlan) {
                          $imgLocation = "";
                          $lstImage = $clsImage->GetByDetail("plan",$mdlPlan->getId(),"original");
                          foreach($lstImage as $mdlImage){
                            $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
                          }
                          ?>
                            <div class="thumbnail col-md-3">
                              <a href="#plan<?php echo $mdlPlan->getId(); ?>" data-toggle="modal">
                                <div class="img-featured" style="background-image: url('<?php echo $imgLocation; ?>');" alt="<?php echo $mdlPlan->getName(); ?>"></div>
                              </a>
                              <div class="dot-hr"></div>
                              <div class="caption">
                                <center>
                                  <label class="radio-jumee">
                                    <input
                                      type="radio"
                                      style="margin:0px;"
                                      name="plan"
                                      onchange="selPlan(<?php echo $mdlPlan->getId(); ?>);getItems();"
                                      <?php echo ($mdlPlan->getId() == $clsProject->GetPlan_IdById($_SESSION['projectId']))?'checked':''; ?>
                                    />
                                    <br>
                                    <strong>
                                      <?php echo $mdlPlan->getName(); ?>
                                    </strong>
                                  </label>
                                </center>
                              </div>

                            </div>


                            <div class="modal fade" id="plan<?php echo $mdlPlan->getId(); ?>" role="dialog">
                              <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title"><?php echo $mdlPlan->getName(); ?></h4>
                                  </div>
                                  <div class="modal-body text-center" style="max-height:60vh;overflow:auto;">
                                    <div class="row">
                                      <div class="col-md-8">
                                        <?php
                                        foreach($lstImage as $mdlImage){
                                          $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
                                          ?>
                                            <img src="<?php echo $imgLocation; ?>" alt="plan" style="margin-bottom:10px;">
                                          <?php
                                        }
                                        ?>
                                      </div>
                                      <div class="col-md-4">
                                        <?php echo $mdlPlan->getDescription(); ?>
                                      </div>
                                    </div>
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
                                      name="finish"
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
                            <?php
                          }
                          ?>

                      </div>


                      <div class="well well-lg col-md-12">
                        <strong>Category Options</strong><br><br>
                        <div id="Category">

                        </div>
                      </div>

                      <div class="well well-lg col-md-12">
                        <strong>Part Options</strong><br><br>
                        <div id="Part">

                        </div>
                      </div>


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
                                  <label><strong>Size</strong> (sqm)</label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Size_Min" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Size_Max" class="form-control radius" placeholder="Max" />
                                </div>
                              </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Price</strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Price_Min" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Price_Max" class="form-control radius" placeholder="Max" />
                                </div>
                              </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Bedroom</strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Bedroom_Min" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Bedroom_Max" class="form-control radius" placeholder="Max" />
                                </div>
                              </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Bathroom</strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Bathroom_Min" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Bathroom_Max" class="form-control radius" placeholder="Max" />
                                </div>
                              </div>
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Parking</strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Parking_Min" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Parking_Max" class="form-control radius" placeholder="Max" />
                                </div>
                              </div>
                              <div class="row" style="padding-top: 10px;">
                                <div class="col-md-12">
                                  <a id="filter" class="btn form-control radius" onclick="filterPlan();">Search</a>
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

                      <div id="basket" class="col-md-offset-4 col-md-4">
                        <div class="box mt-0 pb-0 no-horizontal-padding">
                          <form method="get" action="">
                            <div class="table-responsive">
                                  <?php
                                  $totalPrice = 0;
                                  $FinalProj = (empty($_GET['finalP']))?'0':$_GET['finalP'];
                                  $Plan_Id = $clsProject->GetPlan_IdById($FinalProj);
                                  $mdlPlan = $clsPlan->GetById($Plan_Id);
                                  ?>
                                  <ul>
                                    <li><?php echo $mdlPlan->getName(); ?></li>
                                  <?php
                                  $lstCategory = $clsCategory->GetByPlan_Id($Plan_Id);
                                  foreach ($lstCategory as $mdlCategory){
                                    ?>
                                    <ul>
                                      <li><?php echo $mdlCategory->getName(); ?></li>
                                    <?php
                                    $lstPart = $clsPart->GetByCategory_Id($mdlCategory->getId());
                                    foreach ($lstPart as $mdlPart) {
                                      if ($mdlPart->getArea() <= 0) {
                                        $mdlPart->setArea('1');
                                      }
                                      ?>
                                      <ul>
                                        <li><?php echo $mdlPart->getName(); ?></li>
                                      <?php
                                        $lstMaterial = $clsMaterial->GetByPart_Id($mdlPart->getId());
                                        foreach ($lstMaterial as $mdlMaterial) {

                                          $mdlUserProject->setProject_Id($FinalProj);
                                          $mdlUserProject->setMaterial_Id($mdlMaterial->getId());
                                          $mdlUserProject->setUpgrade_Id('0');
                                          if ($clsUserProject->IsExist($mdlUserProject)) {
                                						$PMprice = $mdlMaterial->getPrice() * $mdlPart->getArea();
                                						$totalPrice += $PMprice;
                                            ?>
                                            <ul>
                                              <li>
                                                <div class="col-sm-6" style="padding:0px;"><?php echo $mdlMaterial->getName(); ?></div>
                                                <div class="col-sm-6 text-right" style="padding:0px;">₱ <?php echo $PMprice; ?></div>
                                              </li>
                                            </ul>
                                            <?php
                                          }
                                        }

                                        $lstUpgrade = $clsUpgrade->GetByPart_Id($mdlPart->getId());
                                        foreach ($lstUpgrade as $mdlUpgrade) {

                                          $mdlUserProject->setProject_Id($FinalProj);
                                          $mdlUserProject->setMaterial_Id('0');
                                          $mdlUserProject->setUpgrade_Id($mdlUpgrade->getId());
                                          if ($clsUserProject->IsExist($mdlUserProject)) {
                                						$PMprice = $mdlUpgrade->getPrice() * $mdlPart->getArea();
                                						$totalPrice += $PMprice;
                                            ?>
                                            <ul>
                                              <li>
                                                <div class="col-sm-6" style="padding:0px;"><?php echo $mdlUpgrade->getName(); ?></div>
                                                <div class="col-sm-6 text-right" style="padding:0px;">₱ <?php echo $PMprice; ?></div>
                                              </li>
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
                                  <div class="row">
                                    <div class="col-sm-6">Total
                                    </div>
                                    <div class="col-sm-6 text-right" style="padding:0px;">
                                      ₱ <?php echo $totalPrice; ?>
                                    </div>
                                  </div>
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
