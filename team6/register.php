
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="register.css" rel="stylesheet" type="text/css">
    <title>Register</title>
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
<form action="register.php" method="post" onsubmit="return validateForm()">
<p>Please fill in the following information. Fields marked with <span class="required"></span> are required.</p>

    <label for="name" class="required">Name:</label><br>
    <input type="text" style="width: 400px;" id="name" name="name" required pattern="[A-Za-z\s]+" title="Name should only contain letters and spaces"><br>

    <label for="email" class="required">Email:</label><br>
    <input type="email" style="width: 400px;" id="email" name="email" required pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z0-9._%+\-]{2,}$" title="Please enter a valid email address"><br>

    <label for="password" class="required">Password:</label><br>
    <input type="password" style="width: 402px;" id="password" name="password" required minlength="8" title="Password should be at least 8 characters long and include at least one special character">
    <span id="password-toggle" onclick="togglePasswordVisibility()">&#x1F441;</span><br>

    
    <label for="contact_number" class= "required">Contact Number:</label><br>
    <input type="text" style="width: 400px;" id="contact_number" name="contact_number" placeholder="e.g. 0777777779" required pattern="[0-9]{10}" title="Contact number should only 10 contain numbers"><br>


    <label for="user_type" class="required">Select what you are registering as:</label><br>
    <select id="user_type" style="width: 400px;" name="user_type" required>
    <option value="tenant">Tenant</option>
    <option value="agent">Agent</option>
</select><br><br>

    <!-- A placeholder for the important username message -->
    <h4 class="unheading">Choose a username</h4>

    <label for="username">Username:</label><br>
    <label for="username" class="error-message" id="username-message"><i><small>Remember, you will use the username every time you log in.</small></i></label><br>
    <input type="text" style="width: 400px;" id="username" name="username" required pattern="^[A-Za-z\s\-'_]+$" title="Username can contain letters, spaces, hyphens, and underscores"><br>

    <div style="text-align: center;">
        <input type="submit" value="Register" style="margin-top: 10px;">
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</form>

<script>
function validateForm() {
    let usernameElem = document.getElementById("username");
    let passwordElem = document.getElementById("password");
    let valid = true;

    if (usernameElem.value === '') {
        usernameElem.classList.add("error-input");
        valid = false;
    } else {
        usernameElem.classList.remove("error-input");
    }

    if (passwordElem.value.length < 8) {
        passwordElem.classList.add("error-input");
        valid = false;
    } else {
        passwordElem.classList.remove("error-input");
    }

    return valid;
}

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

<?php
// Assuming you have a connection to the database
include 'dbconnection.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = trim($_POST['username']); // Trim whitespace from username
    $name = trim($_POST['name']); // Trim whitespace from name
    $email = trim($_POST['email']); // Trim whitespace from email
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $contactNumber = trim($_POST['contact_number']); // Trim whitespace from contact number
    $userType = $_POST['user_type'];


    // Check if username already exists in the database
    $sql = "SELECT username FROM tenants WHERE username = '$username'
            UNION
            SELECT username FROM agents WHERE username = '$username'
            UNION
            SELECT username FROM admin WHERE username = '$username'";
            
    $result = mysqli_query($conn, $sql) or die("something went wrong");
    
    if(mysqli_num_rows($result) > 0) {
        $message = "Username already exists. Please choose another.";
        echo "<script>alert('$message'); document.getElementById('username').classList.add('error-input');</script>";
    } else {
        // Depending on user type, insert into the appropriate table
        switch($userType) {
            case 'tenant':
                $insertSql = "INSERT INTO tenants (username, name, email, password, contact_number) VALUES ('$username', '$name', '$email', '$password', '$contactNumber')";
                break;
            case 'agent':
                $insertSql = "INSERT INTO agents (username, name, email, password, contact_number) VALUES ('$username', '$name', '$email', '$password', '$contactNumber')";
                break;
            default:
                die("Invalid user type");
        }
  // Now inside the else block, execute the insertSql
  if (mysqli_query($conn, $insertSql)) {
    $message = "Account created successfully";

    // Depending on user type, redirect to the appropriate page
    switch($userType) {
        case 'tenant':
            header("Location: chooseDigs.php");
            break;
        case 'agent':
            header("Location: login.php");
            break;
        default:
            die("Invalid user type");
    }

    exit; // Make sure to exit after redirection to prevent further execution of the script
} else {
    echo "Error: " . mysqli_error($conn);
}
}
}
?>

</body>
</html>