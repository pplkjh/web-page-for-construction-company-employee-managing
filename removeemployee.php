<?php

session_start();

if(!$_SESSION['ValidUser']) {
	// send 'em back to the login form
	header('Location: https://ohseok.000webhostapp.com/login.php');
	die();
}

?><!DOCTYPE html>
<html>
<body>


<p>Confirm Delete Employee</p>
<?php 
$delEmpnumber = $_POST['Fempnum'];

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
		$empName = trim($emprow['EmpFirstname']) . " " . $emprow['EmpLastname'];
		echo "<p>Employee deleted: " . $empName . "</p>";
		$empDeleteSQL = 'DELETE from employee_list WHERE EmpID = ' . $delEmpnumber;
		$conn->exec($empDeleteSQL);
	}

    }
catch(PDOException $e)
    {
    echo "DB failed: " . $e->getMessage();
    }


?>

<br><br>
<p><a href="viewallemployees_datatables.php">Return to the Employee Roster</a></p>
<p><a href="mainmenu.php">Return to the menu</a></p>
	
</body>
</html>