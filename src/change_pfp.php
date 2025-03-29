<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION["user_id"];
$upload_success = "";

// Handle profile picture upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_pic"])) {
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = "user_" . $user_id . "_" . time() . ".jpg";
    $target_file = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
        $query = "UPDATE users SET profile_pic = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $file_name, $user_id);
        if ($stmt->execute()) {
            echo "<script>alert('✅ Profile picture updated!'); window.location.href='user_dashboard.php';</script>";
            exit();
        }
    } else {
        $upload_success = "❌ Failed to upload profile picture.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile Picture</title>
    <link rel="stylesheet" href="styles.css">
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
            backdrop-filter: blur(15px);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 15px;
        }

        .profile-pic {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.2);
        }

        input[type="file"] {
            margin: 15px 0;
            padding: 8px;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 8px;
            width: 100%;
            text-align: center;
        }

        input[type="submit"] {
            background: linear-gradient(90deg, #ff9900, #ff6600);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
            width: 100%;
        }

        input[type="submit"]:hover {
            background: linear-gradient(90deg, #ff6600, #cc5500);
            transform: scale(1.05);
        }

        .back-btn {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s ease;
            width: 100%;
            margin-top: 10px;
        }

        .back-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload New Profile Picture</h2>
        <img src="uploads/<?php echo $_SESSION['profile_pic'] ?? 'default.png'; ?>" alt="Profile Picture" class="profile-pic">
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="profile_pic" required>
            <input type="submit" value="Upload">
        </form>
        <button class="back-btn" onclick="window.location.href='user_dashboard.php'">Back to Dashboard</button>
    </div>
</body>
</html>
