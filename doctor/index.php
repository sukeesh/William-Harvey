<?php
	include("../includes/doctor_header.php");
?>

<div class="col-sm-9" style="padding-left:20px; padding-right:45px; padding-top:0; padding-bottom:5px;">

	<?php
		session_start();
		if (isset($_SESSION['aadhar'])){

			include("../includes/credentials.php");

			$mysqli = new mysqli($dbhost, $dbuser, $dbpass);
			if ( $mysqli->connect_error ){
		      die("Connection failed");
		    }
		    $mysqli->select_db("harvey_user");
		    $sql = "SELECT * FROM users WHERE id=" . $_SESSION['aadhar'] . " AND isDoctor=1";

		    $result = $mysqli->query($sql);
		    
		    foreach ($result as $variable) {
		    	?>
		    	<div class="p-3 mb-2 bg-success text-white">
		    	<?php
		    		echo "Welcome Dr. " . $variable['Name'];
		    	?>
		    	</div>
		    	<?php
		    }
		}
		else{
			// Show 403!
			header('Location: ../403.php');
		}
	?>
</div>

<?php
	include("../includes/footer.php");
?>