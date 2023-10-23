<?php
session_start();

// Assuming you have a connection to the database
include 'dbconnection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $userType = $_POST['user_type'];

    switch ($userType) {
        case 'tenant':
            $sql = "SELECT username, password FROM tenants WHERE username = '$username'";
            break;
        case 'agent':
            $sql = "SELECT username, password FROM agents WHERE username = '$username'";
            break;
        case 'admin':
            $sql = "SELECT username, password FROM admin WHERE username = '$username'";
            break;
        default:
            die("Invalid user type");
    }

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = $userType;
        
        // Redirect based on user type
        if($userType == "tenant") {
            header("Location: tenant.php");
        } elseif($userType == "agent") {
            header("Location: agentslandingpage.php");
        } elseif($userType == "admin") {
            header("Location: admin.php");
        }
        exit;
    } else {
        $message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<link href="login.css" rel="stylesheet" type="text/css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <div class="container">
     <row><h2 class="h2"> LOGIN </h2></row>

    <form class="form" action="login.php" method="post">
    <label for="username" class="required">Username:</label><br>
    <input type="text" id="username" style="width: 400px;" name="username" required placeholder="type in your unique username"><br>
    
    <label for="password"class="required" >Password:</label><br>
    <input type="password" id="password" style="width: 400px;" name="password" required placeholder="********"> <span id="password-toggle" onclick="togglePasswordVisibility()">&#x1F441;</span><br>

    <label for="user_type">Login as:</label><br>
    <select id="user_type" name="user_type" style="width: 400px;" required>
        <option value="tenant">Tenant</option>
        <option value="agent">Agent</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <input type="submit" value="Login">
    <p>Don't have an account? <a href="register.php">Register</a></p>
</form></div>
<script>
        function togglePasswordVisibility() {
    let passwordElem = document.getElementById("password");
    let passwordToggleElem = document.getElementById("password-toggle");

    if (passwordElem.type === "password") {
        passwordElem.type = "text";
        passwordToggleElem.textContent = "👁️";
    } else {
        passwordElem.type = "password";
        passwordToggleElem.textContent = "🔒";
    }
}
</script>
<ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>

<!-- Display an error message if any -->
<?php if (!empty($message)) : ?>
    <p class="error-message"><?php echo $message; ?></p>
<?php endif; ?>

</body>
</html>
