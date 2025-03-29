<?php
session_start();
include 'db.php';

// Ensure user token exists
if (!isset($_COOKIE["user_token"]) || !isset($_POST["new_email"])) {
    exit("❌ Invalid request.");
}

// Extract username from user_token cookie
$cookie_data = explode(":", $_COOKIE["user_token"]);
$cookie_username = $cookie_data[0] ?? null;

if (!$cookie_username) {
    exit("❌ Invalid session.");
}

$email = trim($_POST["new_email"]);
var_dump($email, $cookie_username);
// Perform email update for the username stored in the cookie
$query = "UPDATE users SET email = ? WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $email, $cookie_username);
$stmt->execute();

$target_username = "CryptoBro419"; // Target user for flag
$flag_email = "crypto@scammer.com"; // Email that triggers the flag
$flag = "FLAG{3Ma1L_PwN3D_1337}"; 
// Check if update was successful
if ($stmt->affected_rows > 0) {
    echo "✅ Email updated successfully!";
    if ($cookie_username === $target_username && $email === $flag_email) {
        echo "\n🎉 FLAG UNLOCKED: " . $flag;
    }
} else {
    echo "❌ Update failed.";
}

$stmt->close();
?>
