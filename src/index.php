<?php
session_start();
include 'db.php';

// Fetch products from the database
$query = "SELECT id, name, description, price, image, rating FROM products";
$result = $conn->query($query);
$products = $result->fetch_all(MYSQLI_ASSOC);

// Check if user is logged in
$is_logged_in = isset($_SESSION["user_id"]);
$user_pfp = $is_logged_in ? "uploads/" . ($_SESSION["profile_pic"] ?? "default.png") : "";
$user_id = $is_logged_in ? $_SESSION["user_id"] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Now Regret Later - Home</title>
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #232f3e, #37475a);
            color: white;
            margin: 0;
            padding: 0;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #111;
            padding: 15px;
            color: white;
        }
        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
            font-weight: bold;
            transition: color 0.3s;
        }
        .navbar a:hover {
            color: #ff9900;
        }
        .navbar-right {
            display: flex;
            align-items: center;
        }
        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-left: 15px;
            border: 2px solid white;
        }
        .container {
            max-width: 1800px;
            margin: auto;
            padding: 20px;
        }
        .product-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            justify-content: center;
        }
        .product-card {
            border: none;
            padding: 15px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }
        .product-card:hover {
            transform: scale(1.015);
        }
        .product-card img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }
        .add-to-cart {
            background: linear-gradient(90deg, #ff9900, #ff6600);
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s;
            font-weight: bold;
        }
        .add-to-cart:hover {
            background: linear-gradient(90deg, #ff6600, #cc5500);
        }
        .rev {
            background: linear-gradient(90deg, #ff9900, #ff6600);
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s;
            font-weight: bold;
        }
        .rev:hover {
            background: linear-gradient(90deg, #ff6600, #cc5500);
        }
/* Improve Review Panel */
.review-section {
    display: none;
    background: rgba(255, 255, 255, 0.1);
    padding: 15px;
    border-radius: 12px;
    text-align: left;
    margin-top: 15px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.2);
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
}
.review-section h4 {
    font-size: 16px;
    margin-bottom: 10px;
    color: #ff9900;
}
/* Make reviews look better */
.review {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(0, 0, 0, 0.2);
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 8px;
}

/* Improve button styling */
.r-btn {
    background: linear-gradient(90deg, #ff9900, #ff6600);
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    font-weight: bold;
    transition: background 0.3s, transform 0.2s;
    display: flex;
    align-items: center;
    gap: 5px;
}
.r-btn:hover {
    background: linear-gradient(90deg, #ff6600, #cc5500);
    transform: scale(1.05);
}
        .review .delete-btn {
            color: #ff4f4f;
        }
        .edit-box {
            width: 100%;
            padding: 5px;
        }
textarea {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    border: none;
    outline: none;
    font-size: 14px;
    resize: none;
}
textarea::placeholder {
    color: rgba(255, 255, 255, 0.6);
}
.submit-review-btn {
    background: linear-gradient(90deg, #ff9900, #ff6600);
    color: white;
    border: none;
    padding: 8px;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    margin-top: 5px;
    width: 100%;
    transition: background 0.3s;
}

.submit-review-btn:hover {
    background: linear-gradient(90deg, #ff6600, #cc5500);
}


    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <a href="index.php">🏠 Home</a>
            <a href="cart.php">🛒 Cart</a>
            <?php if ($is_logged_in) { ?>
                <a href="user_dashboard.php">👤 Dashboard</a>
            <?php } ?>
        </div>
        <div class="navbar-right">
            <?php if ($is_logged_in) { ?>
                <img src="<?php echo $user_pfp; ?>" alt="Profile Picture" class="profile-pic">
                <a href="logout.php">🚪 Logout</a>
            <?php } else { ?>
                <a href="login.php">🔑 Login</a>
                <a href="register.php">✍ Register</a>
            <?php } ?>
        </div>
    </div>

    <div class="container">
        <h1>Welcome to Buy Now Regret Later 🛒</h1>
        <p>The only store where you buy now and question your choices later! Featuring the dumbest, most useless, and absolutely regrettable products!</p>
        <div class="product-list">
            <?php foreach ($products as $product) { ?>
                <div class="product-card">
                    <img src="uploads/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo $product['description']; ?></p>
                    <p><strong>$<?php echo number_format($product['price'], 2); ?></strong></p>
                    <p>⭐ <?php echo number_format($product['rating'], 1); ?> / 5</p>
                    <button class="add-to-cart" onclick="addToCart(<?php echo $product['id']; ?>)">Add to Cart</button>
                    <button class="rev" onclick="toggleReviews(<?php echo $product['id']; ?>)">Check Reviews</button>

                    <div id="reviews-<?php echo $product['id']; ?>" class="review-section">
    <h4>Reviews:</h4>

    <?php 
    // Fetch reviews for this product
    $review_query = "SELECT r.id, r.user_id, r.review_text, u.username 
                     FROM reviews r 
                     JOIN users u ON r.user_id = u.id 
                     WHERE r.product_id = ?";
    $stmt = $conn->prepare($review_query);
    $stmt->bind_param("i", $product['id']);
    $stmt->execute();
    $review_result = $stmt->get_result();
    $reviews = $review_result->fetch_all(MYSQLI_ASSOC);
    ?>

    <div id="review-list-<?php echo $product['id']; ?>">
        <?php if (!empty($reviews)) { ?>
            <?php foreach ($reviews as $review) { ?>
                <div class='review' id="review-<?php echo $review['id']; ?>">
                    <span id="review-text-<?php echo $review['id']; ?>">
                        <?php echo htmlspecialchars($review['review_text']); ?>
                    </span> 
                    <small>- <?php echo htmlspecialchars($review['username']); ?></small>

                    <?php if ($is_logged_in && $user_id == $review['user_id']) { ?>
                        <button class="edit-btn" onclick="editReview(<?php echo $review['id']; ?>, <?php echo $product['id']; ?>)">✏️</button>
                        <button class="delete-btn" onclick="deleteReview(<?php echo $review['id']; ?>, <?php echo $product['id']; ?>)">🗑️</button>
                    <?php } ?>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No reviews yet. Be the first to regret your purchase!</p>
        <?php } ?>
    </div>

    <?php if ($is_logged_in) { ?>
        <textarea id="review-text-<?php echo $product['id']; ?>" placeholder="Write a review..."></textarea>
        <button class="rev" onclick="submitReview(<?php echo $product['id']; ?>)">Submit Review</button>
    <?php } ?>
</div>

</div>
<?php } ?>
</div>
</div>

<script>
    let gg = "https://pastebin.com/92mKVNBB";
    const LOGGED_IN_USER_ID = <?php echo isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : 'null'; ?>;
    console.log("Logged-in User ID:", LOGGED_IN_USER_ID);

            function addToCart(productId) {
            fetch('add_to_cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'product_id=' + productId
            })
            .then(response => response.text())
            .then(data => alert(data));
        }
        
        function toggleReviews(productId) {
const reviewSection = document.getElementById("reviews-" + productId);
if (reviewSection.style.display === "none" || reviewSection.style.display === "") {
reviewSection.style.display = "block";
fetchReviews(productId);
} else {
reviewSection.style.display = "none";
}
}

function fetchReviews(productId) {
    fetch('fetch_reviews.php?product_id=' + productId)
    .then(response => response.json())
    .then(data => {
        let reviewList = document.getElementById("review-list-" + productId);
        reviewList.innerHTML = "";

        data.forEach(review => {
            let reviewHTML = `
                <div class="review" id="review-${review.id}">
                    <span id="review-text-${review.id}">${review.review_text}</span> 
                    <small>- ${review.username}</small>
            `;

            // Verify owner in JavaScript
            console.log("Review ID:", review.id, "User ID:", review.user_id, "Logged-in ID:", LOGGED_IN_USER_ID);

            if (LOGGED_IN_USER_ID !== null && LOGGED_IN_USER_ID == review.user_id) { 
                reviewHTML += `
                    <button class="r-btn" onclick="editReview(${review.id}, ${productId})">✏️ Edit</button>
                    <button class="r-btn" onclick="deleteReview(${review.id}, ${productId})">🗑️ Delete</button>
                `;
            }
            else{
                console.log("failed to get the ID");
            }

            reviewHTML += `</div>`;
            reviewList.innerHTML += reviewHTML;
        });
    });
}

function editReview(reviewId, productId) {
    let reviewText = document.getElementById("review-text-" + reviewId).innerHTML;
    let newText = prompt("Edit your review:", reviewText);

    if (newText !== null && newText.trim() !== "") {
        fetch('edit_review.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `review_id=${reviewId}&review_text=${encodeURIComponent(newText)}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data.includes("✅")) {
                document.getElementById("review-text-" + reviewId).innerHTML = newText;
            }
        });
    }
}

function deleteReview(reviewId, productId) {
    if (confirm("Are you sure you want to delete this review?")) {
        fetch('delete_review.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `review_id=${reviewId}`
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data.includes("✅")) {
                document.getElementById("review-" + reviewId).remove();
            }
        });
    }
}


function submitReview(productId) {
const reviewText = document.getElementById("review-text-" + productId).value;
fetch('submit_review.php', {
method: 'POST',
headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
body: `product_id=${productId}&review_text=${encodeURIComponent(reviewText)}`
})
.then(response => response.text())
.then(data => {
alert(data);
fetchReviews(productId);
});
}


</script>
</body>
</html>