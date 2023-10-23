<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    <a href="add.php" class="active">Add</a>
                </li>
                <li>
                    <a href="manage.php">Manage</a>
                </li>
                <li>
                    <a href="viewing.php">View digs</a>
                </li>
                <li>
                    <a href="ratings.php">Ratings</a>
                </li>

                <li>
                    <a href="comments.php">Comments</a>
                </li>

                <li><a href="logout.php">Exit</a></li>
            </ul>
        </nav>
<?php
//fetch variables

$Name_ = $_REQUEST['name'];
$Price_ = $_REQUEST['price'];
$Address_ = $_REQUEST['address'];
$digs_ID_ = $_REQUEST['digsID'];
$distance_ = $_REQUEST['distance'];
$description = $_REQUEST['description'];


 require_once("config.php");
//connect
 $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
  or die("<strong style = 'color: red;'>Could not connect to database!</strong>");

  //issue query instructions
  $query = "UPDATE digs SET name_of_digs = '$Name_', cost = '$Price_',
  address = '$Address_', distance_from_campus = '$distance_', description = '$description' 
 WHERE digs_id = '$digs_ID_'";

  $results = mysqli_query($conn, $query)
  or die("<strong style = 'color: red;'>Unable to exequte query</strong>");
//display
 
      header("Location:agent.php");
      
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