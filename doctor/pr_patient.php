<?php

	session_start();
	if ( isset($_POST['pweight']) AND isset($_POST['pheight']) AND isset($_POST['pbp']) AND isset($_POST['psymptoms']) AND isset($_POST['prescription']) AND isset($_POST['remarks']) ){
		
		include("../includes/credentials.php");
		
		$mysqli = new mysqli($dbhost, $dbuser, $dbpass);
		
		if ( $mysqli->connect_error ){
	      die("Connection failed");
	    }
	    
	    $mysqli->select_db("harvey_user");

	    $patient_id = $_SESSION['paadhar'];
	    $weight = $_POST['pweight'];
	    $height = $_POST['pheight'];
	    $bloodp = $_POST['pbp'];
	    $symptoms = $_POST['psymptoms'];
	    $prescription = $_POST['prescription'];
	    $doctor_id = $_SESSION['aadhar'];
	    $remarks = $_POST['remarks']; 

	    $sql = "INSERT INTO patient (id, weight, height, bloodp, symptoms, prescription, doctorid, remarks) VALUES ('" . $patient_id . "', '" . $weight . "', '" . $height . "', '" . $bloodp . "', '" . $symptoms . "', '" . $prescription . "', '" . $doctor_id . "', '" . $remarks . "')";

	    echo "\n" . $sql . "\n";

	    $result = $mysqli->query($sql);

	    if ( $result ){
	    	unset($_SESSION['paadhar']);
	    	$_SESSION['patient_update_sucess'] = 1;
	    	header('Location: new.php');
	    }
	    else{
	    	echo "\nError!\n";
	    }

	}
	else{
		echo "Error!!";
	}

?>