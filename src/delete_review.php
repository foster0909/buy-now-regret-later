<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"])) {
    echo "❌ Unauthorized";
    exit();
}

$review_id = intval($_POST['review_id']);
$user_id = $_SESSION["user_id"];
$role = $_SESSION["role"];

// First, get the owner of the review
$query = "SELECT user_id FROM reviews WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $review_id);
$stmt->execute();
$result = $stmt->get_result();
$review = $result->fetch_assoc();

if (!$review) {
    echo "❌ Review not found.";
    exit();
}

// Allow only if the logged-in user is the owner or an admin
if ($review['user_id'] == $user_id || $role == "admin") {
    $query = "DELETE FROM reviews WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $review_id);
    
    if ($stmt->execute()) {
        echo "✅ Review deleted!";
    } else {
        echo "❌ Failed to delete review.";
    }
} else {
    echo "❌ You are not allowed to delete this review.";
}
?>
