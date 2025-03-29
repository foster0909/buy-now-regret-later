<?php
session_start();
include 'db.php';

if ($_SESSION["role"] != "admin") {
    exit("Unauthorized access.");
}

if (isset($_POST["user_id"])) {
    $user_id = intval($_POST["user_id"]);
    $query = "UPDATE users SET bank_balance = 0 WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}
?>
