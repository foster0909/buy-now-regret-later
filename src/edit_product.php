<?php
session_start();
include 'db.php';

if ($_SESSION["role"] != "admin") {
    exit("Unauthorized access.");
}

if (!isset($_GET["product_id"])) {
    exit("Invalid request.");
}

$product_id = intval($_GET["product_id"]);

// Fetch product details
$query = "SELECT name, price FROM products WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = trim($_POST["name"]);
    $new_price = floatval($_POST["price"]);

    $query = "UPDATE products SET name = ?, price = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdi", $new_name, $new_price, $product_id);
    $stmt->execute();

    echo "<script>alert('Product updated successfully!'); window.location.href='admin_dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - Admin</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&display=swap');

        body {
            font-family: 'Orbitron', sans-serif;
            background: #0a0a0a;
            color: #00ffcc;
            text-align: center;
            padding: 50px;
        }

        .container {
            background: rgba(0, 255, 204, 0.1);
            border: 2px solid #00ffcc;
            padding: 20px;
            width: 400px;
            margin: auto;
            box-shadow: 0px 0px 15px rgba(0, 255, 204, 0.3);
            border-radius: 10px;
            backdrop-filter: blur(5px);
        }

        h2 {
            color: #00ffcc;
            text-shadow: 0 0 10px #00ffcc;
        }

        label {
            display: block;
            margin-top: 10px;
            font-size: 14px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin-top: 5px;
            background: black;
            color: #00ffcc;
            border: 1px solid #00ffcc;
            border-radius: 5px;
            text-align: center;
            font-size: 16px;
            transition: 0.3s;
        }

        input:focus {
            box-shadow: 0px 0px 10px #00ffcc;
            outline: none;
        }

        .btn {
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-save {
            background: #00ffcc;
            color: black;
            font-weight: bold;
            box-shadow: 0 0 10px #00ffcc;
        }

        .btn-save:hover {
            background: #007766;
            color: white;
        }

        .btn-cancel {
            background: #ff4444;
            color: black;
            font-weight: bold;
            box-shadow: 0 0 10px #ff4444;
        }

        .btn-cancel:hover {
            background: #aa0000;
            color: white;
        }

        .glitch {
            font-size: 24px;
            font-weight: bold;
            color: #00ffcc;
            text-shadow: 0 0 5px #00ffcc, 0 0 15px #00ffcc, 0 0 20px #00ffcc;
            animation: glitch 1s infinite alternate;
        }

        @keyframes glitch {
            0% { transform: skewX(-5deg); }
            100% { transform: skewX(5deg); }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="glitch">EDIT PRODUCT 🛠️</h2>
        <form method="post">
            <label>Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>">

            <label>Price ($):</label>
            <input type="number" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>">

            <button type="submit" class="btn btn-save">💾 Save Changes</button>
        </form>
        <button onclick="window.location.href='admin_dashboard.php'" class="btn btn-cancel">❌ Cancel</button>
    </div>
</body>
</html>

