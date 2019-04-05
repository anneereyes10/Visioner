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
    /* .row {
      margin: 0px!important;
    } */
    .img-featured{
      width: 100%;
      height: 15vw;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: 50% 50%;
      margin: 0px;
    }
    /* .dot-hr {
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
    } */
  </style>


  <style>


      [data-tooltip] {
  position: relative;
  z-index: 10;
}

/* Positioning and visibility settings of the tooltip */
[data-tooltip]:before,
[data-tooltip]:after {
  position: absolute;
  visibility: hidden;
  opacity: 0;
  left: 50%;
  bottom: calc(100% + 5px);
  pointer-events: none;
  transition: 0.2s;
  will-change: transform;
}

/* The actual tooltip with a dynamic width */
[data-tooltip]:before {
  content: attr(data-tooltip);
  padding: 10px 18px;
  min-width: 50px;
  max-width: 300px;
  width: max-content;
  width: -moz-max-content;
  border-radius: 6px;
  font-size: 14px;
  background-color: rgba(59, 72, 80, 0.9);
  background-image: linear-gradient(30deg,
    rgba(59, 72, 80, 0.44),
    rgba(59, 68, 75, 0.44),
    rgba(60, 82, 88, 0.44));
  box-shadow: 0px 0px 24px rgba(0, 0, 0, 0.2);
  color: #fff;
  text-align: center;
  white-space: pre-wrap;
  transform: translate(-50%, -5px) scale(0.5);
}

/* Tooltip arrow */
[data-tooltip]:after {
  content: " ";
  border-style: solid;
  border-width: 5px 5px 0px 5px;
  border-color: rgba(55, 64, 70, 0.9) transparent transparent transparent;
  transition-duration: 0s; /* If the mouse leaves the element,
                              the transition effects for the
                              tooltip arrow are "turned off" */
  transform-origin: top;   /* Orientation setting for the
                              slide-down effect */
  transform: translateX(-50%) scaleY(0);
}

/* Tooltip becomes visible at hover */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  visibility: visible;
  opacity: 1;
}
/* Scales from 0.5 to 1 -> grow effect */
[data-tooltip]:hover:before {
  transition-delay: 0.3s;
  transform: translate(-50%, -5px) scale(1);
}
/* Slide down effect only on mouseenter (NOT on mouseleave) */
[data-tooltip]:hover:after {
  transition-delay: 0.5s; /* Starting after the grow effect */
  transition-duration: 0.2s;
  transform: translateX(-50%) scaleY(1);
}
/*
  That's it.
*/







/*
  If you want some adjustability
  here are some orientation settings you can use:
*/

/* LEFT */
/* Tooltip + arrow */
[data-tooltip-location="left"]:before,
[data-tooltip-location="left"]:after {
  left: auto;
  right: calc(100% + 5px);
  bottom: 50%;
}

/* Tooltip */
[data-tooltip-location="left"]:before {
  transform: translate(-5px, 50%) scale(0.5);
}
[data-tooltip-location="left"]:hover:before {
  transform: translate(-5px, 50%) scale(1);
}

/* Arrow */
[data-tooltip-location="left"]:after {
  border-width: 5px 0px 5px 5px;
  border-color: transparent transparent transparent rgba(55, 64, 70, 0.9);
  transform-origin: left;
  transform: translateY(50%) scaleX(0);
}
[data-tooltip-location="left"]:hover:after {
  transform: translateY(50%) scaleX(1);
}



/* RIGHT */
[data-tooltip-location="right"]:before,
[data-tooltip-location="right"]:after {
  left: calc(100% + 5px);
  bottom: 50%;
}

[data-tooltip-location="right"]:before {
  transform: translate(5px, 50%) scale(0.5);
}
[data-tooltip-location="right"]:hover:before {
  transform: translate(5px, 50%) scale(1);
}

[data-tooltip-location="right"]:after {
  border-width: 5px 5px 5px 0px;
  border-color: transparent rgba(55, 64, 70, 0.9) transparent transparent;
  transform-origin: right;
  transform: translateY(50%) scaleX(0);
}
[data-tooltip-location="right"]:hover:after {
  transform: translateY(50%) scaleX(1);
}



/* BOTTOM */
[data-tooltip-location="bottom"]:before,
[data-tooltip-location="bottom"]:after {
  top: calc(100% + 5px);
  bottom: auto;
}

[data-tooltip-location="bottom"]:before {
  transform: translate(-50%, 5px) scale(0.5);
}
[data-tooltip-location="bottom"]:hover:before {
  transform: translate(-50%, 5px) scale(1);
}

[data-tooltip-location="bottom"]:after {
  border-width: 0px 5px 5px 5px;
  border-color: transparent transparent rgba(55, 64, 70, 0.9) transparent;
  transform-origin: bottom;
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

                    <div class="row" id="msg_Project">
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-sm-offset-3">
          							<label class="form-control-label" for="inputProject"><strong>Project Name<a data-tooltip="Title of the project you'll be making"
       data-tooltip-location="right"> (?)</a>
	   </strong></label>
          							<input type="text" class="form-control" id="inputProject_Name" name="Project_Name" placeholder="Project Name">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12 text-center">
                        <button type="button" class="btn btn-primary" onclick="addProject();" style="margin-top:10px;">Create</button>
                      </div>
                    </div>

                    <hr>
                    <div class="row">
                      <div class="col-md-8 col-md-offset-2">
                        <div class="panel">

                          <div class="panel-heading">
                            <h3 class="panel-title"><strong>My Projects<a data-tooltip="View and manage your projects here! Use the search bar on the right to search for your project."
       data-tooltip-location="right"> (?)</a></strong></h3>
                          </div>

                          <div class="panel-body">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                              <thead>
                                <tr>
                                  <th>Project Name</th>
                                  <th></th>
                                </tr>
                              </thead>
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
                                      echo "Project transaction processed.";
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
                  <h4 class="info-text"><strong>BUILD</strong> YOUR SPECIFICATIONS </h4>
                  <p>
					Choose from one of our house plans and define its finish! You can quickly accomplish this by selecting a finish option or customize it by selecting materials available per category.
                        <br>
                    <b> NOTE: Pricing of the materials are estimates and are not final, these prices are subject to change and will be presented thru the approved appointment date. Some of the images are stylized and may not not look exactly like the end-product.</b></p>
                  <div class="row">
                    <div class="col-lg-8">

                        <!-- FILTERPLANS --> 
                    
                        <div id="order-summary" class="well well-lg col-md-12">
                          <div class="box-header mt-0">
                            <h3>Filter Plans </h3>
                          </div>
                          <p class="text-muted">Set your home specifications. <a data-tooltip="This functions filters the available house plan based on your Lot Size, Budget, Number of Bedrooms, Number of Bathrooms, and Parking."
       data-tooltip-location="top"> (?)</a></p>
                          <div class="table-responsive" id="layoutfilter">

                          
                            <div class="col-md-12">

                                <!-- Start -->
                              <div class="row">
                                <div class="col-md-6">
                                  <label><strong>Lot Size</strong> (in sqm): </label>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Size_Min" min="20" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Size_Max" min="20" class="form-control radius" placeholder="Max" />
                                </div>
                              </div> <!-- End -->

                              <!-- Start Budget -->
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Budget: </strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="text" id="Plan_Price_Min" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="text" id="Plan_Price_Max" class="form-control radius" placeholder="Max" />
                                </div>
                              </div> <!-- End -->

                              <!-- Start -->
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Number of Bedroom/s: </strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Bedroom_Min" min="1" max="5" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Bedroom_Max" min="1" max="5" class="form-control radius" placeholder="Max" />
                                </div>
                              </div> <!-- End -->

                              <!-- Start -->
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Number of Bathroom/s: </strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Bathroom_Min" min="1" max="5" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Bathroom_Max" min="1" max="5" class="form-control radius" placeholder="Max" />
                                </div>
                              </div> <!-- End -->

                              <!-- # of parking section -->
                                <div class="row">
                                  <div class="col-md-12">
                                    <label><strong>Number of Parking: </strong></label>
                                  </div>
                                </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Parking_Min" min="1" max="5" class="form-control radius" placeholder="Min" />
                                </div>
                                <div class="col-md-6">
                                  <input type="number" id="Plan_Parking_Max" min="1" max="5" class="form-control radius" placeholder="Max" />
                                </div>
                              </div> <!-- end # of parking section -->


                              <!-- Start Button -->
                              <div class="row">
                                <div class="col-md-12">
                                    <br>
                                  <center><a id="filter" class="btn btn-primary" onclick="filterPlan();">Search</a></center>
                                </div>
                              </div> <!-- End Button -->

                            </div>
                          </div>

                          </div>
                        
                      
                      
                      <!-- END OF FILTER PLANS --> 



                      <!-- Categorying Options -->
                      <div class="well well-lg col-md-12" id="Plan">
                        <strong>Plan Options<a data-tooltip="The available House Plans."
       data-tooltip-location="right"> (?)</a></strong><br><br>



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
                                      <div class="col-md-4" style="white-space: pre-line">
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
                        <strong>Finishes Options <a data-tooltip="The available Finishes for your Dream Home."
       data-tooltip-location="right"> (?)</a></strong><br><br>

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
                        <strong>Category Options <a data-tooltip="This function lets you choose the type of Materials to be used in every Category."
       data-tooltip-location="right"> (?)</a></strong><br><br>
                        <div id="Category">

                        </div>
                      </div>

                      <div class="well well-lg col-md-12">
                        <strong>Part Options <a data-tooltip="Part Options - "
       data-tooltip-location="right"> (?)</a></strong><br><br>
                        <div id="Part">

                        </div>
                      </div>


                     
                    </div>



                    <!-- Specification Summary -->
                    <div class="col-lg-4">
                      
                      <div class="row">
                        <div id="order-summary" class="box mt-0 mb-4 p-0" style="height:1550px;width:375px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                          <div class="box-header mt-0">
                            <h3>Specification Summary</h3>
                          </div>
                          <p class="text-muted">Your new home specifications. <a data-tooltip="This function shows the breakdown of the prices of the features/specifications you choosed."
       data-tooltip-location="top"> (?)</a></p>
                          <hr>
                          <div class="table-responsive" id="projectlist">
                          </div>
                        </div>
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
                </div>
                <!--  End step 1 -->





                <!-- Start Step 3 -->



                <!-- Start Step 4 (Finished Tab) -->
                <div class="tab-pane <?php echo ((empty($_GET['finalP']))?'':'active'); ?>" id="step3">
                  <div class="row">
                    <div class="col-sm-12">

                      <div id="basket" class="col-md-offset-2 col-md-8">
                        <div class="box mt-0 pb-0 no-horizontal-padding" style="height:1500px;width:700px;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
                          <form method="get" action="">
                            <div class="table-responsive">
                                <table class="table table-striped">
                            
                                <h5 class="info-text"> <b>Home Specifications</b></h5><hr>
                                
                                    <thead>
                                        <tr>
                                          
                                          <th scope="col">Description</th>
                                          <th scope="col">Total</th>
                                        </tr>
                                      </thead>
                                    <tbody>
                                  <?php
                                  $totalPrice = 0;
                                  $FinalProj = (empty($_GET['finalP']))?'0':$_GET['finalP'];
                                  $Plan_Id = $clsProject->GetPlan_IdById($FinalProj);
                                  $mdlPlan = $clsPlan->GetById($Plan_Id);
                                  ?>
                                  <ul>
                                    <li><b>Plan Type: </b><?php echo $mdlPlan->getName(); ?></li>
                                  <?php
                                  $lstCategory = $clsCategory->GetByPlan_Id($Plan_Id);
                                  foreach ($lstCategory as $mdlCategory){
                                    ?>
                                    
                                    <hr>
                                    <ul>
                                      <li><b><?php echo $mdlCategory->getName(); ?></b></li>
                                    <?php
                                    $lstPart = $clsPart->GetByCategory_Id($mdlCategory->getId());
                                    foreach ($lstPart as $mdlPart) {
                                      if ($mdlPart->getArea() <= 0) {
                                        $mdlPart->setArea('1');
                                      }
                                      ?>
                                      <ul>
                                        <li><b><?php echo $mdlPart->getName(); ?></b></li>
                                      <?php
                                        $lstMaterial = $clsMaterial->GetByPart_Id($mdlPart->getId());
                                        foreach ($lstMaterial as $mdlMaterial) {

                                          $mdlUserProject->setProject_Id($FinalProj);
                                          $mdlUserProject->setMaterial_Id($mdlMaterial->getId());
                                          $mdlUserProject->setUpgrade_Id('0');
                                          if ($clsUserProject->IsExist($mdlUserProject)) {
                                						if ($mdlMaterial->getPriceType() == "0") {
                                							$PMprice = $mdlMaterial->getPrice() * $mdlPart->getArea();
                                							$totalPrice += $PMprice;
                                						}else{
                                							$PMprice = $mdlMaterial->getPrice() * $mdlPart->getPiece();
                                							$totalPrice += $PMprice;
                                						}
                                            ?>
                                            <ul>
                                              <li>
                                                <div class="col-sm-6" style="padding:0px;"><?php echo $mdlMaterial->getName(); ?></div>
                                                <div class="col-sm-6 text-right" style="padding:0px;">₱ <?php echo $PMprice; ?>.00</div>
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
                                						if ($mdlUpgrade->getPriceType() == "0") {
                                							$PUprice = $mdlUpgrade->getPrice() * $mdlPart->getArea();
                                							$totalPrice += $PUprice;
                                						}else{
                                							$PUprice = $mdlUpgrade->getPrice() * $mdlPart->getPiece();
                                							$totalPrice += $PUprice;
                                						}
                                            ?>
                                            <ul>
                                              <li>
                                                <div class="col-sm-6" style="padding:0px;"><?php echo $mdlUpgrade->getName(); ?></div>
                                                <div class="col-sm-6 text-right" style="padding:0px;">₱ <?php echo $PUprice; ?>.00</div>
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
                                      <hr>
                                    <div class="col-sm-6"><b>Total Amount</b>
                                    </div>
                                    <div class="col-sm-6 text-right" style="padding:0px;">
                                      ₱ <?php echo $totalPrice; ?>.00
                                    </div>
                                  </div>
                            </div>
                            </table>
                            <div class="box-footer d-flex justify-content-between align-items-center">
                            </div>
                          </form>
                        </div>
                      </div>



                              <div class="col-sm-10 col-sm-offset-1"><br>
              <center><h6>By clicking "Proceed to Checkout", you agree to Visioner Design and Builders Terms and that you have read our  <a href="#" data-toggle="modal" data-target="#myModal"><strong><u>Terms of Service.</u></strong></a> </h6></center>

               <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Visioner Design and Builders - Terms and Conditions</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <h2>Welcome to Visioner Design and Builders</h2>
	<p>These terms and conditions outline the rules and regulations for the use of Visioner Design and Builders's Website.</p> <br />
	<span style="text-transform: capitalize;"> Visioner Design and Builders</span> is located at:<br />
	<address>30 Bascom Quezon City <br />1123 - Metro Manila , Philippines<br />
	</address>
	<p>By accessing this website we assume you accept these terms and conditions in full. Do not continue to use Visioner Design and Builders's website
	if you do not accept all of the terms and conditions stated on this page.</p>
	<p>The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice
	and any or all Agreements: “Client”, “You” and “Your” refers to you, the person accessing this website
	and accepting the Company’s terms and conditions. “The Company”, “Ourselves”, “We”, “Our” and “Us”, refers
	to our Company. “Party”, “Parties”, or “Us”, refers to both the Client and ourselves, or either the Client
	or ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake
	the process of our assistance to the Client in the most appropriate manner, whether by formal meetings
	of a fixed duration, or any other means, for the express purpose of meeting the Client’s needs in respect
	of provision of the Company’s stated services/products, in accordance with and subject to, prevailing law
	of Philippines. Any use of the above terminology or other words in the singular, plural,
	capitalisation and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p><h2>Cookies</h2>
	<p>We employ the use of cookies. By using Visioner Design and Builders's website you consent to the use of cookies
	in accordance with Visioner Design and Builders’s privacy policy.</p><p>Most of the modern day interactive web sites
	use cookies to enable us to retrieve user details for each visit. Cookies are used in some areas of our site
	to enable the functionality of this area and ease of use for those people visiting. Some of our
	affiliate / advertising partners may also use cookies.</p><h2>License</h2>
	<p>Unless otherwise stated, Visioner Design and Builders and/or it’s licensors own the intellectual property rights for
	all material on Visioner Design and Builders. All intellectual property rights are reserved. You may view and/or print
	pages from https://visionerdesignandbuilders.com/ for your own personal use subject to restrictions set in these terms and conditions.</p>
	<p>You must not:</p>
	<ol>
		<li>Republish material from https://visionerdesignandbuilders.com/</li>
		<li>Sell, rent or sub-license material from https://visionerdesignandbuilders.com/</li>
		<li>Reproduce, duplicate or copy material from https://visionerdesignandbuilders.com/</li>
	</ol>
	<p>Redistribute content from Visioner Design and Builders (unless content is specifically made for redistribution).</p>
<h2>Hyperlinking to our Content</h2>
	<ol>
		<li>The following organizations may link to our Web site without prior written approval:
			<ol>
			<li>Government agencies;</li>
			<li>Search engines;</li>
			<li>News organizations;</li>
			<li>Online directory distributors when they list us in the directory may link to our Web site in the same
				manner as they hyperlink to the Web sites of other listed businesses; and</li>
			<li>Systemwide Accredited Businesses except soliciting non-profit organizations, charity shopping malls,
				and charity fundraising groups which may not hyperlink to our Web site.</li>
			</ol>
		</li>
	</ol>
	<ol start="2">
		<li>These organizations may link to our home page, to publications or to other Web site information so long
			as the link: (a) is not in any way misleading; (b) does not falsely imply sponsorship, endorsement or
			approval of the linking party and its products or services; and (c) fits within the context of the linking
			party's site.
		</li>
		<li>We may consider and approve in our sole discretion other link requests from the following types of organizations:
			<ol>
				<li>commonly-known consumer and/or business information sources such as Chambers of Commerce, American
					Automobile Association, AARP and Consumers Union;</li>
				<li>dot.com community sites;</li>
				<li>associations or other groups representing charities, including charity giving sites,</li>
				<li>online directory distributors;</li>
				<li>internet portals;</li>
				<li>accounting, law and consulting firms whose primary clients are businesses; and</li>
				<li>educational institutions and trade associations.</li>
			</ol>
		</li>
	</ol>
	<p>We will approve link requests from these organizations if we determine that: (a) the link would not reflect
	unfavorably on us or our accredited businesses (for example, trade associations or other organizations
	representing inherently suspect types of business, such as work-at-home opportunities, shall not be allowed
	to link); (b)the organization does not have an unsatisfactory record with us; (c) the benefit to us from
	the visibility associated with the hyperlink outweighs the absence of <?=$companyName?>; and (d) where the
	link is in the context of general resource information or is otherwise consistent with editorial content
	in a newsletter or similar product furthering the mission of the organization.</p>

	<p>These organizations may link to our home page, to publications or to other Web site information so long as
	the link: (a) is not in any way misleading; (b) does not falsely imply sponsorship, endorsement or approval
	of the linking party and it products or services; and (c) fits within the context of the linking party's
	site.</p>

	<p>If you are among the organizations listed in paragraph 2 above and are interested in linking to our website,
	you must notify us by sending an e-mail to <a href="mailto:isioneridesign@gmail.com" title="send an email to isioneridesign@gmail.com">isioneridesign@gmail.com</a>.
	Please include your name, your organization name, contact information (such as a phone number and/or e-mail
	address) as well as the URL of your site, a list of any URLs from which you intend to link to our Web site,
	and a list of the URL(s) on our site to which you would like to link. Allow 2-3 weeks for a response.</p>

	<p>Approved organizations may hyperlink to our Web site as follows:</p>

	<ol>
		<li>By use of our corporate name; or</li>
		<li>By use of the uniform resource locator (Web address) being linked to; or</li>
		<li>By use of any other description of our Web site or material being linked to that makes sense within the
			context and format of content on the linking party's site.</li>
	</ol>
	<p>No use of Visioner Design and Builders’s logo or other artwork will be allowed for linking absent a trademark license
	agreement.</p>
<h2>Iframes</h2>
	<p>Without prior approval and express written permission, you may not create frames around our Web pages or
	use other techniques that alter in any way the visual presentation or appearance of our Web site.</p>
<h2>Reservation of Rights</h2>
	<p>We reserve the right at any time and in its sole discretion to request that you remove all links or any particular
	link to our Web site. You agree to immediately remove all links to our Web site upon such request. We also
	reserve the right to amend these terms and conditions and its linking policy at any time. By continuing
	to link to our Web site, you agree to be bound to and abide by these linking terms and conditions.</p>
<h2>Removal of links from our website</h2>
	<p>If you find any link on our Web site or any linked web site objectionable for any reason, you may contact
	us about this. We will consider requests to remove links but will have no obligation to do so or to respond
	directly to you.</p>
	<p>Whilst we endeavour to ensure that the information on this website is correct, we do not warrant its completeness
	or accuracy; nor do we commit to ensuring that the website remains available or that the material on the
	website is kept up to date.</p>
<h2>Content Liability</h2>
	<p>We shall have no responsibility or liability for any content appearing on your Web site. You agree to indemnify
	and defend us against all claims arising out of or based upon your Website. No link(s) may appear on any
	page on your Web site or within any context containing content or materials that may be interpreted as
	libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or
	other violation of, any third party rights.</p>
<h2>Disclaimer</h2>
	<p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website (including, without limitation, any warranties implied by law in respect of satisfactory quality, fitness for purpose and/or the use of reasonable care and skill). Nothing in this disclaimer will:</p>
	<ol>
	<li>limit or exclude our or your liability for death or personal injury resulting from negligence;</li>
	<li>limit or exclude our or your liability for fraud or fraudulent misrepresentation;</li>
	<li>limit any of our or your liabilities in any way that is not permitted under applicable law; or</li>
	<li>exclude any of our or your liabilities that may not be excluded under applicable law.</li>
	</ol>
	<p>The limitations and exclusions of liability set out in this Section and elsewhere in this disclaimer: (a)
	are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer or
	in relation to the subject matter of this disclaimer, including liabilities arising in contract, in tort
	(including negligence) and for breach of statutory duty.</p>
	<p>To the extent that the website and the information and services on the website are provided free of charge,
	we will not be liable for any loss or damage of any nature.</p>
<h2></h2>
	<p></p>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div> <!-- end of modal -->
                        </div>

                      </div>






                  </div>
                </div>
                <!--  End step 4 -->

              </div>

            <!-- Previous & Next Buttons -->
              <div class="wizard-footer">
                <div class="pull-right">
                  <a href="../user/payment.php" class='btn btn-finish btn-primary'>Proceed to Checkout</a>
                </div>

                <div class="pull-left">
                  <a href="?project=<?php echo $_GET['finalP']; ?>" class='btn btn-finish btn-primary'>Previous</a>
                </div>
                <div class="clearfix"></div>
              </div>
              <!-- End Previous & Next Buttons -->
              
              
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
