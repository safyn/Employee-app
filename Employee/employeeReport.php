<!--
Name : employeeReport.php
Purpose :Page that displays employee Table, contains buttons that allow user to sort the tables 
Author: Krzysztof Bas 
Date: 28/03/2020
-->

<?php // Start of php tag
include 'session.php'; ?>
<!-- Check if session exist otherwise redirec to login screen -->


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
        <button class="logout">Logout</button><!-- Logout button -->

    </div>
    <!-- END OF DROP DOWN MENU -->

    <div id="main">
        <!-- Start of Main div that stores the main content of the page -->


        <button id="menuButton" class="openbtn" onclick="openNav()" value="☰">☰ Menu</button> <!-- Menu button that opens/shows the menu -->
        <h1>Employee Report</h1> <!-- Page header -->

        <!-- Paragraph that displays login of the current user and devides the page -->
        <p class='bottomBorder' align='right' style="font-size:22;" style="font-weight:bold;">User: <?php echo $_SESSION['user'] ?></p>

        <div id="container">
            <!-- Start of CONTAINER div, this is where main content (forms,tables etc.) goes -->




            <!-- Start of Employee Report form -->
            <form action="employeeReport.php" method="post" name="reportForm">
                <input type="hidden" name="choice"> <!-- Hidden input field that will store the report order value -->
            </form>
            <br>
            <br>

            <!-- Sort buttons- responsible for sorting the table -->
            <input type="button" class="sortButton" id="nameButton" value="First Name Order" onclick="firstNameOrder()" title="Click here to see persons in reverse date of birth order">
            <input type="button" class="sortButton" id="surnameButton" value="Surname Order" onclick="lastNameOrder()" title="Click here to see Persons in alphabetical order of surname" disabled>
            <input type="button" class="sortButton" id="idButton" value="Employee ID Order" onclick="idOrder()" title="Click here to see Persons in alphabetical order of Email Address" disabled>
            <?php buildTable(); ?>
            <!-- Call a php function to build/create a html table/repost -->


        </div><!-- End of container div -->
    </div><!-- End of main div -->



    <script type="text/javascript">
        getMenuElements(); // function to get menu Elements
    </script>



</body><!-- End of Body -->


<?php // Start of php tag

// Function that build the table depending on the type of sorting button that was selected
function buildTable()
{
    include "db.inc.php"; // include and evaluate external file

    // Default choice 
    $choice = 'firstName';
    $sql; // Create variable that will store sql queries

    // if choice field is set, assign its value into a php variable
    if (isset($_POST['choice'])) {
        $choice = $_POST['choice'];
    }
    // If lastName button was selected
    if ($choice == "lastName") {

        // Dissable lastName button and enable remaining buttons
        echo " <script>
            document.getElementById('nameButton').disabled = false;
            document.getElementById('surnameButton').disabled = true;
			document.getElementById('idButton').disabled = false;
        </script> ";
        // Assign query that is to be executed into a variable
        $sql = "Select employeeID,firstName,lastName,Address,phoneNumber,jobTitle,login from Employee order by lastName";
        // if id button was selected
    } else if ($choice == "id") {
        // Dissable id button and enable remaining buttons
        echo " <script>
        document.getElementById('nameButton').disabled = false;
        document.getElementById('surnameButton').disabled = false;
        document.getElementById('idButton').disabled = true;
    </script> ";

        // Assign query that is to be executed into a variable
        $sql = "Select employeeID,firstName,lastName,Address,phoneNumber,jobTitle,login from Employee order by employeeID ";
        // Last choice - firstName button
    } else {
        //Disable firstName button and enable remaining buttons
        echo " <script>
        document.getElementById('nameButton').disabled = true;
        document.getElementById('surnameButton').disabled = false;
        document.getElementById('idButton').disabled = false;
    </script> ";

        // Assign query that is to be executed into a variable
        $sql = "Select employeeID,firstName,lastName,Address,phoneNumber,jobTitle,login from Employee order by firstName ";
    }

    // if execution is successful reload page
    if ($result = mysqli_query($con, $sql)) {
        // Start of table tag, print out and initialize tables Header cells
        echo "<table  id='employeeTable' > 
					
							<thead>
							<tr>
							<th>Employee ID</th>
							<th>First Name</th>
							<th>Surname</th>	
							<th>Address</th>
							<th>Phone Number</th>
							<th>Job Title</th>
							<th>Login Name</th>
						
							</tr> 
						</thead> ";
        // assign query results into the variables and print the out inside of the table cells	
        while ($row = mysqli_fetch_array($result)) {
            // Standard table cells
            echo "<tr>";    // start of table row
            echo "<td>" . $row['employeeID'] . "</td>";
            echo "<td>" . $row['firstName'] . "</td>";
            echo "<td>" . $row['lastName'] . "</td>";
            echo "<td>" . $row['Address'] . "</td>";
            echo "<td>" . $row['phoneNumber'] . "</td>";
            echo "<td>" . $row['jobTitle'] . "</td>";
            echo "<td>" . $row['login'] . "</td>";
            echo "</tr>"; // end of table row

        }
        echo "</table>"; // close table tag
    }
    // if execution is not successful print out the error 
    else {
        echo "Error in querying the database" . mysqli_error($con);
    }

    mysqli_close($con); // close connection 
}
?>
<!-- End of php tag -->