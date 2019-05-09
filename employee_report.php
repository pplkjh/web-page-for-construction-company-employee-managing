<?php

session_start();

if(!$_SESSION['ValidUser']) {
	// send 'em back to the login form
	header('Location: https://ohseok.000webhostapp.com/login.php');
	die();
}

// ===============================================

// report title should be "Employee Roster"
	 //do some db stuff here
	 

require_once('dbcreds.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	
	$STH = $conn->query('select * from employee_list');
	
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	
	while ($emprow = $STH->fatch()) {
	echo "<tr><td>" . $deleteLink . "<i class='fas fa-ban'></i></a>&nbsp;&nbsp;&nbsp;&nbsp;" 
			. $editLink . "<i class='far fa-edit'></i></a></td><td>" 
			. $emprow['last_name'] . "</td><td>" 
			. $emprow['first_name'] ."</td><td>" 
	}
	}
	catch(PDOException $e)
    {
    echo "DB failed: " . $e->getMessage();
    }

?>