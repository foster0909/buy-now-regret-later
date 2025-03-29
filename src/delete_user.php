<?php
session_start();
include 'db.php';

if ($_SESSION["role"] != "admin") {
    exit("Unauthorized access.");
}

if (isset($_POST["user_id"])) {
    $user_id = intval($_POST["user_id"]);
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}
?>
