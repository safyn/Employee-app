<!--
Name : form.css
Purpose : Display select tag with name and surname of the Employee
Author: Krzysztof Bas 
Date: 07/04/2020
-->

<?php // Start of php tag
include 'db.inc.php'; // database connection

//Query that selects Employee table
$sql = "SELECT * from Employee ";

//Execute Query, display error message if execution is not succesfull
if (!$result = mysqli_query($con, $sql)) {
    die('Error in querying the database' . mysqli_error($con));
}

// Output select tag 
echo "<select name = 'listbox' id='listbox' onclick = 'populateEmployee()' ><br>";

//Fetch result of the query into php variables
while ($row = mysqli_fetch_array($result)) {
    $id = $row['employeeID'];
    $fname = $row['firstName'];
    $lname = $row['lastName'];
    $dob = $row['dob'];
    $address = $row['Address'];
    $phone = $row['phoneNumber'];
    $job = $row['jobTitle'];
    $login = $row['login'];

    // Assing all the variables into one that will be assigned into html
    $content = "$id,$fname,$lname,$dob,$address,$phone,$job,$login";

    echo "<option value = '$content' > $fname $lname </option>";
}

echo "</select>"; // Close Select tag

mysqli_close($con); // Close connection


?>
<!-- End of php tag-->