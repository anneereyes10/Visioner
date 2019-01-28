<form method="get" action="build.php?plans" enctype="multipart/form-data">
<h4 class="info-text"> Let's start with the basic information.</h4>
		<div class="col-sm-5 col-sm-offset-1">
			
			<div class="form-group">
				<label> Number of Bedroom</label>
				<select id="nobedroom" name="no_bedrooms" class="selectpicker show-tick form-control" required>
						<option>  </option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						
					</select>
			</div>
			
			<div class="form-group">
				<label>Number of Bathroom</label>
				<select id="nobathroom" name="no_bathrooms" class="selectpicker show-tick form-control" required>
						<option>  </option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						
					</select>
			</div> 
		</div>
		
		
		<div class="col-sm-5">
		
		<div class="form-group">
				<label>Budget</label>
				<select id="basic" class="selectpicker show-tick form-control" name="price_range" required>
						<option>  </option>
						<option value="1000000 AND 5000000">PHP 1,000,000.00 - 5,000,000.00</option>
						<option>PHP 6,000,000.00 - 15,000,000.00</option>
						<option>PHP 16,000,000.00 - 25,000,000.00</option>  
					</select>
			</div> 
		
			<div class="col-sm-6 col-sm-offset-3">
		<button class="navbar-btn nav-button wow bounceInRight login" onclick="window.open('build.php?upload', '_self')" data-wow-delay="0.4s">Have your own House Plan? Upload it here!</button>
		</div>

			
		</div>
		
										

<input type="submit" class='btn btn-finish btn-primary' name="search" value="Search for a Plan" />
</form>