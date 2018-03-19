<?php
	include("../includes/doctor_header.php");
?>

<?php
	$PatientName = "";
	session_start();
	if ( isset($_SESSION['aadhar']) AND isset($_SESSION['paadhar']) ){
		
		include("../includes/credentials.php");

		$mysqli = new mysqli($dbhost, $dbuser, $dbpass);
		
		if ( $mysqli->connect_error ){
	      die("Connection failed");
	    }
	    
	    $mysqli->select_db("harvey_user");
	    
	    $sql = "SELECT * FROM users WHERE id=" . $_SESSION['paadhar'] . " AND isDoctor=0";

	    $result = $mysqli->query($sql);
	    
	    foreach ($result as $variable) {
	    	$PatientName = $variable['Name'];
	    }
	    $mysqli->close();
	}
	else{
		header('Location: ../403.php');
	}
?>

<!-- Doctor middle template -->
<div class="col-sm-9" style="padding-left:20px; padding-right:45px; padding-top:0; padding-bottom:5px;">

	<div class="card">
	  <div class="card-body">
	    <?php echo $PatientName; ?>
	  </div>
	</div> <br>

	<form method="post" action="pr_patient.php">
	  
	  <div class="form-group row">
	    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Weight</label>
	    <div class="col-sm-10">
	    	<input type="text" class="form-control" id="pweight" name="pweight" placeholder="Kgs">
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Height</label>
	    <div class="col-sm-10">
	    	<input type="text" class="form-control" id="pheight" name="pheight" placeholder="Cms">
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Body Mass Index</label>
	    <div class="input-group col-sm-10">
		  <div class="input-group-prepend">
		    <button class="btn btn-outline-secondary" type="button" onclick="calc()">Calculate</button>
		  </div>
		  <script type="text/javascript">
		  		function calc(){
		  			var w = parseInt(document.getElementById("pweight").value);
		  			var h = parseInt(document.getElementById("pheight").value);

		  			h = (h * 1.0) / 100.0;

		  			var r = (w * 1.0) / (h * 1.0 * h);
		  			document.getElementById("bmi").value = r;
		  		}
		  	</script>
		  <input type="text" id="bmi" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" placeholder="">
		</div>
	  </div>


	  <div class="form-group row">
	    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Blood Pressure</label>
	    <div class="col-sm-10">
	    	<input type="text" class="form-control" id="pbp" name="pbp" placeholder="Systole / Diastole">
	    </div>
	  </div>

      <div class="form-group row">
	    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Symptoms</label>
	   	<div class="col-sm-10">
	    	<textarea class="form-control" id="psymptoms" name="psymptoms" rows="2" placeholder="Symptoms as told by patient"></textarea>
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Prescription</label>
	   	<div class="col-sm-10">
	    	<textarea class="form-control" id="prescription" name="prescription" rows="3" placeholder="Prescription"></textarea>
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label">Remarks</label>
	   	<div class="col-sm-10">
	    	<textarea class="form-control" id="remarks" name="remarks" rows="1" placeholder="Remarks"></textarea>
	    </div>
	  </div>

	<!--   <div class="form-group row">
	    <label for="formGroupExampleInput" class="col-sm-2 col-form-label">Refer to</label>
	    <div class="col-sm-10">
	    	<input type="text" class="form-control" id="pbp" name="pbp" placeholder="Enter doctors aadhar">
	    </div>
	  </div> -->

	  <div class="form-group row">
	    <div class="col-sm-10">
	      <button type="submit" class="btn btn-info">Submit</button>
	    </div>
	  </div>
	
	</form>
	<!-- End of form -->
	<!-- Show this patients previous record -->
	<?php
		if ( isset($_SESSION['aadhar']) AND isset($_SESSION['paadhar']) ){

			$dbhost = 'localhost:3306';
			$dbuser = 'root';
			$dbpass = 'revanthsukeesh';

			$mysqli = new mysqli($dbhost, $dbuser, $dbpass);
			
			if ( $mysqli->connect_error ){
		      die("Connection failed");
		    }
		    
		    $mysqli->select_db("harvey_user");

		    $sql = "SELECT * from patient WHERE id=" . $_SESSION['paadhar'];

		    $result = $mysqli->query($sql);

		    	    foreach ($result as $variable) {
	    	?>
	    	<div class="card" style="width: 61rem;">
			  <div class="card-body">
			    <h5 class="card-title">
			    	<p class="text-primary">
				    	<?php
				    		$sql = "SELECT * from users WHERE id=" . $variable['doctorid'];

				    		$hospital_result = $mysqli->query($sql);
				    		foreach ($hospital_result as $aha){
				    			echo $aha['hospital'];
				    		}
				    	?>
			    	</p>
			 	</h5>
			    <h6 class="card-subtitle mb-2 text-muted"> 
			    	
				    	<?php 
				    		$timestamp = $variable['timestampp'];
				    		$delta_time = time() - strtotime($timestamp);
				    		$hours = floor($delta_time / 3600);
				    		$delta_time %= 3600;
				    		$minutes = floor($delta_time / 60);
				    		echo "{$hours} hours {$minutes} minutes Ago";
				    	?>
				    
			    </h6>
			    <p class="card-text">
			    	<p><strong>Weight: </strong> <?php echo $variable['weight']; ?></p>
			    	<p><strong>Height: </strong> <?php echo $variable['height']; ?></p>
			    	<p><strong>Blood Pressure: </strong> <?php echo $variable['bloodp']; ?></p>
			    	<p><strong>Symptoms: </strong> <?php echo $variable['symptoms']; ?></p>
			    	<p><strong>Prescription: </strong> <?php echo $variable['prescription']; ?></p>
			    	<p><strong>Remarks: </strong> <?php echo $variable['remarks']; ?></p>
			    </p>
			    <a href="https://i.kinja-img.com/gawker-media/image/upload/s--V3N4zKnY--/c_scale,fl_progressive,q_80,w_800/17j60rrk30ae6jpg.jpg" class="card-link">X-Ray</a>
			    <a href="#" class="card-link">Another link</a>
			  </div>
			</div>
	    	<?php
	    }
		}
		else{
			header('Location: ../403.php');
		}
	?>

</div>

</div>

<?php
	include("../includes/footer.php");
?>