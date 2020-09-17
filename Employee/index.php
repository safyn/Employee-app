<?php session_start(); ?>
<!-- Start Session-->
<!--
Name : index.php
Purpose : Login screen for the Employee app. Updates the database if login is succesfull, otherwise display system message. If incorect details are entered 3 times, hide the login form
Author: Krzysztof Bas 
Date: 06/04/2020
-->


<html>
<!-- Start of HTML tag-->

<head>
    <!-- Start of head tag-->

    <!-- Meta tag provides information about the data -->
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <!-- Link CSS, JavaScript and PHP files to the webside-->
    <link href="css/page.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/form.css" rel="stylesheet" type="text/css" media="all" />
    <link href="css/login.css" rel="stylesheet" type="text/css" media="all" />
    <script src="JavaScript/employeeJS.js"></script>

</head> <!-- end of head tag-->


<body>
    <p id='message'>. </p> <!-- hidden paragraph that is used to display system messages  -->

    <section id='loginSection'>
        <!-- Start of login Section that contains login form -->

        <form action='index.php' method='POST'>
            <!-- Login form -->



            <p class='formBorder'>
                <!-- Start of LOGIN paragraph -->

                <label for='login'>Login</label><!-- Label for login input -->
                <input type='text' name='login' id='login' placeholder='Enter login name' autocomplete='off' required><!-- input for employees login -->

            </p><br><br><!-- End of LOGIN paragraph -->

            <p class='formBorder'>
                <!-- Start of PASSWORD paragraph -->

                <!-- Start of SURNAME paragraph -->
                <label for='password'>Password</label><!-- Label for password  -->
                <input type='text' name='password' id='password' placeholder='Enter password' autocomplete='off' required><!-- input for employees password -->
            </p><br><br><br><!-- End of PASSWORD paragraph -->



            <p>
                <input type='submit' class='loginButton' value='Login'><!-- SUBMIT/LOGIN FORM BUTTON -->
                <input type='reset' class='loginButton' value='Clear'><!-- CLEAR FORM BUTTON -->
            </p>


        </form><!-- End of form -->
    </section><!-- End of section -->



</body><!-- End of Body -->

<?php // start of php tag

include 'db.inc.php';  // include connection to the database 
// Start of session
// if login and password are entered
if (isset($_POST['login']) && isset($_POST['password'])) {

    $attempts = $_SESSION['attempts']; // session variable that stores the number of login attempts
    // Query that checks if employeeID corresponds to a supplied login and password in the database 
    $sql = "Select employeeID from Employee where login = '$_POST[login]' and password = '$_POST[password]' ";

    $result = mysqli_query($con, $sql);

    // display error if query was not executed successfully
    if (!$result) {
        echo " Error in query" . mysqli_error($con);
    } else {

        // if result of the query has 0 rows (Details are incored) increment number of attempts
        if (mysqli_affected_rows($con) == 0) {

            $attempts++;
            // display message and update attempts session variable
            if ($attempts < 4) {
                $_SESSION['attempts'] = $attempts;
                // update element and set it to visible
                echo "<script> document.getElementById('message').innerHTML = 'You have entered an invalid username or password'; 
							document.getElementById('message').style.visibility='visible'		</script>";
            } else // 3 unsucesfull attempts - Display message, disable and hide login form
            {
                echo "
					<script> document.getElementById('message').innerHTML = 'Sorry - You have entered invalid details too many times <br> Try again later...'  ;
							document.getElementById('message').style.visibility='visible';
							document.getElementById('login').disabled = 'true';
							document.getElementById('password').disabled = 'true';
							document.getElementById('loginSection').style.visibility = 'hidden' ; 
							</script> ";
            }
        } else { // Succesful login - Update database with login records
            $_SESSION['user'] = $_POST['login'];
            // fetch id value from the tabke
            $row = mysqli_fetch_row($result);
            $id = $row[0];
            $_SESSION['id'] = $id;
            // get date and time
            $date = date("Y-m-d");
            $time = date("H:i:s");
            // Query that creates login record
            $loginTime = "Insert into LoginReport (employeeID,loginDate,loginTime) Values ('$id','$date','$time')";
            // execute query, display error if execution is not successful
            if (!mysqli_query($con, $loginTime)) {
                echo " Error in query" . mysqli_error($con);
            } else {
                // Successful execution - redirect to the welcome page 
                header("Location: https://c00238768.candept.com/Employee/welcomeScreen.php"); /* Redirect browser */
                exit; // exit 

            }
        }
    }
} else {
    // 
    $attempts = 1; // assign initial atempt 
    $_SESSION['attempts'] = $attempts;  //set session variable

};

mysqli_close($con); // close connection
?>