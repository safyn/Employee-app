<!--
Name : logout.php
Purpose : File that updates a database record with logout time and destroys the existing session
Author: Krzysztof Bas 
Date: 06/04/2020
-->

<?php // Start of php tag

include 'db.inc.php'; 	// include connection file
include 'session.php';	// Chceck if session exists


$today = date("Y-m-d");       // todays date
$logoutTime = date("H:i:s");	// logout time
$session = $_SESSION['user'];
//echo "<br>" . $session;
// Query that updates LoginReport by adding logout time to the table entry, where session exist and was created today and logout time is null
$sql = "Update LoginReport set logoutTime = '$logoutTime' Where employeeID = '$_SESSION[id]' and loginDate = '$today' and logoutTime is null ";

// execute query and display error if query is not executed succesfully 
if (!$result = mysqli_query($con, $sql)) {
	echo " Error while updating the database" . mysqli_error($con);
} else { // Query executed succesfully - clear session variables, remove session and redirect to the login page

	// remove all session variables
	session_unset();

	// destroy the session
	session_destroy();
	// redirec to the login page
	header('Location: https://c00238768.candept.com/Employee/index.php');
		exit;

}
mysqli_close($con);  // close connection

?>
<!-- Close php tag -->