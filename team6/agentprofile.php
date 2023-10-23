<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

include 'dbconnection.php';

// Fetch user details from the database
$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM agents WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$row = $stmt->get_result()->fetch_assoc();
$stmt->close();

// If the form for profile update is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_profile'])) {
    $name = strtolower(trim($_POST['name']));
    $email = strtolower(trim($_POST['email']));
    $contactNumber = trim($_POST['contact_number']);
    $usernameNew = trim($_POST['username']);

    $stmt = $conn->prepare("UPDATE agents SET name = ?, email = ?, contact_number = ?, username = ? WHERE username = ?");
    $stmt->bind_param("sssss", $name, $email, $contactNumber, $usernameNew, $username);
    if ($stmt->execute()) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }
    $stmt->close();
}

// If the form for password update is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_password'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmNewPassword = $_POST['confirm_new_password'];

    if ($newPassword === $confirmNewPassword) {
        $stmt = $conn->prepare("SELECT password FROM agents WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $resultCheck = $stmt->get_result();
        $rowCheck = $resultCheck->fetch_assoc();
        $stmt->close();

        if (password_verify($currentPassword, $rowCheck['password'])) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE agents SET password = ? WHERE username = ?");
            $stmt->bind_param("ss", $hashedPassword, $username);
            if ($stmt->execute()) {
                echo "Password updated successfully!";
            } else {
                echo "Error updating password: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Current password is incorrect!";
        }
    } else {
        echo "New password and confirmation do not match!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Profile</title>
   
        <style>
        /* Style for the error message and error input */
        .error-message {
            color: red;
            font-weight: bold;
        }
        .error-input {
            border-color: red;
        }
        .required::after {
            content: "* ";
            color: red;
        }
    
    </style>
</head>
<body>


<!-- Display the current user details in a table -->
<h2>Your Profile</h2>
<table border="0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Contact Number</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['username']); ?></td>
            <td><?php echo htmlspecialchars($row['email']); ?></td>
            <td><?php echo htmlspecialchars($row['contact_number']); ?></td>
        </tr>
    </tbody>
</table>

<br>

<!-- Form to edit user details with pre-filled values -->
<h2>Edit Your Profile</h2>
<form action="agentprofile.php" method="post">
    <label for="name">Name:</label><br>
    <input type="text" id="name" style="width: 400px;" name="name" ><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" style="width: 400px;" name="email" ><br>

    <label for="contact_number">Contact Number:</label><br>
    <input type="text" id="contact_number" style="width: 400px;" name="contact_number" ><br>

    <label for="username">Username:</label><br>
    <input type="text" id="username" style="width: 400px;" name="username" ><br>
    <br>

    <input type="submit" name="update_profile" value="Save Changes">
</form>
        <br>
        <br>
        <br>
        

        <h3>Change Password</h3>

<!-- Password Change Form -->
<form action="agentprofile.php" method="post">
    <label for="current_password">Current Password:</label><br>
    <input type="password" id="current_password" style="width: 400px;" name="current_password" required><br>

    <label for="new_password">New Password:</label><br>
    <input type="password" id="new_password" style="width: 400px;" name="new_password" required><br>
   

    <label for="confirm_new_password">Confirm New Password:</label><br>
    <input type="password" id="confirm_new_password" style="width: 400px;" name="confirm_new_password" required><br>
    <br>
    <input type="submit" name="update_password" value="Update Password">

</form>



</body>
</html>
