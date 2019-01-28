
        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              List of Users Account</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<tr align="right">
						<td colspan="6"><h4>Search for a Customer:</h4>
						<form method="get" action="customer_results.php" enctype="multipart/form-data">
						<input type="text" class="form-control" placeholder="Search by Email" name="query"/>
						<br>
						<input type="submit" class='btn btn-finish btn-primary' name="search" value="Search" />
						</form>
						</td> 
					</tr>

                    <tr align="center">
                      <th>Email</th>
					  <th>Other Details </th>
					  <th>Upload</th>
					  <th>Fee </th>
					  <th>Accept an Upload</th>
					  <th>Deny an Upload</th>

                    </tr>
						
	
	<?php 
	include("includes/db.php");
	
	$get_c = "select * from 
			  user_account
			  inner join bd_upload
			  on user_account.user_email = bd_upload.user_email";
	
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

		$c_img = $row_c['upload_img'];
		$c_details = $row_c['upload_details'];
		$c_status = $row_c['upload_status'];
		$i++;
		$accept_status = "update bd_upload set upload_status='Accepted' where user_email='$c_email'";
		$deny_status = "update bd_upload set upload_status='Denied' where user_email='$c_email'";
	
	?>
	<tr align="center">
		<form method="get" action="accept_upload.php" enctype="">
		<td><input type="text" class="form-control" name="accmail" value="<?php echo $c_email ?>" readonly /></td>
		<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#userModal<?php echo $i ?>">Show</button></td>
		<td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#upModal<?php echo $i ?>">View</button></td>
		<td><input type="text" class="form-control" placeholder="Fee" name="accfee"/></td>
		<td><input type="submit" class='btn btn-info btn-sm' name="accept" value="Accept" /></td>
		</form>
		<td><button class="btn btn-info btn-sm" onclick="window.open('deny_upload.php?user_id=<?php echo $user_id; ?>', '_self')" data-wow-delay="0.4s">Deny</button></td>

	</tr>
		<div class="modal fade" id="userModal<?php echo $i ?>" role="dialog">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		<h4 class="modal-title text-left">Information for: <?php echo $c_name ?></h4>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  
		</div>
		<div class="modal-body">
		  <p>
		  <strong>Name: </strong><br><?php echo $c_name ?> <br>
		  </p>
		  <p>
		  <strong>Email: </strong><br><?php echo $c_email ?>
		  </p>
		  <p>
		  <strong>Contact #: </strong><br><?php echo $c_cont ?>
		  </p>
		  <p>
		  <strong>Gender: </strong><br><?php echo $c_gend ?>
		  </p>
		  <p>
		  <strong>Birthdate: </strong><br><?php echo $c_bd ?>
		  </p>
		  <p>
		  <strong>Address: </strong><br><?php echo $c_add ?>
		  </p>
		</div>
		<div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button> 
         </div>
	  </div>
	</div>
</div>
<div class="modal fade" id="upModal<?php echo $i ?>" role="dialog">
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
		<div class="modal-header">
		<h4 class="modal-title">Information for: <?php echo $c_email ?></h4>
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p>
				<strong>Status: </strong><br><?php echo $c_status ?>
				</p>
				<p>
				<strong>House Plan Image: </strong><br><img src="user_house_plans/<?php echo $c_img ?>" />
				</p>
				<p>
				<strong>User Comments: </strong><br><?php echo $c_details ?>
				</p> 
			</div>
		<div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button> 
         </div>
	  </div>
	</div>
</div>

<?php 
} ?>
</table>
              </div>
            </div>
          </div>

          

        </div>
        <!-- /.container-fluid -->
		
		


