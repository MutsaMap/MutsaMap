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
                    <a href="admin.php" class="active">View Digs</a>
                </li>

                <li>
                    <a href="review.php">Reviews</a>
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
         // add the database credentials
         require_once("config.php");
         // make connection to database
         $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
             or die("ERROR: unable to connect to database!");
         // issue query instructions
         $query = "SELECT digs.photo_URL, digs.name_of_digs, digs.address, digs.cost, agents.name FROM digs
         INNER JOIN agents ON digs.agent_id=agents.agent_id";
         $result = mysqli_query($conn, $query) or die("ERROR: unable to execute query!");

         echo "<table width=\"80%\" border=0>
         <tr bgcolor=\"#C7CB85\">
         <td>IMAGE</td>
         <td>DIGS NAME</td>
         <td>ADDRESS</td>
         <td>PRICE</td>
         <td>AGENT'S NAME</td>
         </tr>";
 // populate table rows with data from database
 while ($row = mysqli_fetch_array($result)) {
     echo "<tr>";
     echo "<td>" . "<img src=\"pictures/" . $row['photo_URL'] . "\">" . "</td";
     echo "<td>" . $row['name_of_digs'] . "</td>";
     echo "<td>" . $row['address'] . "</td>";
     echo "<td>"  . $row['cost'] . "</td>";
     echo "<td>"  . $row['name'] . "</td>";
     echo "</tr>";
 }
 echo "</table>";
         //close connection
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