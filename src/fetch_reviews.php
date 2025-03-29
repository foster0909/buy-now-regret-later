<?php
session_start();
include 'db.php';

if (!isset($_GET['product_id'])) {
    echo json_encode([]);
    exit();
}

$product_id = intval($_GET['product_id']);
$query = "SELECT r.id, r.review_text, r.user_id, u.username 
          FROM reviews r 
          JOIN users u ON r.user_id = u.id 
          WHERE r.product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

$reviews = [];
while ($row = $result->fetch_assoc()) {
        $row['is_owner'] = true; 
        $reviews[] = $row;
}

// ✅ Output JSON for frontend
echo json_encode($reviews);
?>
