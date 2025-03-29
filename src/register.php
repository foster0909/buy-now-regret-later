<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vulnerable Web App</title>
    <link href="styles.css" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("registerForm").addEventListener("submit", function(event) {
                event.preventDefault();
                showSuccessMessage();
            });
        });

        function showSuccessMessage() {
            var popup = document.createElement("div");
            popup.className = "popup";
            popup.innerHTML = "<p>🎉 Registration successful! You can now <a href='login.php' style='color: #fff; text-decoration: underline;'>login</a>.</p><button onclick='closePopup()'>OK</button>";
            document.body.appendChild(popup);
            popup.style.display = "block";
        }

        function closePopup() {
            var popup = document.querySelector(".popup");
            if (popup) {
                popup.style.display = "none";
                document.getElementById("registerForm").submit();
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="registerForm" action="register.php" method="post">
            <label>Username:</label>
            <input type="text" name="username" placeholder="Enter your username" required>
            
            <label>Email:</label>
            <input type="email" name="email" placeholder="Enter your email" required>
            
            <label>Password:</label>
            <input type="password" name="password" placeholder="Create a password" required>
            
            <input type="submit" value="Register">
        </form>
        <button onclick="window.location.href='login.php'" style="margin-top: 15px; padding: 10px 18px; border: none; background: linear-gradient(90deg, #ff9900, #ff6600); color: white; border-radius: 12px; cursor: pointer; font-size: 18px; transition: background 0.3s ease; font-weight: 600; width: 100%;">Back to Login</button>
    </div>
</body>
</html>



<?php
include 'db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT); // Hash password

    // Insert into database
    $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: Could not register user. " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
