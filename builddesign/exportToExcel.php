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

  // file name for download
  $fileName = "ProjectSummary" . date('Ymd') . ".xls";

  // headers for download
  header("Content-Disposition: attachment; filename=\"$fileName\"");
  header("Content-Type: application/vnd.ms-excel");





  $totalPrice = 0;
  $FinalProj = (empty($_GET['finalP']))?'0':$_GET['finalP'];
  $Plan_Id = $clsProject->GetPlan_IdById($FinalProj);
  $mdlPlan = $clsPlan->GetById($Plan_Id);
  $totalPrice += $mdlPlan->getPrice();

  echo "Plan Type:" . "\t" . $mdlPlan->getName() . "\t" . "\t" . "(Base Price: PHP " . $totalPrice. ") \n";
  echo "\n";
  echo "\n";
  echo "\tCATEGORY\tPART\n\n";
    $lstCategory = $clsCategory->GetByPlan_Id($Plan_Id);
    foreach ($lstCategory as $mdlCategory){
      echo "\t" . $mdlCategory->getName() ."\n";
      $lstPart = $clsPart->GetByCategory_Id($mdlCategory->getId());

      foreach ($lstPart as $mdlPart) {
        if ($mdlPart->getArea() <= 0) {
          $mdlPart->setArea('1');
        }
        echo "\t\t" . $mdlPart->getName() . "\n";

        $lstMaterial = $clsMaterial->GetByPart_Id($mdlPart->getId());
        foreach ($lstMaterial as $mdlMaterial) {

          $mdlUserProject->setProject_Id($FinalProj);
          $mdlUserProject->setMaterial_Id($mdlMaterial->getId());
          $mdlUserProject->setUpgrade_Id('0');
          if ($clsUserProject->IsExist($mdlUserProject)) {
            echo "\t\t\tMaterial:\t" . $mdlMaterial->getName() . "\t";

            if ($mdlMaterial->getPriceType() == "0") {
              $PMprice = $mdlMaterial->getPrice() * $mdlPart->getArea();
              $totalPrice += $PMprice;
              echo $mdlPart->getArea() . " sqm";
            }else{
              $PMprice = $mdlMaterial->getPrice() * $mdlPart->getPiece();
              $totalPrice += $PMprice;
              echo $mdlPart->getPiece() . " pc";
            }

            echo "\t" . $mdlMaterial->getPrice()."php \t" . $PMprice . ".00" . "\n";
            }
          }

          $lstUpgrade = $clsUpgrade->GetByPart_Id($mdlPart->getId());
          foreach ($lstUpgrade as $mdlUpgrade) {

            $mdlUserProject->setProject_Id($FinalProj);
            $mdlUserProject->setMaterial_Id('0');
            $mdlUserProject->setUpgrade_Id($mdlUpgrade->getId());
            if ($clsUserProject->IsExist($mdlUserProject)) {
              echo "\t\t\tUpgrade:\t" . $mdlUpgrade->getName() . "\t";

              if ($mdlUpgrade->getPriceType() == "0") {
                $PUprice = $mdlUpgrade->getPrice() * $mdlPart->getArea();
                $totalPrice += $PUprice;
                echo $mdlPart->getArea() . " sqm";
              }else{
                $PUprice = $mdlUpgrade->getPrice() * $mdlPart->getPiece();
                $totalPrice += $PUprice;
                echo $mdlPart->getPiece() . " pc";
              }

              echo "\t" . $mdlMaterial->getPrice()."php \t" . $PUprice . ".00" . "\n";

            }
          }
        }
      }

      echo "\n\tTotal Amount:\t\t\t\t\tPhp " . $totalPrice . ".00";

    exit;
?>
