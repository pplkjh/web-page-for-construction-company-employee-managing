<?php
session_start();
if(!$_SESSION['ValidUser']) {
	// send 'em back to the login form
	header('Location: https://ohseok.000webhostapp.com/login.php');
	die();
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
<br>
<h2><strong>&nbsp;&nbsp;Job list</strong></h2>
  <br>  <br>
<table id="employeetable" class="display" cellspacing="0" >
<thead><tr>
<th>Job Name</th>
<th>Customer ID</th>
<th>Start Date</th>
<th>End Date</th>
<th>Job status</th>

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
	
	$STH = $conn->query('SELECT * from Jobs');
	 
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	 
	while($emprow = $STH->fetch()) {
		echo "<tr><td>" 
			. $emprow['JobName'] . "</td><td>" 
			. $emprow['JobCustomerID'] ."</td><td>" 
			. $emprow['JobStartDate'] ."</td><td>" 
			. $emprow['JobEndDate'] ."</td><td>" 	
			. ($emprow['JobComplete'] == '1' ? 'Complete' : 'In progress')
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