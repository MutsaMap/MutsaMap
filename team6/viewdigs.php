<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
session_start();  // Start the session

require_once("config.php");

if(!isset($_SESSION['username'])) {
    die("Please log in to view this page.");
}
$agent_id=$_SESSION['agent_id'];

$query = "SELECT * FROM digs WHERE agent_id = '$agent_id'";
$digs = mysqli_query($conn, $query) or die("cant connect to database");

if(!$digs) {
    die("Error: " . mysqli_error($conn));
}
?>
<h2>Your Properties</h2>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Price</th>
            <th>Overall Rating</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_assoc($digs)): ?>
        <tr>
            <td><?php echo $row['name_of_digs']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['cost']; ?></td>
            <td><?php echo $row['overall_rating']; ?></td>         


            <td>
                <a href="edit_digs.php?digs_id=<?php echo $row['digs_id']; ?>">Edit</a>
                <a href="delete_digs.php?digs_id=<?php echo $row['digs_id']; ?>">Delete</a>
                <a href="add_photos.php?digs_id=<?php echo $row['digs_id']; ?>">Add Photos</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
    
</body>
</html>