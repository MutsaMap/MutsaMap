<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include 'dbconnection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deregister'])) {
    $username = $_SESSION['username'];
    $userType = $_SESSION['user_type']; // Assumes you've set this in the session on login

    if ($userType == "tenant") {
        $deleteSql = "DELETE FROM tenants WHERE username = ?";
    } elseif ($userType == "agent") {
        $deleteSql = "DELETE FROM agents WHERE username = ?";
    } else {
        $message = "Invalid user type.";
        exit;
    }

    // Use prepared statements for better security
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        // Once deleted, log the user out and redirect them to a confirmation page or login page
        session_destroy();
        header("Location: register.php");
        exit;
    } else {
        $message = "Error while trying to deregister: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deregister</title>
</head>
<body>

<h2>Deregister</h2>
<p>Are you sure you want to delete your account? This action is irreversible.</p>

<form action="deregister.php" method="post" onsubmit="return confirm('Are you sure? This action cannot be undone.')">
    <input type="submit" name="deregister" value="Yes">
</form>

<?php
if (!empty($message)) {
    echo "<p>$message</p>";
}
?>

</body>
</html>
