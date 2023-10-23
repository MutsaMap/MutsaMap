<?php
// add the database credentials
require_once("secure.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant dashboard</title>
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
  
    
</head>
<body>
<header><img src="pictures\we-dig-it-low-resolution-logo-color-on-transparent-background.png" alt="" width="250" height="200">


</header>
   
<?php  
      require_once("config.php");
      $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
      or die("ERROR: unable to connect to the database!");
  
  // Get the tenant ID from the session (you may want to replace this with a specific ID for testing)
  $tenant_id = 1;
  
  // Create a SQL query to retrieve the user's information
  $query = "SELECT * FROM tenants WHERE tenant_id = '$tenant_id' ";
  $result = mysqli_query($conn, $query) or die("ERROR: unable to execute query!");          
  $name=mysqli_fetch_array($result);
 ?>   
 <h1> Welcome,<?php echo $name['name'] ;?>!</h1>
<nav>
            <ul id="adminmenu">
                <li>
                <a href="TESTUSERPROF.php"> View Profile</a>
                </li>
                <li>
                    <a href="editprofile.php">Edit Profile</a>
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

</body>
</html>