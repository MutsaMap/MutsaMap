<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Dig It</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header><img src="pictures\we-dig-it-low-resolution-logo-color-on-transparent-background.png" alt="" width="250" height="200">

</header>
<h1 id="md">MANAGE DETAILS</h1>
         <nav>
            <ul id="adminmenu">
                <li>
                    <a href="add.php" >Add</a>
                </li>
                <li>
                    <a href="agent.php">Manage</a>
                </li>
                <li>
                    <a href="ratings.php">Ratings</a>
                </li>

                <li>
                    <a href="comments.php" class="active">Comments</a>
                </li>

                <li><a href="logout.php">Exit</a></li>
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
 $query = "SELECT * FROM ratings WHERE digs_id = $ID";
 $result = mysqli_query($conn, $query) or die("ERROR: unable to execute query!");
 echo "<table width=\"80%\" border=0>
         <tr bgcolor=\"#C7CB85\">
         <td>COMMENTS</td>
         </tr>";
 while ($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>" . $row['comment'] . "</td>";
    echo "<td>" . "<a href=\"comments.php\"><input type=\"button\" value=\"Back\"></a> </td>";
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