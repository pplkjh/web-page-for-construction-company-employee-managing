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

<p>Edit Job</p>
<?php 
$editjobnumber = $_GET['Jobnum'];

// do some db stuff here

require_once('dbcreds.php');

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	
	$empSQL = 'SELECT * from employee_list WHERE EmpID = ' . $editjobnumber;
	
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
<p>Please enter the following employee information:</p>

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
  <input type="hidden" name="fempnum" value="<?php echo $editjobnumber; ?>">
  <input type="submit" name="editemployeenow" value="Submit">
</form> 
<?php 
} // end if($empFound) block
?>
<br><br>
<p><a href="viewallemployees_datatables.php">Return to the Employee Roster</a></p>
<p><a href="mainmenu.php">Return to the menu</a></p>
	
</body>
</html>