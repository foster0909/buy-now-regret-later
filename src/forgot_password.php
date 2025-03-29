<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);

    // Check if email exists & fetch stored OTP
    $query = "SELECT otp FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        $_SESSION["reset_email"] = $email;
        $_SESSION["stored_otp"] = $user["otp"]; // Store OTP for verification
        header("Location: verify_otp.php");
        exit();
    } else {
        $error = "❌ Email not found!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
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
        input[type="email"] {
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
            background: linear-gradient(90deg, #0077cc, #0055aa);
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
            background: linear-gradient(90deg, #0055aa, #003388);
            transform: scale(1.05);
        }
        .error {
            color: #ff4f4f;
            font-size: 14px;
            margin-top: 10px;
        }
        .back-btn {
            background: linear-gradient(90deg, #37475a, #232f3e);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            transition: background 0.3s ease;
        }
        .back-btn:hover {
            background: linear-gradient(90deg, #232f3e, #1a242f);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
   
    <form method="post">
        <h2>Forgot Password?</h2>
        <h3>Enter your email:</h3> <input type="email" name="email" required>
        <button type="submit" class="submit-btn">Continue</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>
