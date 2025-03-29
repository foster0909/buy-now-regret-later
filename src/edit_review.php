<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"])) {
    echo "❌ Unauthorized";
    exit();
}


$review_id = $_POST['review_id'];
$new_text = $_POST['review_text'];

// 🚨 Introducing the vulnerability: No user ID verification
$query = "UPDATE reviews SET review_text = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $new_text, $review_id);

if ($stmt->execute()) {
    // 🚨 If review ID 159 is edited, insert the flag into the review text
    if ($review_id == 159) {
        $flag = "FLAG{R3V111Ew_tAke0v3r_SuCC3SSss}";
        $query = "UPDATE reviews SET review_text = CONCAT(review_text, ' ', ?) WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $flag, $review_id);
        $stmt->execute();
    }

    echo "✅ Review edited successfully!";
} else {
    echo "❌ Failed to edit review.";
}
?>
