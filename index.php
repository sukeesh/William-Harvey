<?php
	include("includes/header.php");
?>

<?php
  
  include("includes/credentials.php");

  if (isset($_POST['doctoraadhar'])) {
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass);

    if ( $mysqli->connect_error ){
      die("Connection failed");
    }
    $aad = $_POST['doctoraadhar'];
    $isd = 1;

    $mysqli->select_db("harvey_user");
    $sql = "SELECT * FROM users WHERE id=" . $aad . " AND isDoctor=" . $isd;

    $result = $mysqli->query($sql);

    $flag = 0;

    foreach ($result as $value){
      if ( sizeof($value) > 0 ){

        session_start();

        $flag = 1;
        $_SESSION['aadhar'] = $aad;
        
        echo "<script type=\"text/javascript\">location.href = 'doctor/index.php';</script>";
        
      }
    }

    if (!($flag)) echo "<script type=\"text/javascript\"> invokeAlert(); </script>";

  }
  elseif (isset($_POST['patientaadhar'])) {
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass);

    if ( $mysqli->connect_error ){
      die("Connection failed");
    }
    $aad = $_POST['patientaadhar'];
    $isd = 0;

    $mysqli->select_db("harvey_user");
    $sql = "SELECT * FROM users WHERE id=" . $aad . " AND isDoctor=" . $isd;

    $result = $mysqli->query($sql);

    $flag = 0;

    foreach ($result as $value){
      if ( sizeof($value) > 0 ){
        session_start();

        $flag = 1;
        $_SESSION['patient_aadhar'] = $aad;
        
        echo "<script type=\"text/javascript\">location.href = 'patient/index.php';</script>";
      }
    }

    if (!($flag)) echo "<script type=\"text/javascript\"> invokeAlert(); </script>";

  }
  else {
    // Do nothing here!
  }
?>

<div class="row" id="dualogin" style="padding-left:25px; padding-right:25px; padding-top:45px; padding-bottom:25px;">

<div class="col-sm-6" style="padding-left:45px; padding-right:205px; padding-top:0; padding-bottom:5px;">
<form method="post" action="<?php $_PHP_SELF ?>">
  <div class="form-group">
    <label for="exampleInputEmail1"><span class="oi oi-medical-cross"></span> Doctor login</label>
    <input id="doctoraadhar" name="doctoraadhar" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Aadhar Number">
    </div>
 <!--  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div> -->
  <button type="submit" class="btn btn-info">Confirm</button>
</form>
</div>

<div class="col-sm-6" style="padding-left:205px; padding-right:45px; padding-top:0; padding-bottom:5px;">
<form method="post" action="<?php $_PHP_SELF ?>">
  <div class="form-group">
    <label for="exampleInputEmail1"><span class="oi oi-person"></span> Patient login</label>
    <input id="patientaadhar" name="patientaadhar" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Enter Aadhar Number">
    </div>
 <!--  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div> -->
  <button type="submit" class="btn btn-info">Confirm</button>
</form>

</div>

</div>


<?php
	include("includes/footer.php");
?>