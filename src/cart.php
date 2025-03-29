<?php
session_start();
include 'db.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "user") {
    header("Location: login.php");
    exit();
}


// 🚨 Allow user_id manipulation via GET parameter (Intentional vulnerability)
$requested_user_id = isset($_GET["user_id"]) ? intval($_GET["user_id"]) : $_SESSION["user_id"];


if ($requested_user_id === 33 && $_SESSION["user_id"] !== 33) {
    $flag = "FLAG-{Stalking-Is-Bad}";
} else {
    $flag = null; // No flag if the target isn't 33
}
$user_id = $requested_user_id;


$cart_items = [];
$total_cost = 0;
$tax_rate = 0.10; // 10% tax rate

// Fetch cart items for this user
$query = "SELECT c.id AS cart_id, p.id, p.name, p.price 
          FROM cart c
          JOIN products p ON c.product_id = p.id
          WHERE c.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$cart_items = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Calculate total price
foreach ($cart_items as $item) {
    $total_cost += $item['price'];
}
$total_tax = $total_cost * $tax_rate;
$grand_total = $total_cost + $total_tax;

// Fetch user bank balance
$query = "SELECT bank_balance, total_items_purchased FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Handle AJAX requests
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    header('Content-Type: text/plain');

    // REMOVE ITEM
    if ($_POST["action"] == "remove" && isset($_POST["cart_id"])) {
        $cart_id = intval($_POST["cart_id"]);
        $query = "DELETE FROM cart WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $cart_id, $user_id);
        $stmt->execute();
        $stmt->close();
        
        echo "Item removed";
        exit();
    }

    // PURCHASE ITEMS
    if ($_POST["action"] == "purchase" && isset($_POST["total"])) {
        $manipulated_total = floatval($_POST["total"]); // 🚨 Taking user input (vulnerable!)
    
        if ($user["bank_balance"] >= $manipulated_total) {
            // Deduct balance and update items purchased
            $item_count = count($cart_items);

                    // Check if "Suspicious Red Button" was purchased
        $flag_earned = false;
        foreach ($cart_items as $item) {
            if ($item['name'] == "Suspicious Red Button") {
                $flag_earned = true;
            }
        }

            
            $query = "UPDATE users SET bank_balance = bank_balance - ?, total_items_purchased = total_items_purchased + ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("dii", $manipulated_total, $item_count, $user_id);
            $stmt->execute();
            $stmt->close();
    
            // Clear cart
            $query = "DELETE FROM cart WHERE user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->close();
    
 // If the user bought the red button, give a flag
 if ($flag_earned) {
    echo "Purchase successful! 🎉 FLAG{YoU-PrEssss3d-tHe-BUtT0n}";
} else {
    echo "Purchase successful!";
}
} else {
echo "Insufficient funds!";
}
        exit();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - Buy Now Regret Later</title>
    <link href="styles.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #232f3e, #37475a);
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .cart-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            max-width: 600px;
            width: 90%;
        }
        h1 {
            font-size: 26px;
            margin-bottom: 20px;
        }
        .cart-item {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 10px;
            margin: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .cart-item p {
            margin: 0;
            flex: 1;
            text-align: left;
        }
        .remove-btn {
            background: linear-gradient(90deg, #ff4f4f, #cc0000);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
        }
        .remove-btn:hover {
            background: linear-gradient(90deg, #cc0000, #990000);
        }
        .purchase-section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid rgba(255, 255, 255, 0.3);
        }
        .purchase-btn {
            background: linear-gradient(90deg, #ff9900, #ff6600);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            transition: background 0.3s;
        }
        .purchase-btn:hover {
            background: linear-gradient(90deg, #ff6600, #cc5500);
        }
        .continue-shopping {
            display: block;
            margin-top: 20px;
            color: #ff9900;
            text-decoration: none;
            font-weight: bold;
        }
        .continue-shopping:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="cart-container">
        <h1>Your Cart</h1>
        <div id="cart-items">
            <?php if (!empty($cart_items)) { ?>
                <?php foreach ($cart_items as $item) { ?>
                    <div class="cart-item">
                        <p><?php echo htmlspecialchars($item['name']); ?> - $<?php echo number_format($item['price'], 2); ?></p>
                        <button class="remove-btn" onclick="removeFromCart(<?php echo $item['cart_id']; ?>)">Remove</button>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Your cart is empty. Go add some regretful purchases!</p>
            <?php } ?>
        </div>
        <?php if ($flag) { ?>
    <div style="background: #ff9900; color: black; padding: 10px; margin-top: 20px; font-weight: bold; border-radius: 5px;">
        🎉 Congratulations! You've found a flag: <code><?php echo $flag; ?></code>
    </div>
<?php } ?>


        <!-- Total Calculation -->
        <div class="purchase-section">
    <p><strong>Subtotal:</strong> $<span id="subtotal"><?php echo number_format($total_cost, 2); ?></span></p>
    <p><strong>Tax (10%):</strong> $<span id="tax"><?php echo number_format($total_tax, 2); ?></span></p>
    <p><strong>Grand Total:</strong> 
        $<span id="grand-total"><?php echo number_format($grand_total, 2); ?></span>
    </p>

    <!-- 🚨 Hidden input field allows price manipulation -->
    <input type="hidden" id="total" name="total" value="<?php echo number_format($grand_total, 2); ?>">

    <button class="purchase-btn" onclick="purchaseItems()">Purchase</button>
</div>
<a href="index.php" class="continue-shopping">Continue Shopping</a>
</div>                
    
    <script>
        function removeFromCart(cartId) {
            fetch('cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({ action: 'remove', cart_id: cartId })
            })
            .then(response => response.text())
            .then(data => {
                alert(data);
                location.reload();
            });
        }

        function purchaseItems() {
        let total = document.getElementById("total").value; // 🚨 User can modify this value via DevTools

        fetch('cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ action: 'purchase', total: total }) // 🚨 Passing total in POST request
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();
        });
    }
    </script>
</body>
</html>
