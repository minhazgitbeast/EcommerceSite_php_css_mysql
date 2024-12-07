<?php
session_start();

// Check if the user is logged in, otherwise redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if the cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<h1>Your cart is empty!</h1>";
    echo "<a href='product_list.php'>Go back to shop</a>";
    exit;
}

// Calculate total price and prepare cart details
$total_price = 0;
foreach ($_SESSION['cart'] as $cart_item) {
    $total_price += $cart_item['price'] * $cart_item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body { 
    font-family: 'Arial', sans-serif; 
    background-color: #fbe7f2; /* Soft pink background */
    margin: 0; 
    padding: 0;
    color: #333;
}
.container { 
    max-width: 900px; 
    margin: 50px auto; 
    padding: 30px; 
    background: #fff; 
    border-radius: 15px; 
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    font-size: 16px;
}
h1 { 
    text-align: center; 
    font-size: 2rem;
    color: #d16d8c; /* Pinkish header color */
    margin-bottom: 20px;
}
.cart-details { 
    margin-bottom: 30px; 
}
.cart-item { 
    border-bottom: 1px solid #f7b8d2; /* Lighter pink border */
    padding: 15px 0; 
    display: flex; 
    justify-content: space-between;
    font-size: 1.1rem;
    align-items: center;
}
.cart-item img { 
    width: 80px; 
    height: 80px; 
    object-fit: cover; 
    margin-right: 20px;
    border-radius: 8px;
}
.cart-item p { 
    margin: 0;
    color: #34495e;
}
.cart-item:last-child { 
    border-bottom: none; 
}
.total-price { 
    text-align: right; 
    font-weight: bold; 
    font-size: 1.2rem;
    margin-top: 30px; 
    color: #e74c3c; /* Pinkish red for total price */
}
.btn { 
    display: block; 
    width: auto; /* Auto width to fit the content */
    padding: 12px 18px; /* Decreased padding for a smaller button */
    background-color: #f77f9d; /* Light pink button background */
    color: white; 
    border: none; 
    border-radius: 8px; 
    font-size: 1rem; /* Reduced font size */
    cursor: pointer; 
    text-align: center; 
    text-decoration: none;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    margin-right: 0; /* Remove extra space if any */
}

.btn:hover { 
    background-color: #f55d85; /* Slightly darker pink on hover */
}
.btn:active { 
    background-color: #e14f7c; /* Darker pink on active */
}
.back-link { 
    display: block; 
    text-align: center; 
    margin-top: 20px;
    font-size: 1.1rem;
}
.back-link a { 
    color: #f77f9d; /* Light pink link */
    text-decoration: none; 
}
.back-link a:hover {
    text-decoration: underline;
}


    </style>
</head>
<body>
    <div class="container">
        <h1>Order Summary</h1>
        <div class="cart-details">
            <?php foreach ($_SESSION['cart'] as $cart_item): ?>
                <div class="cart-item">
                    
                    <div>
                        <p><?php echo htmlspecialchars($cart_item['name']); ?></p>
                        <p>$<?php echo number_format($cart_item['price'], 2); ?> x <?php echo $cart_item['quantity']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="total-price">
            Total: $<?php echo number_format($total_price, 2); ?>
        </div>
        <a href="complete_purchase.php" class="btn">Complete Purchase</a>
        <div class="back-link">
            <a href="product_list.php">Go back to shop</a>
        </div>
    </div>
</body>
</html>
