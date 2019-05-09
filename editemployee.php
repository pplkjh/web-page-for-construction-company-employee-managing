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
  <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<h1>Edit Employee</h1>
<?php 
$editEmpnumber = $_GET['empnum'];

// do some db stuff here

require_once('dbcreds.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	
	$empSQL = 'SELECT * from employee_list WHERE EmpID = ' . $editEmpnumber;
	
	$STH = $conn->query($empSQL);
	 
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	
	$empFound = false;
	if($emprow = $STH->fetch()) {
		$empFound = true;
		$empLastName = $emprow['last_name'];
		$empFirstName = $emprow['first_name'];
		$empEmail = $emprow['email'];
		$empPhone = $emprow['phone'];
		$empBirth = $emprow['birth'];
		$ActiveEmp = "";
		if($emprow['EmpActive']) $ActiveEmp=" Checked ";
		}
    }
catch(PDOException $e)
    {
    echo "DB failed: " . $e->getMessage();
    }

if($empFound) {
?>
<h2 style="font-size:15;" align="center"> <font color="red">Please enter the following employee information:</font></h2>

<form action="viewallemployees_datatables.php" method="post">
  Last name:<br>
  <input type="text" name="flastname" value="<?php echo $empLastName; ?>" >
  <br>
  First name:<br>
  <input type="text" name="ffirstname" value="<?php echo $empFirstName; ?>" >
  <br>
  Email Address:<br>
  <input type="text" name="femail" value="<?php echo $empEmail; ?>" >
  <br>
  Phone:<br>
  <input type="text" name="fphone" value="<?php echo $empPhone; ?>" >
  <br>
  Birth date:<br>
  <input type="text" name="fbirth" value="<?php echo $empBirth; ?>" >
  <br> <br> 
  Active Employee
  <input type="checkbox" name="factiveemployee" value="" <?php echo $ActiveEmp; ?>>
  <br><br>
  <input type="hidden" name="fempnum" value="<?php echo $editEmpnumber; ?>">
  <input type="submit" name="editemployeenow" value="Submit">
</form> 
<?php 
} // end if($empFound) block
?>
  <a href="viewallemployees_datatables.php" class="list-group-item">
    <button type="button" class="btn btn-info">
    <i class="fas fa-address-book"></i></span> back to Employee Roster
    </button></a>
<br><br>
<a href="mainmenu.php">Return to the menu</a>
	<br><br>
	
</body>
</html>