<?php

// The first line reads the raw post input that was sent to the server.
// Note that we are expecting a JSON array, not form fields.
$postdata = file_get_contents("php://input");

//echo "Here is what was posted: " . $postdata;

// debug code -- send whatever was posted right back to the client
//    so that it can be viewed if logged by the Android app

//{ "account_email":"someone@somewhere.com", "account_password":"mypassword"}

// parse the JSON string into an associative array called parsedJSON
$parsedJSON = json_decode($postdata, true);
// bail out if it's not valid JSON data
if($parsedJSON==null) exit;
// bail out if they did not send an email address value
if(!array_key_exists('account_email', $parsedJSON)) exit; // $parsedJSON['account_email'] = "someone@somewhere.com"

// bail out if they did not send a password value
if(!array_key_exists('account_password', $parsedJSON)) exit;

// bail out if they did not send a search date value
if(!array_key_exists('search_date', $parsedJSON)) exit;

// note: this is where you would include the necessary database code to
// lookup the credentials that were passed from the application
$dbLookupSuccess = 0;

	require_once('dbcreds.php');

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//echo "Connected successfully"; 

	// compute the md5 hash of the password the user entered
	$tmpLoginEmail = $parsedJSON['account_email'];
	$md5LoginPassword = md5($parsedJSON['account_password']);
	$tmpSearchDate = $parsedJSON['search_date'];
	
	
	$STH = $conn->prepare('SELECT * from employee_list
	WHERE email=:param_email AND Password=:param_password');
	$STH->bindParam(':param_email', $tmpLoginEmail);
	$STH->bindParam(':param_password', $md5LoginPassword);	
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_ASSOC);
	$STH->execute();
	
	if($emprow = $STH->fetch()) {
		 //yes, they are authenticated
		$dbLookupSuccess = 1;

		$STH1 = $conn->prepare('SELECT First_name, SUM(Hours)
		FROM Labor_hours
		WHERE Email=:param_email AND Date=:param_date');
		$STH1->bindParam(':param_email', $tmpLoginEmail);
		$STH1->bindParam(':param_date', $tmpSearchDate);	
		$STH1->setFetchMode(PDO::FETCH_ASSOC);
		$STH1->execute();
		if($emprow1 = $STH1->fetch()) {
		$sumHour = $emprow1['SUM(Hours)'];
		$empfname = $emprow1['First_name'];
		
		$arr = array( "Count_Value" => $sumHour,
						"userfname"=> $empfname );

		}
	}
} // end try

catch(PDOException $e)
	{
	echo $e;
	echo "Wrong Access, Go back to the last page";
	die();

} // end catch

 
// echo the application data in json format
if($dbLookupSuccess>0) {
	echo json_encode($arr);  // {"Count_Value": "12"}
	//echo "labor hours: " . json_encode($sumHour);
}
 else {
	echo "INVALIDCREDENTIALS";
}

// See more at: http://www.semurjengkol.com/populating-android-listview-with-json-based-data-fetched-from-mysql-server-using-php/#sthash.Cm5BFS6C.dpuf
?>
