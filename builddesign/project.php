<?php
require_once ("../App_Code/Database.php");
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

  <link rel="stylesheet" href="../JumEE/css/bootstrap.min.css">
  <style>

    .shadow {
      box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
    }
    .shadow:hover {
      -webkit-box-shadow: 0px 0px 30px 5px rgba(0,0,0,0.2) !important;
      -moz-box-shadow: 	0px 0px 30px 5px rgba(0,0,0,0.2) !important;
      box-shadow: 		0px 0px 30px 5px rgba(0,0,0,0.2) !important;
    }
    .slider {
      margin-bottom: 0px;
    }
    .featured{
      text-decoration: none !important;
    }
    .img-featured{
      width: 100%;
      height: 200px;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: 50% 50%;
    }
  </style>
  <script>
    function selLayout(LayoutId) {
      var cleaner = '';
        <?php
        foreach ($lstLayout as $mdlLayout) {
          echo 'cleaner = document.getElementById("Layout_'.$mdlLayout->getId().'");';
          echo "cleaner.classList.remove('text-white');";
          echo "cleaner.classList.remove('bg-info');";
          echo "cleaner.classList.add('bg-light');";
        }
        ?>
      var layout = document.getElementById("Layout_"+LayoutId);
      layout.classList.remove("bg-light");
      layout.classList.add("text-white");
      layout.classList.add("bg-info");

      var xmlhttp = new XMLHttpRequest();
      var url = "";
      var btn = "";
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("Floor").innerHTML = this.responseText;
          document.getElementById("Room").innerHTML = '';
          document.getElementById("Parts").innerHTML = '';
          document.getElementById("Material").innerHTML = '';
          document.getElementById("UpgradeA").innerHTML = '';
        }
      };
      url = "../Ajax/Project.php";
      url += "?call=floor";
      url += "&Id=" + LayoutId;
      xmlhttp.open("GET", url, true);
      xmlhttp.send();

    }

    function selFloor(id) {
      var cleaner = '';
        <?php
        foreach ($lstLayout as $mdlLayout) {
          echo 'cleaner = document.getElementById("Layout_'.$mdlLayout->getId().'");';
          echo "cleaner.classList.remove('text-white');";
          echo "cleaner.classList.remove('bg-info');";
          echo "cleaner.classList.add('bg-light');";
        }
        ?>
      var item = document.getElementById("LayoutFloor_"+id);
      item.classList.remove("bg-light");
      item.classList.add("text-white");
      item.classList.add("bg-info");

      var xmlhttp = new XMLHttpRequest();
      var url = "";
      var btn = "";
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("Room").innerHTML = this.responseText;
          document.getElementById("Parts").innerHTML = '';
          document.getElementById("Material").innerHTML = '';
          document.getElementById("UpgradeA").innerHTML = '';
        }
      };
      url = "../Ajax/Project.php";
      url += "?call=room";
      url += "&Id=" + id;
      xmlhttp.open("GET", url, true);
      xmlhttp.send();

    }
  </script>
  </head>

  <body>
    <div class="container">
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
                        <div class="row"  style="width:100% !important;">
                          <?php
                          foreach ($lstLayout as $mdlLayout) {
                            $imgLocation = "";
                            $lstImage = $clsImage->GetByDetail("layout",$mdlLayout->getId(),"original");
                            foreach($lstImage as $mdlImage){
                              $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
                            }
                            ?>
                              <div class="col-md-3 col-sm-4 mb-10 p-0 mt-4">
    													  <a href="javascript:void(0);" onclick="selLayout(<?php echo $mdlLayout->getId(); ?>);" class="card shadow featured bg-light" style="color:#666;" id="Layout_<?php echo $mdlLayout->getId(); ?>">
    													    <div class="card-img-top img-featured" style="background-image: url('<?php echo $imgLocation; ?>')" alt="<?php echo $mdlLayout->getName(); ?>"></div>
    													    <div class="card-body">
    													      <h5 class="card-title"><?php echo $mdlLayout->getName(); ?></h5>
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
                        <div class="row"  style="width:100% !important;" id="Floor">
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
                        <div class="row"  style="width:100% !important;" id="Room">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel-body mb-4">
                  <div class="row">
                    <div class="col-xs-12" style="width:100% !important;">
                      <div class="card-deck">
                        <div class="row"  style="width:100% !important;" id="Parts">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel-body mb-4">
                  <div class="row">
                    <div class="col-xs-12" style="width:100% !important;">
                      <div class="card-deck">
                        <div class="row"  style="width:100% !important;" id="Material">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel-body mb-4">
                  <div class="row">
                    <div class="col-xs-12" style="width:100% !important;">
                      <div class="card-deck">
                        <div class="row"  style="width:100% !important;" id="Upgrade">
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
    </div>

    <script src="../JumEE/js/bootstrap.min.js"></script>
    <script src="../JumEE/js/jquery-3.2.1.slim.min.js"></script>
    <script src="../JumEE/js/popper.min.js"></script>
  </body>

</html>
