<!--
Name : loadTable.php
Purpose : Load Prescriptiondrug table of a prescription being currently dispensed 
Author: Krzysztof Bas 
Date: 28/03/2020
-->
<?php
include "db.inc.php";// include and evaluate external file

$choice = 'firstName';
$sql;
    if(isset($_POST['choice'])) {
        $choice = $_POST['choice'];
    }
    if($choice == "lastName") {
    

       echo " <script>
            document.getElementById('nameButton').disabled = false;
            document.getElementById('surnameButton').disabled = true;
			document.getElementById('idButton').disabled = false;
        </script> ";
    
        $sql ="Select employeeID,firstName,lastName,Address,phoneNumber,jobTitle,login from Employee order by lastName";

    
    } else if($choice == "id") {
 
        echo " <script>
        document.getElementById('nameButton').disabled = false;
        document.getElementById('surnameButton').disabled = false;
        document.getElementById('idButton').disabled = true;
    </script> ";
    
   
    $sql ="Select employeeID,firstName,lastName,Address,phoneNumber,jobTitle,login from Employee order by employeeID ";

    }else{

        echo " <script>
        document.getElementById('nameButton').disabled = true;
        document.getElementById('surnameButton').disabled = false;
        document.getElementById('idButton').disabled = false;
    </script> ";
    
   
    $sql ="Select employeeID,firstName,lastName,Address,phoneNumber,jobTitle,login from Employee order by firstName ";
    }





// if execution is successful reload page
if($result = mysqli_query($con,$sql)){
	// Start of table tag, print out and initialize tables Header cells
	echo "<table class='prescriptionTable' id='prescriptionTable' > 
					
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
while($row = mysqli_fetch_array($result)) {
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
else{
	echo "Error in querying the database" . mysqli_error($con);    
}

mysqli_close($con); // close connection 

?><!-- End of php tag -->