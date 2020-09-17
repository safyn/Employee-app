<!--
Name : dob.php
Purpose : File that retrieves data from the database and displays the welcome message
Author: Krzysztof Bas 
Date: 01/04/2020
-->

<?php

include 'db.inc.php'; // include database connection 
$current_date = date("d-m");  // Assign todays day and month into a variable
$d = date("l,jS \of F, Y   h:i a"); // assign and format todays date and time into a variable

// Select name,surname and date of birth for the employee that logs in.
$sql2 = "Select dob,firstName,lastName from Employee where login='$_SESSION[user]'";
//Display a message if query execution failed
if (!$result = mysqli_query($con, $sql2)) {
    echo " Error" . mysqli_error($con);
}
// Fetch result of the query execution into a variables
while ($row = mysqli_fetch_array($result)) {
    $dob = $row['dob'];
    $name = $row['firstName'];
    $surname = $row['lastName'];
}

// Parse and format date of birth retrieved from the database
$dob_date  = date("d-m", strtotime($dob));
// Compare employess date of birth with todays date 
if ($current_date == $dob_date) {
    // If todays is employees birthday display a happy birthday message 
    echo "<h1>Happy Birthday $_SESSION[user] !!!</h1>";
}
// Display welcome message
echo "<h1>You have logged as: " . $_SESSION['user'] .  "</h1>";
echo "<h1>Your Name: " . $name . " " . $surname . "</h1>";
echo "<h1>Curent date: " . $d . "</h1>";

?>
<!-- End of php tag -->