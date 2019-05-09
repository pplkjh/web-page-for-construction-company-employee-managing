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
<link rel="stylesheet" type="text/css" href="mystyles.css">
</head>
<body>
<p>Thanks for submitting that employee!</p>
<?php 
$tLastName = $_POST["flastname"];
$tFirstName = $_POST["ffirstname"];
$temail = $_POST["femail"];
$tphone = $_POST["fphone"];
$tbirth = $_POST["fbirth"];
$tpw = md5($_POST["fpw"]);

echo "Last Name: " . $tLastName . "<BR>";
echo "First Name: "	. $tFirstName . "<BR>";
echo "e-mail address: " . $temail . "<BR>";
echo "phone: "	. $tphone . "<BR>";
echo "Date of birth: " . $tbirth . "<BR>";

$servername = "localhost";
$dbname = "id4413815_ohseokdata";
$username = "id4413815_oshin";
$password = "qwer1232";


try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
	
	$vsql = "INSERT INTO employee_list (last_name, first_name, email, phone, birth)
    VALUES ('$tLastName', '$tFirstName', '$temail', '$tphone', '$tbirth', '$tpw')";
	
    $conn->exec($vsql);
	
    echo "Employee added successfully";	
    }
catch(PDOException $e)
    {
    echo "DB failed: " . $e->getMessage();
    }

?>
<br><br>
 <p>See all the Employee list</p>
	<form action="viewallemployees.php">
	<input type="submit" value="Employee List">
	</form> 

<br>
<a href="mainmenu.php">Return to the menu</a>
	
<br><br><br><br>
</body>
</html>