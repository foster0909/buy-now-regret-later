<?php
session_start();
include 'db.php';

// Ensure the X-Role cookie exists
if (!isset($_COOKIE["X-Role"])) {
    exit("❌ Access Denied.");
}

// Decode the base64 cookie
$decoded_role = base64_decode($_COOKIE["X-Role"]);

// Extract role
$expected_role = "admin" . date("Ymd");

if ($decoded_role !== $expected_role) {
    exit("❌ Unauthorized access.");
}

// Fetch users (excluding admin)
$user_query = "SELECT id, username, email, bank_balance, role FROM users WHERE role != 'admin'";
$user_result = $conn->query($user_query);
$users = $user_result->fetch_all(MYSQLI_ASSOC);

// Fetch products
$product_query = "SELECT id, name, price FROM products";
$product_result = $conn->query($product_query);
$products = $product_result->fetch_all(MYSQLI_ASSOC);

// Fetch reviews
$review_query = "SELECT r.id, r.review_text, u.username FROM reviews r JOIN users u ON r.user_id = u.id";
$review_result = $conn->query($review_query);
$reviews = $review_result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Hacker Mode</title>
    <style>
        body {
            font-family: monospace;
            background: black;
            color: #00ff00;
            text-shadow: 0px 0px 5px #00ff00;
        }
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        h1 { text-align: center; }
        .section {
            border: 2px dashed #00ff00;
            padding: 15px;
            margin-bottom: 20px;
        }
        .btn {
            background: #00ff00;
            color: black;
            padding: 5px 10px;
            cursor: pointer;
            border: none;
        }
        .btn:hover {
            background: red;
            color: white;
        }
        .glitch {
            animation: glitch 0.5s infinite;
        }
        @keyframes glitch {
            0% { text-shadow: 2px 2px red; }
            50% { text-shadow: -2px -2px blue; }
            100% { text-shadow: 2px 2px red; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="glitch">👽 Admin Control Panel 👽</h1>
        <h3 class="glitch">Congrats on flag! FLAG{yOu_ArE_ThE_AdMiN}</h3>
        <h4>Chill out a bit!</h4>

        <!-- User Management -->
        <div class="section">
            <h2>Users</h2>
            <table border="1">
                <tr><th>ID</th><th>Username</th><th>Email</th><th>Balance</th><th>Role</th><th>Actions</th></tr>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>$<?= number_format($user['bank_balance'], 2) ?></td>
                        <td><?= ucfirst($user['role']) ?></td>
                        <td>
                            <button class="btn" onclick="deleteUser(<?= $user['id'] ?>)">Delete</button>
                            <button class="btn" onclick="resetBalance(<?= $user['id'] ?>)">Reset Balance</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <!-- Product Management -->
        <div class="section">
            <h2>Products</h2>
            <table border="1">
                <tr><th>ID</th><th>Name</th><th>Price</th><th>Actions</th></tr>
                <?php foreach ($products as $product) { ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td>$<?= number_format($product['price'], 2) ?></td>
                        <td>
                            <button class="btn" onclick="editProduct(<?= $product['id'] ?>)">Edit</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <!-- Review Management -->
        <div class="section">
            <h2>Reviews</h2>
            <table border="1">
                <tr><th>ID</th><th>Product ID</th><th>Review</th><th>User</th><th>Actions</th></tr>
                <?php foreach ($reviews as $review) { ?>
                    <tr>
                        <td><?= $review['id'] ?></td>
                        <td><?= $review['product_id'] ?></td>
                        <td><?= $review['review_text'] ?></td>
                        <td><?= $review['username'] ?></td>
                        <td>
                            <button class="btn" onclick="deleteReview(<?= $review['id'] ?>)">Delete</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <script>
        function deleteUser(userId) {
            if (confirm("Are you sure you want to delete this user?")) {
                fetch('delete_user.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'user_id=' + userId
                }).then(() => location.reload());
            }
        }

        function resetBalance(userId) {
            fetch('reset_balance.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'user_id=' + userId
            }).then(() => location.reload());
        }

        function deleteReview(reviewId) {
            fetch('delete_review.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'review_id=' + reviewId
            }).then(() => location.reload());
        }

        function editProduct(productId) {
            window.location.href = "edit_product.php?product_id=" + productId;
        }
    </script>

</body>
</html>
