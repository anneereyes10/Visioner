<?php
require_once ("../App_Code/Database.php");
require_once ("../App_Code/Project.php");
require_once ("../App_Code/UploadPlace.php");
require_once ("../App_Code/Payment.php");
require_once ("../App_Code/Place.php");
require_once ("../App_Code/PaymentType.php");
require_once ("../App_Code/Image.php");
if(!isset($_SESSION['email'])){

	echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
}
else {
?>
<div class="container-fluid">

  <!-- DataTables Example -->
  <div class="card mb-3">
    <div class="card-header">
      <i class="fas fa-table"></i>
      List of Users Account</div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
          <thead>
            <tr align="center">
              <th>Name</th>
              <th>Email</th>
              <th>Contact No.</th>
              <th>Other Details </th>
              <th>Payment Status</th>
              <th>Appointment Status</th>
            </tr>
          </thead>



         <?php 
	include("includes/db.php");
	
	$get_c = "select * from 
			  user_account
			  inner join payment_status
			  on user_account.user_id = payment_status.user_id
			  inner join appointment 
			  on payment_status.user_id = appointment.user_id";
	
	$run_c = mysqli_query($con, $get_c); 
	
	$i = 0;
	while ($row_c=mysqli_fetch_array($run_c)){
		

		$user_id=$row_c['user_id'];
		$c_name = $row_c['full_name'];
		$c_email = $row_c['user_email'];
		$c_cont = $row_c['contact'];
		$c_gend = $row_c['gender'];
		$c_bd = $row_c['birthdate'];
		$c_add = $row_c['address'];
		$p_id=$user_id;
		$p_type=$row_c['type_selected'];
		$p_status=$row_c['pay_status'];
		$p_dp=$row_c['date_paid'];
		$p_img=$row_c['payment_image'];
		$p_imgd=$row_c['image_date'];
		$a_id=$user_id;
		$a_status=$row_c['appointment_status'];
		$a_ds=$row_c['appointment_date'];
		$a_dm=$row_c['appointment_made'];
		$i++;
		

	
	?>
	<tr align="center">

            <td>
              <?php echo $c_name;?>
            </td>
            <td>
              <?php echo $c_email;?>
            </td>
            <td>
              <?php echo $c_cont;?>
            </td>
            <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#userModal<?php echo $i ?>">Show</button></td>
            <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#payModal<?php echo $i ?>">View</button></td>
            <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#appointModal<?php echo $i ?>">View</button></td>
          </tr>
          <div class="modal fade" id="userModal<?php echo $i ?>" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title text-left">Information for:
                    <?php echo $c_name ?>
                  </h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                  <p>
                    <strong>Name: </strong><br>
                    <?php echo $c_name ?> <br>
                  </p>
                  <p>
                    <strong>Email: </strong><br>
                    <?php echo $c_email ?>
                  </p>
                  <p>
                    <strong>Contact #: </strong><br>
                    <?php echo $c_cont ?>
                  </p>
                  <p>
                    <strong>Gender: </strong><br>
                    <?php echo $c_gend ?>
                  </p>
                  <p>
                    <strong>Birthdate: </strong><br>
                    <?php echo $c_bd ?>
                  </p>
                  <p>
                    <strong>Address: </strong><br>
                    <?php echo $c_add ?>
                  </p>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="payModal<?php echo $i ?>" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Information for:
                    <?php echo $c_email ?>
                  </h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="row m-0">
                    <div class="col-sm-2 border">
                      Image
                    </div>
                    <div class="col-sm-4 border">
                      Project
                    </div>
                    <div class="col-sm-2 border">
                      Payment Type
                    </div>
                    <div class="col-sm-2 border">
                      Payment Date
                    </div>
                    <div class="col-sm-2 border">
                      Status
                    </div>
                  </div>
                  <?php
        $lstPayment = $clsPayment->GetByUserId($user_id);
        foreach ($lstPayment as $mdlPayment) {
          $mdlProject = $clsProject->GetById($mdlPayment->getProject_Id());
          ?>
                  <div class="row m-0">
                    <div class="col-sm-2 border">
                      <?php
                $imgLocation = "";
                $lstImage = $clsImage->GetByDetail("payment",$mdlPayment->getId(),"original");
                foreach($lstImage as $mdlImage){
                  $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
                }
                if ($imgLocation != '') {
                  echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
                }
                ?>
                    </div>
                    <div class="col-sm-4 border">
                      <?php
                      switch ($mdlProject->getType()) {
                        case '0':{
                          echo 'Build: ';
                          break;
                        }
                        case '1':{
                          echo 'Service: ';
                          break;
                        }
                        case '2':{
                          echo 'Upload: ';
                          break;
                        }
                        default:
                          // code...
                          break;
                      }

                      echo $mdlProject->getName(); ?>
                    </div>
                    <div class="col-sm-2 border">
                      <?php echo $clsPaymentType->GetNameById($mdlPayment->getPaymentType_Id()); ?>
                    </div>
                    <div class="col-sm-2 border">
                      <?php echo $mdlPayment->getReceiptDate(); ?>
                    </div>
                    <div class="col-sm-2 border">
                      <?php
                if($mdlPayment->getReceiptStatus() == 0){
                  echo "Pending";
                } elseif($mdlPayment->getReceiptStatus() == 1){
                  echo "Approved";
                } else {
                  echo "Declined";
                }
                ?>
                    </div>
                  </div>
                  <?php
        }
        ?>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="appointModal<?php echo $i ?>" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Information for:
                    <?php echo $c_email ?>
                  </h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="row m-0">
                    <div class="col-sm-2 border">
                      Image
                    </div>
                    <div class="col-sm-4 border">
                      Project
                    </div>
                    <div class="col-sm-2 border">
                      Date
                    </div>
                    <div class="col-sm-2 border">
                      Place
                    </div>
                    <div class="col-sm-2 border">
                      Status
                    </div>
                  </div>
                  <?php
        $lstPayment = $clsPayment->GetByUserId($user_id);
        foreach ($lstPayment as $mdlPayment) {
          if ($mdlPayment->getAppointmentStatus() == 1) {
          ?>
                  <div class="row m-0">
                    <div class="col-sm-2 border">
                      <?php
                $imgLocation = "";
                $lstImage = $clsImage->GetByDetail("payment",$mdlPayment->getId(),"original");
                foreach($lstImage as $mdlImage){
                  $imgLocation = "../" . $clsImage->ToLocation($mdlImage);
                }
                if ($imgLocation != '') {
                  echo '<img src="'.$imgLocation.'" style="max-width:100px;max-height:100px;">';
                }
                ?>
                    </div>
                    <?php
                    $mdlProject = $clsProject->GetById($mdlPayment->getProject_Id());
                    ?>
                    <div class="col-sm-4 border">
                      <?php
                      switch ($mdlProject->getType()) {
                        case '0':{
                          echo 'Build: ';
                          break;
                        }
                        case '1':{
                          echo 'Service: ';
                          break;
                        }
                        case '2':{
                          echo 'Upload: ';
                          break;
                        }
                        default:
                          // code...
                          break;
                      }

                       echo $mdlProject->getName(); ?>
                    </div>
                    <?php
                    if ($mdlProject->getType() == "2") {
                      $mdlUploadPlace = $clsUploadPlace->GetById($mdlPayment->getPlace_Id());
                      ?>
                      <div class="col-sm-2 border">
                        <?php echo $mdlUploadPlace->getDateTime(); ?>
                      </div>
                      <div class="col-sm-2 border">
                        <?php echo $mdlUploadPlace->getPlace(); ?>
                      </div>
                      <?php
                    } else {
                      ?>
                      <div class="col-sm-2 border">
                        <?php echo $mdlPayment->getAppointmentDate(); ?>
                      </div>
                      <div class="col-sm-2 border">
                        <?php echo $clsPlace->GetNameById($mdlPayment->getPlace_Id()); ?>
                      </div>
                      <?php
                    }
                    ?>
                    <div class="col-sm-2 border">
                      <?php
                      if($mdlPayment->getAppointmentStatus() == 0){
                        echo "Pending";
                      } elseif($mdlPayment->getAppointmentStatus() == 1){
                        echo "Approved";
                      } else {
                        echo "Declined";
                      }
                      ?>
                    </div>
                  </div>
                  <?php
                  }
                }
                  ?>
                </div>
                <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </table>
		
      </div>


    </div>
  </div>



</div>
<!-- /.container-fluid -->
<?php } ?>