<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $email = $_SESSION["reset_email"];

    $query = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $new_password, $email);
    $stmt->execute();

    session_destroy();
    echo "<script>alert('✅ Password Reset Successfully!'); window.location.href='login.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #232f3e, #37475a);
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 400px;
            width: 90%;
        }
        input[type="password"] {
            width: 95%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-align: center;
        }
        .submit-btn {
            background: linear-gradient(90deg, #ff9900, #ff6600);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            transition: background 0.3s ease, transform 0.2s ease;
        }
        .submit-btn:hover {
            background: linear-gradient(90deg, #ff6600, #cc5500);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="post">
        <label>New Password:</label>
        <input type="password" name="password" placeholder="Create a new password" required>
        <button type="submit" class="submit-btn">Reset</button>
    </form>
</body>
</html>
