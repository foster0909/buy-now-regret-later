<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"])) {
    echo "You must be logged in to add items to cart.";
    exit();
}

$user_id = $_SESSION["user_id"];
$product_id = $_POST["product_id"] ?? 0;

if ($product_id > 0) {
    $query = "INSERT INTO cart (user_id, product_id) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("ii", $user_id, $product_id);
        if ($stmt->execute()) {
            echo "✅ Item added to cart!";
        } else {
            echo "❌ Error adding item.";
        }
    } else {
        echo "SQL Error: " . $conn->error;
    }
} else {
    echo "❌ Invalid product ID.";
}
?>
