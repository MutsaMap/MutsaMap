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
                    <a href="agent.php">Manage</a>
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
        <section class="admin">
            <?php
            // add database credentials
            require_once("config.php");
            // store the id from the previous page
            $digs_ID = $_REQUEST['id'];
            // make connection to database
            $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
                or die("ERROR: unable to connect to database!");
            // issue query instructions
            $query = "SELECT  name_of_digs, cost, address, photo_URL, distance_from_campus, description  FROM digs WHERE digs_id = $digs_ID";
            $result = mysqli_query($conn, $query) or die("ERROR: unable to execute query!");

            while ($row = mysqli_fetch_array($result)) {
                $image = $row['photo_URL'];
                $Name = $row['name_of_digs'];
                $Price = $row['cost'];
                $Address = $row['address'];
                $Distance = $row['distance_from_campus'];
                $Description = $row['description'];
            }
            // close the connection to database
            mysqli_close($conn);
            ?>
            <form action="update.php" method="POST">
                <fieldset>
                    <legend><strong>Update Digs</strong></legend>
                    <table style="width:60%">
                        <tr>
                            <td><img src="pictures/<?php echo $image ?>"></td>
                            <td>
                                <label for="Name">Name:</label><br>
                                <input type="text" name="name" size="50" id="name" value="<?php echo $Name; ?>" required><br>
                                <label for="price">Price:</label><br>
                                <input type="text" name="price" size="15" id="price" value="<?php echo $Price; ?>" required><br>
                                <label for="address">Address: </label> <br>
                                <input type="text" name="address" value="<?php echo $Address; ?>"> <br>
                                <label for="distance">Distance:</label> <br>
                                <input type="text" name="distance" value="<?php echo $Distance; ?>"> <br>
                                <label for="description">Description:</label> <br>
                                <textarea name="description" id="description" cols="30" rows="10" value = '<?php echo $Description; ?>' ></textarea> <br>
                                <input type="hidden" name="digsID" id="digsID" value="<?php echo $digs_ID; ?>">
                                <br>
                                <input type="submit" name="submit" value="Update">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>

        </section>
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