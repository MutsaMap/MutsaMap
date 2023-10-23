<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Dig It</title>
    <link rel="stylesheet" href="style.css">

<!-- bootstrap css link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" 
rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" 
crossorigin="anonymous">

<!--font awesome link-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<main>
        <header><img src="pictures\we-dig-it-low-resolution-logo-color-on-transparent-background.png" alt="" width="250" height="200">

        </header>
        <h1 id="md">MANAGE DETAILS</h1>
        <nav>
            <ul id="adminmenu">

                <li>
                    <a href="admin.php">View Digs</a>
                </li>

                <li>
                    <a href="review.php">Reviews</a>
                </li>


                <li>
                    <a href="userM.php" class="active">Manage</a>
                </li>

                <li>
                    <a href="reports.php">Reports</a>
                </li>

                <li>
                    <a href="logout.php">Exit</a>
                </li>

            </ul>
        </nav>
        <form action="userM.php" method="POST">
    <p>User Management:</p>
    <input type="radio" id="tenants" name="user" value="Tenants">
    <label for="tenants">Tenants:</label>&nbsp;&nbsp;
    
   
    
    <input type="radio" id="agents" name="user" value="Agents">
    <label for="agents">Agents</label>&nbsp;&nbsp;
    
    <br>
    <br>
    <input type="submit" name="submit" value="Show">
</form>
<?php
if (isset($_REQUEST['submit'])){
 // add the database credentials
 require_once("config.php");
 $UMChosen =$_REQUEST['user'];
 // make connection to database
 $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
     or die("ERROR: unable to connect to database!");
 // issue query instructions
 if ($UMChosen == "Agents") {
 $query = "SELECT  * FROM agents";
 $result = mysqli_query($conn, $query) or die("ERROR: unable to execute query!");
 // start table
 echo "<table width=\"80%\" border=0>
         <tr bgcolor=\"#C7CB85\">
         <td>NAME</td>
         <td>EMAIL</td>
         <td>CONTACT NUMBER</td>
         <td>STATUS</td>
         <td> </td>
         <td> </td>
         </tr>";
 // populate table rows with data from database
 while ($row = mysqli_fetch_array($result)) {
     echo "<tr>";
     echo "<td>" . $row['name'] . "</td>";
     echo "<td>"  . $row['email'] . "</td>";
     echo "<td>" . $row['contact_number'] . "</td>";
     echo "<td>" . $row['status'] . "</td>";
     
     echo "<td>" . "<a href=\"editagent.php?id=" . $row['agent_id'] . "\"><input type=\"button\" value=\"Edit\"></a>" . "</td>";
     echo "<td>" . "<a href=\"deleteagent.php?id=" . $row['agent_id'] . "\"><input type=\"button\" value=\"Delete\" onClick=\"
     return confirm('Are you sure you want to delete?')\"></a>" . "</td>";
     echo "</tr>";
 }
} elseif($UMChosen == "Tenants"){
    $query = "SELECT  * FROM tenants";
 $result = mysqli_query($conn, $query) or die("ERROR: unable to execute query!");
 // start table
 echo "<table width=\"80%\" border=0>
         <tr bgcolor=\"#C7CB85\">
         <td>NAME</td>
         <td>EMAIL</td>
         <td>CONTACT NUMBER</td>
         <td>STATUS</td>
         <td> </td>
         <td> </td>
         </tr>";
 // populate table rows with data from database
 while ($row = mysqli_fetch_array($result)) {
     echo "<tr>";
     echo "<td>" . $row['name'] . "</td>";
     echo "<td>"  . $row['email'] . "</td>";
     echo "<td>" . $row['contact_number'] . "</td>";
     echo "<td>" . $row['status'] . "</td>";
     
     echo "<td>" . "<a href=\"edittenant.php?id=" . $row['tenant_id'] . "\"><input type=\"button\" value=\"Edit\"></a>" . "</td>";
     echo "<td>" . "<a href=\"deletetenant.php?id=" . $row['tenant_id'] . "\"><input type=\"button\" value=\"Delete\" onClick=\"
     return confirm('Are you sure you want to delete?')\"></a>" . "</td>";
     echo "</tr>";
} }
 // end table
 echo "</table>"; }
 // close the connection to database
mysqli_close($conn);
?>

        <footer>
            <!-- Footer Ribbon -->
  <div class="footer-ribbon">
    <!-- Quick Links -->
    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Use</a></li>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
  
      
    <!-- Contact Us -->
    <div class="footer-section">
      <h3>Contact Us</h3>
      <p>Drosty Rd, Grahamstown, Makhanda, 6139</p>
      <p>Phone: 046 603 8111</p>
      <p>Email: info@wedigit.com</p>
    
  
    <!-- Copyright -->
    <div class="footer-section">
      <h3>Copyright</h3>
      <p>© 2023 We Dig It. All rights reserved.</p>
    </div>
  </div>
        </footer>
</body>
</html>