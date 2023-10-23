<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We Dig It</title>
    
    <!-- bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" 
    crossorigin="anonymous">

    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" 
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" 
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://kit.fontawesome.com/4ccc5e83c2.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<div class="container-fluid.p-0">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index1.php"><img src="pictures\download 2 2.png
    " alt="" width="250" height="200"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
    <form class="form-inline my-2 my-lg-0">
      <a href="admin.php"><input type="button" class="btn btn-outline-success my-2 my-sm-0" value="MY PROFILE" ></a>
      <a href="add.php"><input type="button" class="btn btn-outline-success my-2 my-sm-0" value="ADD DIGS" ></a>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Log Out</button>
    </form>
      
    </div>
  </div>
</nav>
<?php 
$ID = $_REQUEST['id'];
require_once("config.php");
//connect
 $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
  or die("<strong style = 'color: red;'>Could not connect to database!</strong>");

  //issue query instructions
  $query = "SELECT * FROM digs WHERE digs_id = $ID";

  $results = mysqli_query($conn, $query)
  or die("<strong style = 'color: red;'>Unable to exequte query</strong>");
//display
while ($row= mysqli_fetch_array($results)){
    echo "<div class=\"card mb-3\" style=\"max-width: 100%\">";
    echo "<div class=\"row g-0\">";
    echo  "<div class=\"col-md-5\">";
    echo  "<img src=\"...\"" .$row['photo_URL'] . "class=\"img-fluid rounded-start\" alt=\"...\">";
    echo  "</div>";
    echo  "<div class=\"col-md-7\">";
    echo  "<div class=\"card-body\">";
    echo  "<h3 class=\"card-title\">" .$row['name_of_digs'] ."</h3>";
    echo "<p class=\"card-text\">" .$row['description']. "</p>";
     echo "<p class=\"card-text\">" . $row['distance_from_campus'] . "</p>";
     echo "<h5 class = \"price\" >" . "R" . $row['cost'] . "</h5>";
     
     echo "<br>" . "<a href=\"contact.php?id=" . $row['digs_id'] . "\"><input type=\"button\" value=\"Contact Agent\"></a>";
     
      echo  "</div>";
      echo  "</div>";
      echo  "</div>";
      echo  "</div>";
}
mysqli_close($conn);
 ?>

</body>
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
      <p>Email: info@Idigit.com</p>
    
  
    <!-- Copyright -->
    <div class="footer-section">
      <h3>Copyright</h3>
      <p>© 2023 I Dig It. All rights reserved.</p>
    </div>
  </div>
</footer>
</html>