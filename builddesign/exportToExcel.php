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

require_once ("../App_Code/Unit.php");

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
  echo "\tCATEGORY\tPART\t\t\tArea/Piece\tPrice\tNeeded\tTotal\t\tDescription\n\n";
    $lstCategory = $clsCategory->GetByPlan_Id($Plan_Id);
    foreach ($lstCategory as $mdlCategory){
      echo "\t" . $mdlCategory->getName() ."\n";
      $lstPart = $clsPart->GetByCategory_Id($mdlCategory->getId());

      foreach ($lstPart as $mdlPart) {
        $unit_pN = $clsUnit->GetNicknameById($mdlPart->getUnit_Id());
        if ($mdlPart->getArea() <= 0) {
          $mdlPart->setArea('1');
        }
        echo "\t\t" . $mdlPart->getName() . "\n";

        $lstMaterial = $clsMaterial->GetByPart_Id($mdlPart->getId());
        foreach ($lstMaterial as $mdlMaterial) {
          $unit_mN = $clsUnit->GetNicknameById($mdlMaterial->getUnit_Id());
          $mdlUserProject->setProject_Id($FinalProj);
          $mdlUserProject->setMaterial_Id($mdlMaterial->getId());
          $mdlUserProject->setUpgrade_Id('0');
          if ($clsUserProject->IsExist($mdlUserProject)) {

            echo "\t";
            echo "\t";
            echo "\t";
            echo "Material:\t";
            echo $mdlMaterial->getName() . "\t";

            if ($mdlMaterial->getPriceType() == "0") {
              $M_width = $mdlMaterial->getWidth() * $clsUnit->getConversionById($mdlMaterial->getUnit_Id());
              $M_height = $mdlMaterial->getHeight() * $clsUnit->getConversionById($mdlMaterial->getUnit_Id());
              $M_area = $M_width * $M_height;

              $P_area = $mdlPart->getArea() * pow($clsUnit->getConversionById($mdlPart->getUnit_Id()),2);
              $Needed = ceil($P_area / $M_area);

              $PMprice = $Needed * $mdlMaterial->getPrice();
              // $PMprice = $mdlMaterial->getPrice() * $mdlPart->getArea();
              $totalPrice += $PMprice;
              echo $mdlMaterial->getWidth() . " " . $unit_mN . " x " . $mdlMaterial->getHeight() . " " . $unit_mN . "\t";
              echo "Php " . $mdlMaterial->getPrice() . "\t";
              echo $mdlPart->getArea() . "sq. " . $unit_pN . "\t";
              echo "Php " . $PMprice . "\t";
              echo "\t";
              echo $mdlMaterial->getDescription() . "\t";

            }else if ($mdlMaterial->getPriceType() == "1") {
              $PMprice = $mdlMaterial->getPrice() * $mdlPart->getPiece();
              $totalPrice += $PMprice;
              echo "1 pc" . "\t";
              echo "Php " . $mdlMaterial->getPrice() . "\t";
              echo $mdlPart->getPiece() . "sq. " . $unit_pN . "\t";
              echo "Php " . $PMprice . "\t";
              echo "\t";
              echo $mdlMaterial->getDescription() . "\t";
            }else{
              $PMprice = $mdlMaterial->getPrice() * $mdlPart->getArea();
              $totalPrice += $PMprice;
              echo "1 sq. " . $unit_pN . "\t";
              echo "Php " . $mdlMaterial->getPrice() . "\t";
              echo $mdlPart->getArea() . "sq. " . $unit_pN . "\t";
              echo "Php " . $PMprice . "\t";
              echo "\t";
              echo $mdlMaterial->getDescription() . "\t";
            }
            echo "\n";
          }
        }

          $lstUpgrade = $clsUpgrade->GetByPart_Id($mdlPart->getId());
          foreach ($lstUpgrade as $mdlUpgrade) {
            $unit_uN = $clsUnit->GetNicknameById($mdlUpgrade->getUnit_Id());

            $mdlUserProject->setProject_Id($FinalProj);
            $mdlUserProject->setMaterial_Id('0');
            $mdlUserProject->setUpgrade_Id($mdlUpgrade->getId());
            if ($clsUserProject->IsExist($mdlUserProject)) {
              echo "\t";
              echo "\t";
              echo "\t";
              echo "Upgrade:\t";
              echo $mdlUpgrade->getName() . "\t";

              if ($mdlUpgrade->getPriceType() == "0") {
                $M_width = $mdlUpgrade->getWidth() * $clsUnit->getConversionById($mdlUpgrade->getUnit_Id());
                $M_height = $mdlUpgrade->getHeight() * $clsUnit->getConversionById($mdlUpgrade->getUnit_Id());
                $M_area = $M_width * $M_height;

                $P_area = $mdlPart->getArea() * pow($clsUnit->getConversionById($mdlPart->getUnit_Id()),2);
                $Needed = ceil($P_area / $M_area);

                $PUprice = $Needed * $mdlUpgrade->getPrice();
                // $PUprice = $mdlUpgrade->getPrice() * $mdlPart->getArea();
                $totalPrice += $PUprice;
                echo $mdlUpgrade->getWidth() . " " . $unit_uN . " x " . $mdlUpgrade->getHeight() . " " . $unit_uN . "\t";
                echo "Php " . $mdlUpgrade->getPrice() . "\t";
                echo $mdlPart->getArea() . "sq. " . $unit_pN . "\t";
                echo "Php " . $PUprice . "\t";
                echo "\t";
                echo $mdlUpgrade->getDescription() . "\t";
              }else if ($mdlUpgrade->getPriceType() == "1") {
                $PUprice = $mdlUpgrade->getPrice() * $mdlPart->getPiece();
                $totalPrice += $PUprice;
                echo "1 pc" . "\t";
                echo "Php " . $mdlUpgrade->getPrice() . "\t";
                echo $mdlPart->getPiece() . "sq. " . $unit_pN . "\t";
                echo "Php " . $PUprice . "\t";
                echo "\t";
                echo $mdlUpgrade->getDescription() . "\t";
              }else{
                $PUprice = $mdlUpgrade->getPrice() * $mdlPart->getArea();
                $totalPrice += $PUprice;
                echo "1 sq. " . $unit_pN . "\t";
                echo "Php " . $mdlUpgrade->getPrice() . "\t";
                echo $mdlPart->getArea() . "sq. " . $unit_pN . "\t";
                echo "Php " . $PUprice . "\t";
                echo "\t";
                echo $mdlUpgrade->getDescription() . "\t";
              }

              echo "\n";

            }
          }
        }
      }

      echo "\n\tTotal Amount:\t\t\t\t\t\t\tPhp " . $totalPrice . ".00";

    exit;
?>
