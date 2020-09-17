<?php // Start of php tag
include 'php/session.php';
?>
<!-- End of php tag-->


<html>
<!-- Start of HTML tag-->

<head>
    <!-- Start of head tag-->

    <!-- Meta tag provides information about the data -->
    <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
    <!-- Link CSS, JavaScript and PHP files to the webside-->
    <link href="css/page.css" rel="stylesheet" type="text/css" media="all" />


</head> <!-- end of head tag-->

<body>

    <div id="mySidebar" class="sidebar">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="https://c00238768.candept.com/Employee/welcomeScreen.php">Welcome Page</a>
        <button class="dropdown-btn">File Maintenance
            <i class="caret-down">▼</i>
        </button>
        <div class="dropdown-container">
            <a href="https://c00238768.candept.com/Employee/insert.php">Add an Employee</a>
            <a href="#">Delete an Employee</a>
        </div>
        <button class="dropdown-btn">Reports
            <i class="caret-down">▼</i>
        </button>
        <div class="dropdown-container">
            <a href="#">All Employees</a>
            <a href="#">Login Report</a>
        </div>
        <button class="dropdown-btn">Admin
            <i class="caret-down">▼</i>
        </button>
        <div class="dropdown-container">
            <a href="#">Change Password</a>
        </div>
        <button class="logout">Logout</button>

    </div>

    <div id="main">

        <script src="JavaScript/employeeJS.js"></script>

        <button id="menuButton" class="openbtn" onclick="openNav()" value="☰">☰ Menu</button>
        <h1>Welcome Page</h1>
        <p class='bottomBorder' align='right' style="font-size:22;" style="font-weight:bold;">User: <?php echo $_SESSION['user'] ?></p>

        <div id="container">
            <p> <?php include 'php/dob.php' ?> </p>
            <div id="container">
                <?php echo "bla bla" . $_SESSION['user']  ?>
                <section>
                    <?php echo "bla bla" . $_SESSION['user'] ?>
                </section>
            </div>
        </div>

        <script>
            /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
            var dropdown = document.getElementsByClassName("dropdown-btn");
            var i;

            for (i = 0; i < dropdown.length; i++) {
                dropdown[i].addEventListener("click", function() {
                    // change the class to 'active' to change its apearence 
                    this.classList.toggle("active");
                    var dropdownContent = this.nextElementSibling;
                    if (dropdownContent.style.display === "block") {
                        dropdownContent.style.display = "none";
                    } else {
                        dropdownContent.style.display = "block";
                    }
                });
            }

            function openNav() {
                document.getElementById("mySidebar").style.width = "275px";
                document.getElementById("main").style.marginLeft = "275px";
                document.getElementById("bob").style.visibility = "hidden";
            }

            function closeNav() {
                document.getElementById("mySidebar").style.width = "0";
                document.getElementById("main").style.marginLeft = "0";
                document.getElementById("bob").style.visibility = "visible";
            }
        </script>

</body>