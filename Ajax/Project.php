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

$call = $_GET['call'];

switch ($call)
{
	case 'floor':
	{
		displayFloor($_GET['Id']);
		break;
	}
	case 'room':
	{
		displayRoom($_GET['Id']);
		break;
	}
	case 'deleteRoom':
	{
		deleteRoom($_GET['Id']);
		break;
	}
	case 'deleteDisplay':
	{
		deleteDisplay($_GET['Id']);
		break;
	}
}


function displayFloor($id)
{
	$cls = new Floor();
	$mdl = new FloorModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

  $lst = $cls->GetFloorByLayout_Id($id);

  foreach ($lst as $mdl) {
    $imgLocation = "";
    $lstImage = $clsImage->GetByDetail("floor",$mdl->getId(),"original");
    foreach($lstImage as $mdlImage){
      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
    }
    ?>
    <div class="col-md-3 col-sm-4 mb-10 p-0">
      <a href="javascript:void(0);" onclick="selFloor(<?php echo $mdl->getId(); ?>);" class="card shadow featured bg-light" style="color:#666;" id="Layout_<?php echo $mdl->getId(); ?>">
        <div class="card-img-top img-featured" style="background-image: url('<?php echo $imgLocation; ?>')" alt="<?php echo $mdl->getName(); ?>"></div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $mdl->getName(); ?></h5>
          <p class="card-text">
            <?php echo $mdl->getDescription(); ?>
          </p>
        </div>
      </a>
    </div>
  <?php
  }
  if (empty($lst)) {
    echo 'No Floor Attached';
  }
}


function displayRoom($id)
{
	$cls = new Floor();
	$mdl = new FloorModel();
	$clsImage = new Image();
	$mdlImage = new ImageModel();

  $lst = $cls->GetFloorByLayout_Id($id);

  foreach ($lst as $mdl) {
    $imgLocation = "";
    $lstImage = $clsImage->GetByDetail("floor",$mdl->getId(),"original");
    foreach($lstImage as $mdlImage){
      $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
    }
    ?>
    <div class="col-md-3 col-sm-4 mb-10 p-0">
      <a href="javascript:void(0);" onclick="selLayout(<?php echo $mdl->getId(); ?>);" class="card shadow featured bg-light" style="color:#666;" id="Layout_<?php echo $mdl->getId(); ?>">
        <div class="card-img-top img-featured" style="background-image: url('<?php echo $imgLocation; ?>')" alt="<?php echo $mdl->getName(); ?>"></div>
        <div class="card-body">
          <h5 class="card-title"><?php echo $mdl->getName(); ?></h5>
          <p class="card-text">
            <?php echo $mdl->getDescription(); ?>
          </p>
        </div>
      </a>
    </div>
  <?php
  }
  if (empty($lst)) {
    echo 'No Floor Attached';
  }
}
?>
