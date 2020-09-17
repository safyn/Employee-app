<!--
Name : session.php
Purpose : File that checks if session is already set, if not redirect to the login page
Author: Krzysztof Bas 
Date: 07/04/2020
-->


<?php // Start of php tag
session_start(); //start the session

// if a session is set for user, don't do anything
if (isset($_SESSION['user'])) {
} else {
    // if sesion is not set, redirect user to the login page
    header("Location: https://c00238768.candept.com/Employee/index.php");
}
?>
<!-- End of php tag-->