<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Dig It</title>
    <link rel="stylesheet" href="add.css">
</head>
<body>
<header><img src="pictures/we-dig-it-low-resolution-logo-color-on-transparent-background1.png" alt="" width="250" height="200">

</header>
<h1 class="h1" id="md">MANAGE DETAILS</h1>
        <div class="adminmenu"> <nav>
            <ul id="adminmenu">
                <li>
                    <a href="add.php" class="active">Add</a>
                </li>
                <li>
                    <a href="agent.php">Manage</a>
                </li>
                <li>
                    <a href="ratings.php">Ratings</a>
                </li>

                <li>
                    <a href="comments.php">Comments</a>
                </li>

                <li><a href="logout.php">Exit</a></li>
            </ul>
        </nav></div>
    <?php
    if (isset($_REQUEST['submit'])) {
    $name = $_REQUEST['name'];
    $address = $_REQUEST['address'];
    $price = $_REQUEST['price'];
    $distance = $_REQUEST['distance'];
    $description = $_REQUEST['description'];
   

    $image = $_FILES['picture']['name'];

    $destination = "pictures/" . $image;
        move_uploaded_file($_FILES['picture']['tmp_name'], $destination);
    
    require_once("config.php");

 $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
    or die("ERROR: unable to connect to database!");
// issue query instructions
$query = "INSERT INTO digs(name_of_digs, cost, address, photo_URL, distance_from_campus, description)
            VALUE('$name', '$price', '$address', '$image', '$distance', '$description')";
$result = mysqli_query($conn, $query) or die("ERROR: unable to execute query!");
// close the connection to database
mysqli_close($conn);

echo "<p style=\"color: blue;\">The new <strong>DIGS</strong> was successfully added!</p>";
    }
     ?>
     <section class="admin"> <br>
            <form action="add.php" method="POST" enctype="multipart/form-data">
                <fieldset>
                    <legend><strong>Add a New Digs</strong></legend>
                    <p class="purple-text">Please fill in the form below</p> <br>
                    <label for="name">Digs Name:</label><br> 
                    <input type="text" name="name">
                    <br><br>
                    <label for="image">Image:</label><br>
                    <input type="file" id="picture" name="picture"><br><br>
                    <label for="price">Price:</label><br>
                    <input type="text" name="price" size="15" id="length" required> <br><br>
                    <label for="Address">Address:</label><br>
                    <input type="text" name="address" size="15" id="length" required><br>
                    <label for="distance">Distance:</label> <br>
                    <input type="text" name="distance" id="distance" required> <br>
                    <label for="description">Description:</label> <br>
                    <textarea name="description" id="description" cols="30" rows="10" required></textarea><br><br>
                
                    <input type="submit" name="submit" value="Add">
                </fieldset> <br> <br>
            </form>

        </section>
        

        <footer>
  
    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Use</a></li>
        <li><a href="#">FAQ</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
      <h3>Contact Us</h3>
      <p>Drosty Rd, Grahamstown, Makhanda, 6139</p>
      <p>Phone: 046 603 8111</p>
      <p>Email: info@wedigit.com</p>
    
      <h3>Copyright</h3>
      <p>© 2023 We Dig It. All rights reserved.</p>
  </div>
        </footer>
    </main>
</body>
     </html>