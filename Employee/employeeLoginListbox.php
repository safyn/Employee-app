<!--
Name : form.css
Purpose : Display select tag with name and surname of the Employee
Author: Krzysztof Bas 
Date: 07/04/2020
-->

<?php
include 'db.inc.php'; // database connection

//Query that selects Employee table
$sql = "SELECT * from Employee ";

//Execute Query, display error message if execution is not succesfull
if (!$result = mysqli_query($con, $sql)) {
    die('Error in querying the database' . mysqli_error($con));
}

// Display select tag 
echo "<select name = 'listbox' id='listbox' onclick='login()' onchange='this.form.submit()' ><br>";

//Assign tables row values into the variables
while ($row = mysqli_fetch_array($result)) {
    $id = $row['employeeID'];
    $fname = $row['firstName'];
    $lname = $row['lastName'];



    $constant = "$id";

    echo "<option value = '$constant' selected> $fname $lname </option>";
}

echo "</select>"; // Close Select tag

mysqli_close($con);// Close connection
