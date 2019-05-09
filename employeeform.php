<?php

session_start();

if(!$_SESSION['ValidUser']) {
	// send 'em back to the login form
	header('Location: https://ohseok.000webhostapp.com/login.php');
	die();
}



?><!DOCTYPE html>
<html>
<head>
<body style="background-color:powderblue;">

<link rel="stylesheet" type="text/css" href="mystyles.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
  <body>

<h2><strong> &nbsp;Please enter the following employee information:</strong></h2>
 <br><br> 
<form action="viewallemployees_datatables.php" method="post">
  Last name:<br>
  <input type="text" name="flastname" >
  <br> 
  First name:<br>
  <input type="text" name="ffirstname" >
  <br>
  Email address:<br>
  <input type="text" name="femail" >
  <br>
  phone:<br>
  <input type="text" name="fphone" >
  <br>
  Date of birth:<br>
  <!-- <input type="text" name="fbirth" > -->
  <input type="date" name="fbirth" id="date" >
  <br>
  Password:<br>
  <input type="password" name="fpw" >
  <br>
  
  <br>
  <input type="submit" name="addnewemployee" value="Submit">
  &nbsp;
  <input type="reset" value="Reset!">
  <br>
  <br>
</form> 

<br><br>

  <a href="viewallemployees_datatables.php" class="list-group-item">
    <button type="button" class="btn btn-info">
    <i class="fas fa-address-book"></i></span> back to Employee Roster
    </button></a>
<br><br>
<a href="mainmenu.php">Return to the menu</a>
	<br><br>
	
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>