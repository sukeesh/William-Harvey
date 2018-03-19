<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" integrity="sha256-BJ/G+e+y7bQdrYkS2RBTyNfBHpA9IuGaPmf9htub5MQ=" crossorigin="anonymous" />
<link rel="stylesheet" type="text/css" href="../assets/app.css">
<link rel="shortcut icon" href="https://i.imgur.com/EGJunVs.png"/>

<title> Harvey - Health and Family Welfare </title>

</head>
<body>

<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <span class="oi oi-pulse"></span>
    Harvey
  </a>
  Doctor Dashboard

  <form method="post" action="logout.php">
    <input type="hidden" id="logout" name="logout" value="signout">
    <button type="submit" class="btn btn-danger">Logout</button>
  </form>

</nav>

<div id="msgdiv"></div>
<script type="text/javascript">
  function invokeAlert(){
    document.getElementById("msgdiv").innerHTML = "<div class=\"alert alert-danger\" role=\"alert\"> Invalid entry! </div>";
  }
</script>

<div class="row" style="padding-left:25px; padding-right:25px; padding-top:45px; padding-bottom:25px;">

  <div class="col-sm-3" style="padding-left:45px; padding-right:20px; padding-top:0; padding-bottom:5px;">

    <div class="btn-group-vertical">
      <p>
        <a href="../doctor/new.php" class="btn btn-info">
          <span class="glyphicon glyphicon-plus"></span> New Patient 
        </a>

        <a href="../doctor/past.php" class="btn btn-info">
          <span class="glyphicon glyphicon-plus"></span> Past Patient
        </a>

        <a href="../doctor/payouts.php" class="btn btn-info">
          <span class="glyphicon glyphicon-plus"></span> Payouts
        </a>
      </p>

    </div>

  </div>