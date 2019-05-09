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


<p>Edit Employee Complete</p>
<?php 
$editEmpLastName = $_POST['flastname'];
$editEmpFirstName = $_POST['ffirstname'];
$editEmpEmail = $_POST['femail'];
$editEmpPhone = $_POST['fphone'];
$editEmpBirth = $_POST['fbirth'];

$editEmpnumber = $_POST['fempnum'];

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
		$empName = trim($editEmpFirstName) . " " . $editEmpLastName;
		echo "<p>Employee updated: " . $empName . "</p>";
		$empUpdateSQL = "UPDATE employee_list "
			. "SET last_name = '" . $editEmpLastName . "', "
			. 	   "first_name = '" . $editEmpFirstName . "', "
			.	   "email = '" . $editEmpEmail . "', "
			.	   "phone = '" . $editEmpPhone . "', "
			.	   "birth = '" . $editEmpBirth . "' "			
			. "WHERE EmpID = " . $editEmpnumber;
			
		$conn->exec($empUpdateSQL);
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