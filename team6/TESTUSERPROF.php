<?php
// Start a PHP session
session_start();

// Add the database credentials
require_once("config.php");

// Make a connection to the database
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
    or die("ERROR: unable to connect to the database!");

// Get the tenant ID from the session (you may want to replace this with a specific ID for testing)
$tenant_id = 1;

// Create a SQL query to retrieve the user's information
$query = "SELECT tenants.name, tenants.email, tenants.contact_number, digs.name_of_digs
          FROM tenants
          INNER JOIN digs
          ON tenants.current_digs_id = digs.digs_id
          WHERE tenants.tenant_id = '$tenant_id' ";

// Execute the query
$result = mysqli_query($conn, $query) or die("ERROR: unable to execute query!");

// Display the user's information in a table
echo "<table border='0'>";

// Populate the table with user data
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>Name</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "</tr>";
    
    echo "<tr>";
    echo "<td>Email</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "</tr>";
    
    echo "<tr>";
    echo "<td>Contact Number</td>";
    echo "<td>" . $row['contact_number'] . "</td>";
    echo "</tr>";
    
    echo "<tr>";
    echo "<td>Current Digs</td>";
    echo "<td>" . $row['name_of_digs'] . "</td>";
    echo "</tr>";
}

echo "</table>";


// Close the database connection
mysqli_close($conn);

echo "<p style=\"color:blue;\">Successful!!</p>";
?>
