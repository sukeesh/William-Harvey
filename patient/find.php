<?php
	include("../includes/patient_header.php");
?>

<?php
	session_start();
	if (isset($_SESSION['patient_aadhar'])){
		echo "Welcome " . $_SESSION['patient_aadhar'];
	}
	else{
		// Show 403!
		header('Location: ../403.php');
	}
?>

<?php
	include("../includes/footer.php");
?>