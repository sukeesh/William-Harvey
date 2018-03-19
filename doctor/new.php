<?php
	include("../includes/doctor_header.php");
?>

<?php
  session_start();
  if (isset($_SESSION['aadhar'])){
    
    include("../includes/credentials.php");
    
    if ( isset($_POST['paadhar']) ){
      $mysqli = new mysqli($dbhost, $dbuser, $dbpass);

      if ( $mysqli->connect_error ){
        die("Connection failed");
      }

      $aad = $_POST['paadhar'];
      $isd = 0;

      $mysqli->select_db("harvey_user");
      $sql = "SELECT * FROM users WHERE id=" . $aad . " AND isDoctor=" . $isd;

      $result = $mysqli->query($sql);

      $flag = 0;

      foreach ($result as $value){
        if ( sizeof($value) > 0 ){

          $flag = 1;
          $_SESSION['paadhar'] = $aad;
          
          echo "<script type=\"text/javascript\">location.href='patient.php';</script>";
          
        }
      }

      if (!($flag)) echo "<script type=\"text/javascript\"> invokeAlert(); </script>";

    }
    else{
      // Do Nothing
    }
  }
  else{
    // Show 403!
    header('Location: ../403.php');
  }
?>

<!-- Doctor middle template -->
<div class="col-sm-9" style="padding-left:20px; padding-right:45px; padding-top:0; padding-bottom:5px;">
  <?php
   if ( $_SESSION['patient_update_sucess'] ){
    echo "<div class=\"alert alert-success\" role=\"alert\"> Patient consultation updated successfully! </div>";
    unset($_SESSION['patient_update_sucess']);
   }
  ?>
	<form method="post" action="<?php $_PHP_SELF ?>">
	  <div class="form-group">
	  <input type="text" class="form-control" name="paadhar" id="paadhar" aria-describedby="emailHelp" placeholder="Enter Patient's Aadhar Number">
	    </div>
	  <button type="submit" class="btn btn-info">Confirm</button>
	</form>
</div>
</div>

<?php
	include("../includes/footer.php");
?>