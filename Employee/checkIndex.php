<?php

include 'php/session.php'; ?>

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
			<p id='message'> X</p>
            <section id='loginSection'>
                <!-- Start of section of the page -->

                <form action='index.php'  method='POST'>
                    <!-- Form that allows to add Employee record to the database -->



                            <p class='formBorder'>
                                <!-- Start of FIRST NAME paragraph -->

                                <label for='login' >Login</label><!-- Label for firstname input -->
                                <input type='text' name='login' id='login' placeholder='Enter login name' autocomplete='off' required><!-- input for employees firstname -->

                            </p><br><br><!-- End of FIRSTNAME paragraph -->

                            <p class='formBorder'>
								
                                <!-- Start of SURNAME paragraph -->
                                <label for='password'>Password</label><!-- Label for surname input -->
                                <input type='text' name='password' id='password'  placeholder='Enter password'  autocomplete='off' required><!-- input for employees surname -->
                            </p><br><br><br><!-- End of SURNAME paragraph -->

                    

				<p>
                    <input type='submit' class='loginButton' value='Login'><!-- SUBMIT FORM BUTTON -->
                    <input type='reset' class='loginButton' value='Clear'><!-- CLEAR FORM BUTTON -->
				</p>


                </form><!-- End of form -->
            </section><!-- End of section -->



</body><!-- End of Body -->

<?php

include 'db.inc.php';


if (isset($_POST['login']) && isset($_POST['password'])) 
{
	
    $attempts = $_SESSION['attempts'];
    $sql = "Select employeeID from Employee where login = '$_POST[login]' and password = '$_POST[password]' ";
    $result = mysqli_query($con, $sql);
	
    if (!$result) 
	{
        echo " Error in query" . mysqli_error($con);
    } else 
	{
		
		
        if (mysqli_affected_rows($con) == 0) 
		{

            $attempts++;

            if ($attempts < 4) 
			{
                $_SESSION['attempts'] = $attempts;

                echo "<script> document.getElementById('message').innerHTML = 'You have entered an invalid username or password'; 
							document.getElementById('message').style.visibility='visible'		</script>";
        
				
            } 
			else 
			{	echo"
					<script> document.getElementById('message').innerHTML = 'Sorry - You have entered invalid details too many times <br> Try again later...'  ;
							document.getElementById('message').style.visibility='visible';
							document.getElementById('login').disabled = 'true';
							document.getElementById('password').disabled = 'true';
							document.getElementById('loginSection').style.visibility = 'hidden' ; 
							</script> ";
			 
				

            }
        } 
		else 
		{
			$login = $_POST['login'];
			$id;
          $row = mysqli_fetch_row($result);
            $id = $row[0];

            $date = date("Y-m-d");
            $time = date("H:i:s");

            $loginTime = "Insert into LoginReport (employeeID,loginDate,loginTime,login) Values ('$id','$date','$time','$login')";

            if (!mysqli_query($con, $loginTime)) 
			{
                echo " Error in query" . mysqli_error($con);
            }
			else 
			{

                // Successful login 
                $_SESSION['user'] = $_POST['login'];
                header("Location: https://c00238768.candept.com/Employee/welcomeScreen.php"); /* Redirect browser */
                exit;
               
            }
        }
    }
}
else 
{
    // build page for initial display
    $attempts = 1; // screen will be displayted for first attempy
    $_SESSION['attempts'] = $attempts;  //set session variables so that the number of attempts can be counter

};




mysqli_close($con);
?>