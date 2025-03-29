<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"]) || !isset($_POST["product_id"]) || !isset($_POST["review_text"])) {
    echo "❌ Unauthorized request.";
    exit();
}

$user_id = $_SESSION["user_id"];
$product_id = intval($_POST["product_id"]);
$review_text = trim($_POST["review_text"]);

if (empty($review_text)) {
    echo "❌ Review cannot be empty.";
    exit();
}

$query = "INSERT INTO reviews (user_id, product_id, review_text) VALUES (?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("iis", $user_id, $product_id, $review_text);
if ($stmt->execute()) {
    echo "✅ Review submitted!";
} else {
    echo "❌ Failed to submit review.";
}
?>
