<?php
session_start();

if(isset($_POST['femailaddress'])) $tmpLoginEmail = $_POST['femailaddress'];
if(isset($_POST['fpassword'])) 	  $tmpLoginPassword = $_POST['fpassword'];

if(!$_SESSION['ValidUser']) {

	// do some db stuff here

	require_once('dbcreds.php');

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully"; 

		// compute the md5 hash of the password the user entered
		$md5LoginPassword = md5($tmpLoginPassword);
		
		$STH = $conn->prepare('SELECT * from employee_list
		WHERE email=:param_email AND Password=:param_password');
		$STH->bindParam(':param_email', $tmpLoginEmail);
		$STH->bindParam(':param_password', $md5LoginPassword);	
		 
		# setting the fetch mode
		$STH->setFetchMode(PDO::FETCH_ASSOC);

		$recordsFound = 0;
		$STH->execute();
		
		//echo "email: " . $tmpLoginEmail . "<br>";
		//echo "raw password: " . $tmpLoginPassword . "<br>";
		//echo "md5 password: " . $md5LoginPassword . "<br>";
		
		
		while($emprow = $STH->fetch()) {
			// yes, they are authenticated
			$_SESSION['ValidUser'] = true;
			$_SESSION['UserFirstName'] = $emprow['first_name'];
			$recordsFound = $recordsFound + 1;
		}
		
		//echo "recordsFound: " . $recordsFound . "<br>";
		//die();
		
		// if there were no matching entries in the DB, give 'em the boot
		if($recordsFound == 0 ) {
			// send 'em back to the login form
			header('Location: https://ohseok.000webhostapp.com/login.php');
			die();
		}
	} // end try
	catch(PDOException $e)
		{
		//echo "DB failed: " . $e->getMessage();
		// send 'em back to the login form
		header('Location:https://ohseok.000webhostapp.com/login.php');
		die();

	} // end catch
	
} // end  if not session $validuser


?><!DOCTYPE html>
<html>
<head>
<body style="background-color:powderblue;">
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<h1><strong> &nbsp; Welcome to OCC [<?php echo $_SESSION['UserFirstName']; ?> ] ! </strong></h1>
<br>

<!--
<ul class="list-group">
  <li class="list-group-item"><a href="viewallemployees_datatables.php">Manage Employee Roster</a></li>
  
  <li class="list-group-item"><a href="signout.php">Sign Out</a></li>
</ul>
-->

<div class="list-group">
  <a href="viewallemployees_datatables.php" class="list-group-item">
    <button type="button" class="btn btn-info">
    <i class="fas fa-address-book"></i></span> Manage Employee Roster
    </button></a>
 
  <a href="jobtable.php" class="list-group-item">
    <button type="button" class="btn btn-info">
    <i class="far fa-building"></i></span> Job List
    </button></a>
  
  
  <a href="signout.php" class="list-group-item">
    <button type="button" class="btn btn-info">
    <i class="fas fa-sign-out-alt"></i></span> Sign-out
    </button></a></a>
</div>

</body>
</html>