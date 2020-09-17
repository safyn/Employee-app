<!--
Name : changePassword.php
Purpose : Webpage that allows change of users password. First user enters old password and presses enter. If the password is correct, change of password form is displayed
Author: Krzysztof Bas 
Date: 10/04/2020
-->

<?php include 'php/session.php'; ?>
<!-- Start the session or use existing, redirect if session is not set-->


<html>
<!-- Start of HTML tag-->

<head>
    <!-- Start of head tag-->

    <!-- Meta tag provides information about the data -->
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <!-- Link CSS, JavaScript and PHP files to the webside-->
    <link href="css/page.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/form.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/table.css" rel="stylesheet" type="text/css" media="all" />
    <script src="JavaScript/employeeJS.js"></script> <!-- File with JavaScript functions-->


</head> <!-- end of head tag-->

<body>
    <!-- Start of Body-->

    <!-- EDITED DROP DOWN MENU FROM W3SCHOOLS.COM-->
    <!-- https://www.w3schools.com/css/css_dropdowns.asp -->
    <div id="mySidebar" class="sidebar">
        <!-- start of sidebar div (side menu)-->

        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a> <!-- anchor to close/hide menu, calls js function that hides the menu, href attribute prevents page reload-->

        <a href="https://c00238768.candept.com/Employee/welcomeScreen.php">Welcome Page</a> <!-- anchor to the welcome Page -->

        <!-- File maintenance dropdown button -->
        <button class="dropdown-btn">File Maintenance
            <i class="caret-down">▼</i> <!-- Caret down character that symbolizes dropdown button -->
        </button>
        <div class="dropdown-container">
            <!-- Dropdown container for a FILE MAINTENANCE Button -->
            <a href="https://c00238768.candept.com/Employee/insert.php">Add an Employee</a> <!-- anchor to the Add Employee page -->
            <a href="https://c00238768.candept.com/Employee/delete.php">Delete an Employee</a><!-- anchor to the Add Employee page -->
        </div>

        <!-- Reports dropdown button -->
        <button class="dropdown-btn">Reports
            <i class="caret-down">▼</i> <!-- Caret down character that symbolizes dropdown button -->
        </button>
        <div class="dropdown-container">
            <!-- Dropdown container for a REPORTS Button -->
            <a href="https://c00238768.candept.com/Employee/employeeReport.php">All Employees</a><!-- anchor to the All Employees page -->
            <a href="https://c00238768.candept.com/Employee/loginReport.php">Login Report</a><!-- anchor to the Login Report page -->
        </div>

        <!-- Admin dropdown button -->
        <button class="dropdown-btn">Admin
            <i class="caret-down">▼</i><!-- Caret down character that symbolizes dropdown button -->
        </button>
        <div class="dropdown-container">
            <!-- Dropdown container for a ADMIN Button -->
            <a href="https://c00238768.candept.com/Employee/changePassword.php">Change Password</a><!-- anchor to the change password page -->
        </div>
        <a href="https://c00238768.candept.com/Employee/logout.php">Logout</a> <!-- anchor to the logout file -->

    </div>
    <!-- END OF DROP DOWN MENU -->

    <div id="main">
        <!-- Start of Main div that stores the main content of the page -->


        <button id="menuButton" class="openbtn" onclick="openNav()" value="☰">☰ Menu</button> <!-- Menu button that opens/shows the menu -->

        <h1>Change Password</h1> <!-- Page header -->

        <!-- Paragraph that displays login of the current user and devides the page -->
        <p class='bottomBorder' align='right' style="font-size:22;" style="font-weight:bold;">User: <?php echo $_SESSION['user'] ?></p>


        <p id='message'>. </p> <!-- hidden paragraph that is used to display system messages  -->

        <div id="container">
            <!-- Start of CONTAINER div, this is where main content (forms,tables etc.) goes -->
            <p id-></p>

            <!-- Start of section of the page -->
            <section id='formSection'>

                <form action='changePassword.php' method='POST'>
                    <!-- Change of Password form -->

                    <p class='formBorder' align='center' style="width:60%; margin-left:auto; margin-right:auto;">
                        <!-- Old password paragraph -->

                        <label for='oldpassword'>Old Password</label>
                        <input type='password' name='oldpassword' id='oldpassword' autocomplete='off' onchange='this.form.submit()' required><br><br>
                        <!-- input for old password,submits the form whenever value of the input is changed-->

                    </p>

                    <p class='formBorder' id='new' align='center' style="width:60%; margin-left:auto; margin-right:auto;">
                        <!-- New password paragraph -->

                        <label for='newpassword'>New Password</label>
                        <input type='password' name='newpassword' id='newpassword' autocomplete='off'><br><br>

                    </p>

                    <p class='formBorder' id='confirm' align='center' style="width:60%; margin-left:auto; margin-right:auto;">
                        <!-- Confirm password paragraph -->

                        <label for='confirmpassword'>Confirm Password</label>
                        <input type='password' name='confirmpassword' id='confirmpassword' autocomplete='off'><br><br>

                    </p><br><br><br><br><br><br>

                    <input type='submit' id='save' class='formButton' value='Save'><!-- SUBMIT FORM BUTTON -->
                    <input type='reset' id='clear' class='formButton' value='Clear'><!-- CLEAR FORM BUTTON -->

                </form><!-- End of Form -->


            </section>
        </div><!-- End of container div -->
    </div><!-- End of main div -->



    <script type="text/javascript">
        getMenuElements(); // function to get menu Elements

        // Set form fields as hidden, once the old password is entered and confirmed the fields will be set visible
        document.getElementById('new').style.visibility = 'hidden';
        document.getElementById('confirm').style.visibility = 'hidden';
        document.getElementById('save').style.visibility = 'hidden';
        document.getElementById('clear').style.visibility = 'hidden';
    </script>!
    <!-- End of Script -->


</body><!-- End of Body -->

<?php
include 'db.inc.php'; // include database connection 


$user = $_SESSION['user'];  // assign session user to a variable

// Check if old password field is set and not empty
if (isset($_POST['oldpassword']) && $_POST['oldpassword'] != "") {
    // Query to check if the old password is correct
    $sql = " Select * from Employee where login ='$user' and password='$_POST[oldpassword]'";
    // if Query execution is unsuccesfull print error
    if (!mysqli_query($con, $sql)) {
        echo " Error in Select query " . mysqli_error($con);
    } else {
        //Success - continue
        // Display message if password is not correct
        if (mysqli_affected_rows($con) == 0) {

            echo "<script> document.getElementById('message').innerHTML = 'You have entered an invalid password'; 
								document.getElementById('message').style.visibility='visible'		</script>";
        } else {
            /*Correct Old Password - Display the rest of the form and set as required,
							remove 'onchange' attribute from the oldpassword field, so the form can be submited only by using submit button */
            echo " <script>
								document.getElementById('new').style.visibility = 'visible';
								document.getElementById('confirm').style.visibility = 'visible';
								document.getElementById('save').style.visibility = 'visible';
								document.getElementById('clear').style.visibility = 'visible';
								document.getElementById('oldpassword').removeAttribute('onchange');
								document.getElementById('newpassword').required = 'true';
								document.getElementById('confirmpassword').required = 'true';

							</script> ";

            // Check if form fields are set and not empty, if true call the changePassword() function
            if (isset($_POST['newpassword']) && isset($_POST['confirmpassword']) && $_POST['confirmpassword'] != "") {
                changePassword();
            }
        }
    }
}
// Function that validates password fields and changes the password
function changePassword()
{
    include 'db.inc.php';  // include database connection


    $user = $_SESSION['user'];  // assign session user to a variable

    // Check if old and new passwords are the same.
    if ($_POST['oldpassword'] == $_POST['newpassword']) {
        // Assign message and set it to visible
        echo "<script> document.getElementById('message').innerHTML = 'New Password Cannot be the same as old one'; 
										document.getElementById('message').style.visibility='visible'		</script>";
    } else {

        // Check if new and confirmation passwords are different
        if ($_POST['newpassword'] != $_POST['confirmpassword']) {
            // Assign message and set it to visible
            echo "<script> document.getElementById('message').innerHTML = 'New Passwords do not match'; 
						document.getElementById('message').style.visibility='visible'		</script>";
        } else {
            //Success - Password fields were verified
            // Query to update the password record
            $sql = "UPDATE Employee set password='$_POST[newpassword]' WHERE login ='$user'";
            //Display error if query is not executed properly
            if (!mysqli_query($con, $sql)) {
                echo "Error in Update Query" . mysqli_error($con);
            } else {
                //Success - Password fields was changed succesfully, display the message
                echo "<script> document.getElementById('message').innerHTML = 'Password was changed'; 
										document.getElementById('message').style.visibility='visible'		</script>";
            }
        }
    }
}


mysqli_close($con); // Close the connection with database

?>
<!-- End of php tag -->