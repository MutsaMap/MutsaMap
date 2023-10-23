<?php

// Assuming you have a connection to the database
include 'dbconnection.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Select Your Digs</h2>

<form action="chooseDigs.php" method="post">
    <label for="digs">Choose your current digs:</label>
    <select name="digs" id="digs">
        <?php
        // Fetch available digs from the database and populate the dropdown menu
        $sql = "SELECT tenants.username, tenants.current_digs_id,digs.digs_id,digs.name_of_digs
        FROM tenants 
        JOIN digs ON tenants.current_digs_id = digs.digs_id WHERE tenants.username= $username";
        $result = mysqli_query($conn, $sql) or die("Error fetching digs: " . mysqli_error($conn));
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<option value=\"" . $row['digs.name_of_digs'] . "\">" . $row['digs.name_of_digs'] . "</option>";
        }
        ?>
    </select>

    <input type="submit" value="Choose Digs">
</form>

<p><?php echo $message; ?></p>

</body>
</html> 
</body>
</html>