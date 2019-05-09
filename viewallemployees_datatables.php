<?php

session_start();

if(!$_SESSION['ValidUser']) {
	// send 'em back to the login form
	header('Location: https://ohseok.000webhostapp.com/login.php');
	die();
}

// ===============================================

//are we just arriving from tha add new employee form?
if(isset($_POST['addnewemployee'])){
	//add new employee to the employees table in the DB
	

$tLastName = $_POST["flastname"];
$tFirstName = $_POST["ffirstname"];
$temail = $_POST["femail"];
$tphone = $_POST["fphone"];
$tbirth = $_POST["fbirth"];
$tpw = md5($_POST["fpw"]);

	 //do some db stuff here

require_once('dbcreds.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	
	$STH = $conn->Prepare("INSERT INTO employee_list (last_name, first_name, email, phone, birth,Password)
	value (:lname, :fname, :ema, :pho, :bir, :pw)");

	$STH->bindParam(':lname', $tLastName);
	$STH->bindParam(':fname', $tFirstName);	
	$STH->bindParam(':ema', $temail);
	$STH->bindParam(':pho', $tphone);
	$STH->bindParam(':bir', $tbirth);
	$STH->bindParam(':pw' , $tpw);
	
	// echo $vsql;
	
    // execute the PDO prepared statement
	$STH->execute();
	
	$tmpFullname = trim($tFirstName) . " " . $tLastName;
	echo "Employee $tmpFullname added successfully<br><br>";
    }
catch(PDOException $e)
    {
    echo "DB failed: " . $e->getMessage();
    }
}
///==================================

//are we just arriving from tha add delete employee form?
if(isset($_POST['deleteemployeenow'])) {
	// delete employee from the employees table in the DB

	$delEmpnumber = $_POST['Fempnum'];

// do some db stuff here

require_once('dbcreds.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	
	$STH = $conn->Prepare("SELECT * from employee_list WHERE EmpID = :empid");
	
	$STH->bindParam(':empid', $delEmpnumber);
	
	// execute the PDO prepared statement
	$STH->execute();
	
	
	//$empSQL = 'SELECT * from employee_list WHERE EmpID = ' . $delEmpnumber;
	//$STH = $conn->query($empSQL);
	 
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	
	$empFound = false;
	if($emprow = $STH->fetch()) {
		$empFound = true;
		$empName = trim($emprow['first_name']) . " " . $emprow['last_name'];
		echo "<p>employee deleted: " . $empName . "</p>";
		$STH = $conn->Prepare("delete from employee_list where EmpID = :empid");
		$STH->bindParam(':empid', $delEmpnumber);
		$STH->execute();

		}
	}
catch(PDOException $e) {
    echo "DB failed: " . $e->getMessage();
    }

}
//==========================================

// are we just arriving from the Edit Employee form?
if(isset($_POST['editemployeenow'])) {
	
	$editEmpLastName = $_POST['flastname'];
	$editEmpFirstName = $_POST['ffirstname'];
	$editEmpEmail = $_POST['femail'];
	$editEmpPhone = $_POST['fphone'];
	$editEmpBirth = $_POST['fbirth'];
	$editActiveStatus = (isset($_POST['factiveemployee']) ? "1" : "0");
	
	$editEmpnumber = $_POST['fempnum'];
	//var_dump($_POST);  //see what variable been passed by POST;



	// do some db stuff here

require_once('dbcreds.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	
	$STH = $conn->Prepare("SELECT * from employee_list WHERE EmpID = :empid");
	
	$STH->bindParam(':empid', $editEmpnumber);
		// execute the PDO prepared statement
	$STH->execute();

		# setting the fetch mode
		$STH->setFetchMode(PDO::FETCH_ASSOC);
		
		$empFound = false;
		if($emprow = $STH->fetch()) {
			$empFound = true;
			$empName = trim($editEmpFirstName) . " " . $editEmpLastName;
			echo "<p>Employee updated: " . $empName . "</p>";

			$STH = $conn->Prepare("UPDATE employee_list 
				 SET last_name = :emplast, 
				     first_name = :empfirst, 
				     email = :empemail,
					 phone = :pho,
					 birth = :bir,
					 EmpActive = :empstatus
				     WHERE EmpID = :empid");
			$STH->bindParam(':empid', $editEmpnumber);
			$STH->bindParam(':emplast', $editEmpLastName);
			$STH->bindParam(':empfirst', $editEmpFirstName);
			$STH->bindParam(':empemail', $editEmpEmail);
			$STH->bindParam(':pho', $editEmpPhone);
			$STH->bindParam(':bir', $editEmpBirth);
			$STH->bindParam(':empstatus', $editActiveStatus);

			
			
			// execute the PDO prepared statement
			$STH->execute();
		}

	}
	catch(PDOException $e) {
		echo "DB failed: " . $e->getMessage();
	}

}


// ===============================================


?><!DOCTYPE html>
<html>
<head>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
<link rel="stylesheet" type="text/css" href="mystyles.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js">
	</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
	</script>

<script type="text/javascript" class="init">
	

$(document).ready(function() {
	$('#employeetable').DataTable();
} );


</script>
</head>
<body>
  <br>  <br>
<a href="employeeform.php"><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Add New Employee"><i class="fas fa-user-plus"></i></button></a><br />
<h2><strong>Employee Roster</strong></h2>
  <br>  <br>
<table id="employeetable" class="display" cellspacing="0" >

<thead><tr>
<th>&nbsp;</th>
<th>Last Name</th>
<th>First Name</th>
<th>e-mail address</th>
<th>Phone</th>
<th>Date of birth</th>
<th>Employee status</th>

</tr></thead>
<tbody>
<?php 


// do some db stuff here

require_once('dbcreds.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	
	$STH = $conn->query('SELECT * from employee_list');
	 
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	 
	while($emprow = $STH->fetch()) {
		$deleteLink = "<a href='deleteemployee.php?empnum=" . $emprow['EmpID'] ."' data-toggle="tooltip" data-placement="top" title="Add New Employee">";
		$editLink = "<a href='editemployee.php?empnum=" . $emprow['EmpID'] ."'>";
		echo "<tr><td>" . $deleteLink . "<i class='fas fa-ban'></i></a>&nbsp;&nbsp;&nbsp;" 
			. $editLink . "<i class='far fa-edit'></i></a></td><td>" 
			. $emprow['last_name'] . "</td><td>" 
			. $emprow['first_name'] ."</td><td>" 
			. $emprow['email'] ."</td><td>" 
			. $emprow['phone'] ."</td><td>" 	
			. $emprow['birth'] ."</td><td>" 	
			. ($emprow['EmpActive'] == '1' ? 'Active' : 'inactive')
			. "</td></tr>";
	}

    }
catch(PDOException $e)
    {
    echo "DB failed: " . $e->getMessage();
    }

?>
</tbody>
</table>
<br><br>
<a href="mainmenu.php">Return to the menu</a>
	
</body>
</html>