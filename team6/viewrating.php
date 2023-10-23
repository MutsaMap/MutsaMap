<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include 'dbconnection.php';

$ratingMessage = "";
$username = $_SESSION['username'];
$ratingSql = "SELECT r.overall_rating, r.comment
FROM ratings r
INNER JOIN tenants t ON r.tenant_id = t.tenant_id
WHERE t.username = '$username'";

$result = mysqli_query($conn, $ratingSql) or die("Error fetching ratings");

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $rating = $row['overall_rating'];
    $comments = $row['comment']; // Fetch the comments
   
    
    $ratingMessage = "Your rating for your current digs is: $rating.<br> Your review: $comments";
} else {
    $ratingMessage = "You haven't rated your current digs yet. <a href='tenantrate.php'>Click here</a> to rate it.";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Ratings</title>
</head>
<body>

<h2>Your Digs Rating</h2>

<p><?php echo $ratingMessage; ?></p>


</body>
</html>
