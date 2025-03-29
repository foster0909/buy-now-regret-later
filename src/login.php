<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT id, password, role FROM users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["username"] = $username;

             // Generate a random session token
             $random_string = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 6);
             $user_token = $username . ":" . $row["id"] . ":" . $random_string;
             
             $date = date("Ymd"); 
             $role_string = $row["role"] . $date;
             $encoded_role = base64_encode($role_string);
             setcookie("X-Role", $encoded_role, time() + 3600, "/");

             $random_session_track = base64_encode(random_bytes(8));
            setcookie("X-Session-Track", $random_session_track, time() + 3600, "/");

            // **New: Fake User Preferences Cookie**
            $user_prefs = "dark_mode:1;ads:off";
            setcookie("X-User-Pref", base64_encode($user_prefs), time() + 3600, "/");
             // Set cookie (only used for email change verification)
            setcookie("user_token", $user_token, time() + 3600, "/");

            // Redirect based on role
            if ($row["role"] == "admin") {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid username or passwordd.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Vulnerable Web App</title>
    <link href="styles.css" rel="stylesheet">  
    <style>
        .forgot-btn {
    display: inline-block;
    background: linear-gradient(90deg, #0077cc, #0055aa);
    color: white;
    padding: 10px 15px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: background 0.3s ease, transform 0.2s ease;
}

.forgot-btn:hover {
    background: linear-gradient(90deg, #0055aa, #003388);
    transform: scale(1.05);
}
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label>Username:</label>
            <input type="text" name="username" placeholder="Enter your username" required>
            
            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter your password" required>
            
            <input type="submit" name="login" value="Login">
        </form>
        <p><a href="forgot_password.php"class="forgot-btn" >Forgot Password?</a></p>

        <button onclick="window.location.href='register.php'" style="margin-top: 15px; padding: 10px 18px; border: none; background: linear-gradient(90deg, #ff9900, #ff6600); color: white; border-radius: 12px; cursor: pointer; font-size: 18px; transition: background 0.3s ease; font-weight: 600; width: 100%;">Create an Account</button>
        
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
    </div>
</body>
</html>