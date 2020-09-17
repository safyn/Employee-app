<?php // Start of php tag
include 'session.php'; ?>
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
    <script src="JavaScript/employeeJS.js"></script>

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

        <button class="dropdown-btn">Admin
            <i class="caret-down">▼</i><!-- Caret down character that symbolizes dropdown button -->
        </button>
        <div class="dropdown-container">
            <!-- Dropdown container for a ADMIN Button -->
            <a href="https://c00238768.candept.com/Employee/changePassword.php">Change Password</a><!-- anchor to the change password page -->
        </div>
        <a href="https://c00238768.candept.com/Employee/logout.php">Logout</a> <!-- anchor to the welcome Page -->

    </div>
    <!-- END OF DROP DOWN MENU -->

    <div id="main">
        <!-- Start of Main div that stores the main content of the page -->


        <button id="menuButton" class="openbtn" onclick="openNav()" value="☰">☰ Menu</button> <!-- Menu button that opens/shows the menu -->
        <h1>Add an Employee</h1> <!-- Page header -->

        <!-- Paragraph that displays login of the current user and devides the page -->
        <p class='bottomBorder' align='right' style="font-size:22;" style="font-weight:bold;">User: <?php echo $_SESSION['user'] ?></p>

        <div id="container">
            <!-- Start of CONTAINER div, this is where main content (forms,tables etc.) goes -->

            <section id='formSection'>
                <!-- Start of section of the page -->

                <form action='insert.php' onsubmit='addEmployee(event)' method='POST'>
                    <!-- Form that allows to add Employee record to the database -->

                    <div class="row">
                        <!-- Start of ROW div that contains form input fields -->
                        <div class="column">
                            <!-- Start of COLUMN ONE div that devides the content of the ROW div -->

                            <p class='formBorder'>
                                <!-- Start of FIRST NAME paragraph -->

                                <label for='firstname' id='label'>First Name</label><!-- Label for firstname input -->
                                <input type='text' name='firstname' id='firstname' pattern="[a-zA-Z. ]+" placeholder='Enter a name' oninput='saveValue(this);' autocomplete="off" required>
                                <!-- input for employees firstname -->

                            </p><!-- End of FIRSTNAME paragraph -->

                            <p class='formBorder'>
                                <!-- Start of SURNAME paragraph -->
                                <label for='surname'>Surname</label><!-- Label for surname input -->
                                <input type='text' name='surname' id='surname' pattern="[a-zA-Z. ]+" placeholder='Enter a surname' autocomplete="off" oninput='saveValue(this);' required>
                                <!-- input for employees surname -->
                            </p><!-- End of SURNAME paragraph -->

                            <p class='formBorder'>
                                <!-- Start of DATE OF BIRTH paragraph -->
                                <label for='dob'>Date of Birth</label><!-- Label for dob input-->
                                <input name='dob' id='dob' placeholder='Select Date of Birth' onfocus="(this.type='date')" onblur="(this.type='text')" oninput='saveValue(this);' autocomplete="off" required>
                                <!-- input for employees date of birth, type of the inpuch changes depending of the positioning of the mouse in order to display placeholder properly -->

                            </p><!-- End of DATE OF BIRTH paragraph -->

                            <p class='formBorder'>
                                <!-- Start of EMAIL paragraph -->
                                <label for='email'>Email Address</label><!-- Label for email input-->
                                <input type='text' name='address' id='address' placeholder='Enter a valid email address' autocomplete="off" oninput='saveValue(this);' required>
                                <!-- input for employees email address -->

                            </p><!-- End of EMAIL paragraph -->


                        </div><!-- End of COLUMN ONE -->

                        <div class="column">
                            <!-- Start of COLUMN TWO -->

                            <p class='formBorder'>
                                <!-- Start of PHONE NUMBER paragraph -->
                                <label for='phonenumber'>Phone number</label><!-- Label for phonenumber input-->
                                <input type='phone' name='phonenumber' id='phonenumber' placeholder='Enter a phone number' oninput='saveValue(this);' autocomplete="off" required>
                                <!-- input for employees phone number -->

                            </p><!-- End of FPHONE NUMBER paragraph -->

                            <p class='formBorder'>
                                <!-- Start of JOBTITLE paragraph -->
                                <label for='jobtitle'>Job Title</label><!-- Label for jobtitle input-->
                                <input type='text' name='jobtitle' id='jobtitle' placeholder='Enter a job title' oninput='saveValue(this);' autocomplete="off" required>
                                <!-- input for employees job title -->

                            </p><!-- End of JOBTITLE paragraph -->

                            <p class='formBorder'>
                                <!-- Start of LOGIN paragraph -->
                                <label for='login'>Login</label><!-- Label for login input-->
                                <input type='text' name='login' id='login' placeholder='Enter login name' oninput='saveValue(this);' autocomplete="off" required>
                                <!-- input for employees login -->

                            </p><!-- End of LOGIN paragraph -->

                            <p class='formBorder'>
                                <!-- Start of PASSWORD paragraph -->
                                <label for='password'>Password</label><!-- Label for password input-->
                                <input type='password' name='password' id='password' placeholder='Enter a password' autocomplete="off" required>
                                <!-- input for employees password -->
                            </p><!-- End of PASSWORD paragraph -->

                        </div><!-- End of COLUMN TWO -->
                    </div><!-- End of ROW -->

                    <br><br>
                    <p align='center' id='message'> </p><br><br><!-- Paragraph that displays system messages -->


                    <input type='submit' class='formButton' value='Submit'><!-- SUBMIT FORM BUTTON -->
                    <input type='reset' class='formButton' value='Clear'><!-- CLEAR FORM BUTTON -->



                </form><!-- End of form -->
            </section><!-- End of section -->
        </div><!-- End of container div -->
    </div><!-- End of main div -->



    <script type="text/javascript">
        loadSessionValues(); //load values from the session storage -->				
        getMenuElements(); // function to get menu Elements
    </script>



</body><!-- End of Body -->

<?php // Start of php tag
include 'db.inc.php'; // include database connection

// if form fields are set 
if (
    isset($_POST['firstname']) && isset($_POST['surname']) && isset($_POST['dob']) && isset($_POST['address']) && isset($_POST['phonenumber'])
    && isset($_POST['jobtitle']) && isset($_POST['login'])  && isset($_POST['password'])
) {
    // Query that inserts a record into a Employee table
    $insert = "Insert into Employee
        VALUES('','$_POST[firstname]','$_POST[surname]','$_POST[dob]','$_POST[address]','$_POST[phonenumber]',
		'$_POST[jobtitle]','$_POST[login]','$_POST[password]')";

    // Query that checks if chosen login is available
    $loginCheck = " Select * from Employee where login = '$_POST[login]' ";

    // Assign form inputs into php variables
    $name = $_POST['firstname'];
    $surname = $_POST['surname'];
    $dob = $_POST['dob'];
    $address = $_POST['Address'];
    $phone = $_POST['phonenumber'];
    $job = $_POST['jobtitle'];
    $login = $_POST['login'];
    $login = $_POST['password'];


    //CHECK IF LOGIN IS AVAILABLE, IF IT IS INSERT AN EMPLOYEE RECORD INTO THE DATABASE
    //Execute Query that checks if login is available. Display error if query is not executed properly
    if (!mysqli_query($con, $loginCheck)) {
        die("Error while checking login availability : " . mysqli_error($con));
    } //Continue - Query executed successfully
    else {
        // If chosen login already exist display message
        if (mysqli_affected_rows($con) == 1) {
            echo "<script> document.getElementById('message').innerHTML = 'Selected Login is Aleady in Use';
							document.getElementById('message').style.visibility='visible';			</script>";
        } // Continue - Chosen login is available
        else {
            // Execute query that inserts a record into the Employee table.Display error if query is not executed properly
            if (!mysqli_query($con, $insert)) {
                echo "Error while inserting a record to the database" . mysqli_error($con);
            } else {    // clear session storage
                echo "<script>  sessionStorage.clear();  
								alert('Employee record added to the database ');
					</script>"; // Display an alert with confirmation 
            }
        }
    }
}

mysqli_close($con); // close connection with database

?>
<!-- End of php tag-->