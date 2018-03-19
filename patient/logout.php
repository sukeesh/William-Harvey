<?php
	if (isset($_POST['logout'])){
		session_start();
		unset($_SESSION['aadhar']);
		session_destroy();
		header('Location: ../index.php');
	}
	else{
		// Show 404!
		header('Location: ../404.php');
	}
?>