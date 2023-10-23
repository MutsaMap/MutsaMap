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
                    <a href="review.php" class="active">Reviews</a>
                </li>


                <li>
                    <a href="userM.php">Manage</a>
                </li>

                <li>
                    <a href="reports.php">Reports</a>
                </li>

                <li>
                    <a href="logout.php">Exit</a>
                </li>

            </ul>
        </nav>
<?php
$ID = $_REQUEST['id'];
// add the database credentials
require_once("config.php");
// make connection to database
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
    or die("ERROR: unable to connect to database!");
// issue query instructions
$query = "SELECT tenants.name, ratings.comment FROM tenants INNER JOIN ratings ON tenants.tenant_id = ratings.tenant_id WHERE digs_id = $ID";
$result = mysqli_query($conn, $query) or die("ERROR: unable to execute query!");

echo "<table width=\"80%\" border=0>
<tr bgcolor=\"#C7CB85\">
<td> TENANT NAME </td>
<td>COMMENTS</td>
<td></td>
<td></td>
</tr>";

while ($row = mysqli_fetch_array($result)){
   echo "<tr>";
   echo"<td>" . $row['name'] . "</td>";
   echo "<td>" . $row['overall_rating'] . "</td>";
   echo "<td>" . "<a href=\"editcomm.php?id=" . $row['digs_id'] . "\"><input type=\"button\" value=\"Edit\"></a>" . "</td>";
   echo "<td>" . "<a href=\"deletecomm.php?id=" . $row['digs_id'] . "\"><input type=\"button\" value=\"Delete\" onClick=\"
   return confirm('Are you sure you want to delete?')\"></a>" . "</td>";
   echo "</tr>";
}
echo "</table>";
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