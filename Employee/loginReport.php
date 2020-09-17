<!--
Name : loginReport.php
Purpose : Page that allows user to select Employees name and display a login/logout report for that employee
Author: Krzysztof Bas 
Date: 09/04/2020
-->

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
    <link href="css/table.css" rel="stylesheet" type="text/css" media="all" />
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

        <h1>Login Report</h1> <!-- Page header -->

        <!-- Paragraph that displays login of the current user and devides the page -->
        <p class='bottomBorder' align='right' style="font-size:22;" style="font-weight:bold;">User: <?php echo $_SESSION['user'] ?></p>

        <div id="container">
            <!-- Start of CONTAINER div, this is where main content (forms,tables etc.) goes -->


            <!-- Start of section of the page -->
            <section id='formSection'>
                <!-- Start of Login Report form -->
                <form action='loginReport.php' method='POST'>
                    <!-- Paragraph that contains a select dropdown  -->
                    <p class='formBorder' align='center' style="width:55%; margin-left:auto; margin-right:auto;">
                        <label>Select Employee's Name: </label>
                        <?php include 'employeeLoginListbox.php' ?>
                        <!-- Display Select tag -->
                    </p>

                    <?php buildTable();  ?>
                    <!-- Call php function that creates a table/report for a selected employee -->
                </form><!-- End of form -->
            </section><!-- End of section -->
        </div><!-- End of container div -->
    </div><!-- End of main div -->



    <script type="text/javascript">
        getMenuElements(); // function to get menu Elements
    </script>



</body><!-- End of Body -->

<?php // Start of php tag

function buildTable()
{
    include 'db.inc.php'; // database connection

    if (isset($_POST['listbox'])) {

        //Query that selects empoloyees login date, login and logout times depending on employee ID supplied 
        $sql = "SELECT LoginReport.loginDate, LoginReport.loginTime,LoginReport.logoutTime
from LoginReport
WHERE  employeeID='$_POST[listbox]'";


        // if execution is successful reload page
        if ($result = mysqli_query($con, $sql)) {
            // Start of table tag, print out and initialize tables Header cells

            echo "<table  id='employeeTable' > 
					
							<thead>
							<tr>
							<th>Login Date</th>
							<th>Login Time</th>
							<th>Logout Time</th>	
							</tr> 
						</thead> ";
            // assign query results into the variables and print the out inside of the table cells	
            while ($row = mysqli_fetch_array($result)) {
                // Standard table cells
                echo "<tr>";    // start of table row
                echo "<td>" . $row['loginDate'] . "</td>";
                echo "<td>" . $row['loginTime'] . "</td>";
                echo "<td>" . $row['logoutTime'] . "</td>";

                echo "</tr>"; // end of table row

            }

            echo "</table>"; // close table tag
        }
        // if execution is not successful print out the error 
        else {
            echo "Error in querying the database" . mysqli_error($con);
        }
    }
    mysqli_close($con); // close connection 	 
}
?>
<!-- End of php tag -->