<?php
	include("../includes/doctor_header.php");
?>


<div class="col-sm-9" style="padding-left:20px; padding-right:45px; padding-top:0; padding-bottom:5px;">
	<?php
		session_start();
		if ( $_SESSION['aadhar'] ){
			
			include("../includes/credentials.php");

			$mysqli = new mysqli($dbhost, $dbuser, $dbpass);
			
			if ( $mysqli->connect_error ){
		      die("Connection failed");
		    }
		    
		    $mysqli->select_db("harvey_user");
		    
		    $sql = "SELECT * from patient WHERE doctorid=" . $_SESSION['aadhar'];

		    $result = $mysqli->query($sql);
		    
		    foreach ($result as $variable) {
	    	?>
	    	<div class="card" style="width: 61rem;">
			  <div class="card-body">
			    <h5 class="card-title">
			    	<p class="text-primary">
				    	<?php
				    		$sql = "SELECT * from users WHERE id=" . $variable['id'];

				    		$hospital_result = $mysqli->query($sql);
				    		foreach ($hospital_result as $aha){
				    			echo $aha['Name'];
				    		}
				    	?>
			    	</p>
			 	</h5>
			    <h6 class="card-subtitle mb-2 text-muted"> 
			    		<?php
			    			echo "" . $aha['id'] . ", ";
			    		?>

				    	<?php 
				    		$timestamp = $variable['timestampp'];
				    		$delta_time = time() - strtotime($timestamp);
				    		$hours = floor($delta_time / 3600);
				    		$delta_time %= 3600;
				    		$minutes = floor($delta_time / 60);
				    		// echo "<strong>"
				    		echo "<i> {$hours} hours {$minutes} minutes Ago</i>";
				    		// echo "</strong>";
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

		}
	?>

	
</div>

</div>
<?php
	include("../includes/footer.php");
?>