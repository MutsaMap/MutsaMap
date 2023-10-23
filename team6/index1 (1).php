<!doctype html>
<html lang="en">
<link href="index.css" rel="stylesheet" type="text/css">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    </div>
    <form action="search.php" class="d-flex justify-content-start align-items-center" role="search">
    <i class="fa-sharp fa-light fa-magnifying-glass" style="color: #e73c7e;"></i>
        <input type="text" class="form-control" placeholder="Search" name="search">
        <button class="btn btn-outline-success" type="submit" name="submit">Search</button>

    
    <select class="form-select me-2" name="category" style="width: 170px;">
        <option value="">Digs Type</option>
    </select>
    
    <select class="form-select me-2" name="category" style="width: 170px;">
        <option value="">Min Price</option>
    </select>
    
    <select class="form-select me-2" name="category" style="width: 170px;">
        <option value="">Max Price</option>
    </select>
    
    <select class="form-select me-2" name="category" style="width: 170px;">
        <option value="">More Filters</option>
    </select>
      </form>
      <div class="row">
      
        <form action="index1.php" method="POST">
          
        </form>
            
        </div>
    </div>
    </div>
     <a href="#"><input type="button" class="btn btn-outline-success" value="VIEW MORE" ></a>
    
    </div>

    <?php


require_once("config.php");
//connect
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
    or die("<strong style='color: red;'>Could not connect to the database!</strong>");

//issue query instructions
$query = "SELECT * FROM digs";

$results = mysqli_query($conn, $query)
    or die("<strong style='color: red;'>Unable to execute the query</strong>");

// Start the row container
echo "<div class=\"row\">";

// Check if there are any rows returned
if (mysqli_num_rows($results) > 0) {
    // Display cards
    while ($row = mysqli_fetch_array($results)) {
        echo "<div class=\"col-md-4 mb-2 mt-5\">";
        echo "<div class=\"card\" style=\"width: 18rem;\">";
        echo "<img src=\"pictures/" . $row['photo_URL'] . "\">";
        echo "<div class=\"card-body\">";
        echo "<h5 class=\"card-title\">" . "R" . $row['cost'] . "</h5>";
        echo "<p class=\"card-text\">" . $row['name_of_digs'] . "<BR>" . $row['address'] . "</p>";
        echo "<a href=\"view.php?id=" . $row['digs_id'] . "\" class=\"btn btn-primary\" style=\"width: auto;\">VIEW</a>";
        echo "<a href=\"rate.php?id=" . $row['digs_id'] . "\" class=\"btn btn-primary\" style=\"width: auto;\">RATE</a>";
        echo "</div>"; // Close card-body div
        echo "</div>"; // Close card div
        echo "</div>"; // Close col div
    }
} else {
    echo "<p>No results found.</p>";
}

// Close the row container
echo "</div>";
?>


  

    <!--bootstrap js link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" 
    crossorigin="anonymous"></script>
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
