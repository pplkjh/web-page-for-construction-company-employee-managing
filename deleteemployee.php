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


<h1><strong>Delete Employee</strong></h1>
<br><br>

<?php 
$delEmpnumber = $_GET['empnum'];

// do some db stuff here

require_once('dbcreds.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	
	$empSQL = 'SELECT * from employee_list WHERE EmpID = ' . $delEmpnumber;
	
	$STH = $conn->query($empSQL);
	 
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	
	$empFound = false;
	if($emprow = $STH->fetch()) {
		$empFound = true;
		$empName = trim($emprow['first_name']) . " " . $emprow['last_name'];
		echo "<h2>Are you sure to delete: " . $empName . "</h2><br>";
	}

    }
catch(PDOException $e)
    {
    echo "DB failed: " . $e->getMessage();
    }

if($empFound) {
?>
<form action="viewallemployees_datatables.php" method="POST">
	<input type="hidden" name="Fempnum" value="<?php echo $delEmpnumber; ?>">
	<input type="submit" name="deleteemployeenow" value="Delete Now">
</form>
<?php 
} // end if($empFound) block
?>

<br><br>

  <a href="viewallemployees_datatables.php" class="list-group-item">
    <button type="button" class="btn btn-info">
    <i class="fas fa-address-book"></i></span> back to Employee Roster
    </button></a>
<br><br>
<a href="mainmenu.php">Return to the menu</a>
	<br><br>
	
</body>
</html>