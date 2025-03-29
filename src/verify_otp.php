<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_otp = intval($_POST["otp"]);

    if ($entered_otp === intval($_SESSION["stored_otp"])) {
        header("Location: reset_password.php");
        exit();
    } else {
        $error = "❌ Invalid OTP!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
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
        input[type="number"], input[type="password"] {
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
    <form method="post">
       <h2>Enter the OTP:</h2><input type="number" name="otp" placeholder="OTP" required>
        <button type="submit" class="submit-btn">Verify</button>
    </form>
    <?php if (isset($error)) echo "<p>$error</p>"; ?>
</body>
</html>
