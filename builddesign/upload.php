<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Functions.php");
require_once ("../App_Code/Project.php");
require_once ("../App_Code/Upload.php");
require_once ("../App_Code/Image.php");
include("../functions/functions.php");

$msg = "";
$err = "";

if (empty($_SESSION['uid'])) {
  header("Location: ../index.php?login");
  die();
}

if(isset($_POST['Name'])){


  $mdlProject->setType('2');
  $mdlProject->setUser_Id($_SESSION['uid']);
	$err .= $clsFn->setForm('Name',$mdlProject,true);

	$err .= $clsFn->setForm('Description',$mdlUpload,true);

	if($err == ""){
		$duplicate = $clsProject->IsExist($mdlProject);
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
			$Project_Id = $clsProject->Add($mdlProject);
			$msg .= '
				<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
				<span class="sr-only">Close</span>
				</button>
				<h6>
					Successfully Added.
				</h6>
				</div>
			     ';
      $Upload_Id = $clsUpload->Add($mdlUpload);
      $clsProject->UpdatePlan_Id($Project_Id,$Upload_Id);
        if (mkdir("../UploadFiles/" . $Upload_Id)) {

          $total = count($_FILES['fileToUpload']['name']);
          for( $i=0 ; $i < $total ; $i++ ) {

            //Get the temp file path
            $tmpFilePath = $_FILES['fileToUpload']['tmp_name'][$i];

            //Make sure we have a file path
            if ($tmpFilePath != ""){
              //Setup our new file path
              $newFilePath = "../UploadFiles/" . $Upload_Id . "/" . $_FILES['fileToUpload']['name'][$i];

              //Upload the file into the temp dir
              if(move_uploaded_file($tmpFilePath, $newFilePath)) {

                //Handle other code here

              }
            }
          }
        } else {
          $msg .= '
    				<div class="alert alert-danger alert-dismissible" role="alert">
    				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    				<span aria-hidden="true">×</span>
    				<span class="sr-only">Close</span>
    				</button>
    				<h6>
    					Failed to Create Directory for files.
    				</h6>
    				</div>
    			     ';
        }
			// Clear all data if success
			$mdlProject = new ProjectModel();
      $mdlUpload = new UploadModel();
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

<!DOCTYPE>
<html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Visioner Design and Builders | Home page</title>
        <meta name="description" content="Visioner Design and Builders">
        <meta name="author" content="Visioner">
        <meta name="keyword" content="html5, css, bootstrap, property, real-estate theme , bootstrap template">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,800' rel='stylesheet' type='text/css'>

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
        <link rel="icon" href="../favicon.ico" type="image/x-icon">

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
        <link rel="stylesheet" href="../assets/css/style.css">
        <link rel="stylesheet" href="../assets/css/responsive.css">
    </head>
    <body>

      <?php
      include "header.php";
      ?><!-- End of nav bar -->

        <div class="page-head">
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">Online Design and Build</h1>
                    </div>
                </div>
            </div>
        </div>
		        <!-- Login-area -->
    <div class="register-area" style="background-color: rgb(249, 249, 249);">
      <div class="container">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1 profiel-container">
              
                <div class="profiel-header">
                    <h3> SO YOU HAVE <strong>A PLAN</strong></h3>
                </div>
                <hr>
                
                 <div class="col-sm-8 col-sm-offset-2">
                                    
                                    <p class="text-muted">VisioNer is glad to further assist you. This page allows you a step closer to done. 
As soon as we receive your existing files, whether it be Drawings, Layouts, Land Title, Pictures or Plans, our next meeting will already be - to finalize a proposal. <strong>Quick and Easy.</strong></p>
                                   <hr>
                                </div>
                
                
                
                
                
                <div class="clear">
                    <div class="row">
                        
                        
          <div class="col-md-8 col-md-offset-2">
            <?php echo $msg; ?>
          </div>
        </div>
        <form method="post" action="" enctype="multipart/form-data" autocomplete="off">
          <div class="row" style="margin-bottom:10px;">
            

              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <h5><strong>Project Name:</strong></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <input type="text" class="form-control" id="inputName" name="Name" value="<?php echo $mdlProject->getName(); ?>"/>
                </div>
              </div>
<br>
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <h5><strong>Files:</strong></h5>
                </div>
              </div>
              
              <div class="well col-md-8 col-md-offset-2">
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <input type="file" class="form-control-file" multiple="multiple" name="fileToUpload[]"/>
                </div>
              </div></div>

            

              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <h5><strong>Description:</strong></h5>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <textarea class="form-control" rows="8" name="Description"><?php echo $mdlUpload->getDescription(); ?></textarea>
                </div>
              </div>

            
          </div>
          <div class="row">
            <div class="col-md-6 col-md-offset-5">
              <input type="submit" class="btn btn-finish btn-primary" value="Submit" />
            </div>
          </div>
        </form>
                    
                </div>
          </div>
        </div>
        
        
      </div>
    </div>


    <!-- Footer area-->
    <?php
    include ("footer.php");
    ?>
        </div>

        <script src="../assets/js/modernizr-2.6.2.min.js"></script>

        <script src="../assets/js/jquery-1.10.2.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../assets/js/bootstrap-select.min.js"></script>
        <script src="../assets/js/bootstrap-hover-dropdown.js"></script>

        <script src="../assets/js/easypiechart.min.js"></script>
        <script src="../assets/js/jquery.easypiechart.min.js"></script>

        <script src="../assets/js/owl.carousel.min.js"></script>
        <script src="../assets/js/wow.js"></script>

        <script src="../assets/js/icheck.min.js"></script>
        <script src="../assets/js/price-range.js"></script>

        <script src="../assets/js/main.js"></script>

    </body>
</html>
