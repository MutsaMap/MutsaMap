<?php
// add the database credentials
//require_once("secure.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
<?php
// Start a PHP session
session_start();

// Check if the user is logged in (i.e., if 'tenant_id' is set in the session)
/*if (isset($_SESSION['access'])) {
    // User is logged in, so you can display their personal information
    
    
    
    // Make a connection to the database
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
        or die("ERROR: unable to connect to the database!");

    // Get the tenant ID from the session*/
   // $tenant_id = $_SESSION['tenant_id'];
// Add the database credentials
$tenant_id = $_REQUEST['tenant_id'];
require_once("config.php");
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
or die("ERROR: unable to connect to the database!");
    // Create a SQL query to retrieve the user's information
    $query = "SELECT tenants.name, tenants.email, tenants.contact_number, digs.name_of_digs
              FROM tenants
              INNER JOIN customers
              ON tenants.current_digs_id = digs.digs_id
              WHERE tenants.tenant_id = '$tenant_id' ";
    
    // Execute the query
    $result = mysqli_query($conn, $query) or die("ERROR: unable to execute query!");
    
    // Display the user's information in a table
    echo "<table border='0'>";
    echo "<tr><td>Name</td></tr>";
    echo "<tr><td>Email</td></tr>";
    echo "<tr><td>Contact Number</td></tr>";
    echo "<tr><td>Current Digs</td></tr>";

    // Populate the table with user data
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['name'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $row['email'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $row['contact_number'] . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>" . $row['name_of_digs'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    
    // Close the database connection
    mysqli_close($conn);
    
    echo "<p style=\"color:blue;\">Successful!!</p>";
/*} else {
    // User is not logged in, redirect them to the home page
    header("Location: index1.php");
    exit(); // Make sure to exit the script after the redirection
}*/
?>

</body>
</html>