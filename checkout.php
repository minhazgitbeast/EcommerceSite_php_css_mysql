<?php
session_start();

// Check if the user is logged in, otherwise redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Initialize the total price and cart details
$total_price = 0;
$cart_items = [];
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        $total_price += $cart_item['price'] * $cart_item['quantity'];
        $cart_items[] = $cart_item;
    }
} else {
    header("Location: product_list.php"); // Redirect to product list if cart is empty
    exit;
}

// Handle order submission (just a placeholder for now)
if (isset($_POST['place_order'])) {
    // Here you would typically save the order to a database, send a confirmation email, etc.
    // For simplicity, we just clear the cart and show a success message.
    unset($_SESSION['cart']);
    $order_success = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        /* Basic styling */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; background-color: #f4f7f6; }
        .container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { display: flex; justify-content: space-between; align-items: center; background-color: #2C6E49; padding: 20px; border-radius: 8px; color: white; }
        header h1 { font-size: 24px; }
        header a { color: white; text-decoration: none; font-size: 16px; padding: 10px 20px; background-color: #FF6F61; border-radius: 5px; transition: background-color 0.3s ease; }
        header a:hover { background-color: #E45545; }
        .checkout-section { margin-top: 40px; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .checkout-section h3 { font-size: 24px; margin-bottom: 20px; }
        .cart-item { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .cart-item p { font-size: 16px; }
        .total-price { font-size: 20px; font-weight: bold; margin-top: 20px; }
        .place-order-btn {
            padding: 15px 30px;
            font-size: 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }
        .place-order-btn:hover { background-color: #45A049; }
        footer { text-align: center; margin-top: 50px; color: #555; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Checkout</h1>
            <a href="logout.php">Logout</a>
        </header>

        <div class="checkout-section">
            <h3>Review Your Order</h3>
            <?php if (count($cart_items) > 0): ?>
                <?php foreach ($cart_items as $cart_item): ?>
                    <div class="cart-item">
                        <p><?php echo $cart_item['name']; ?> - <?php echo $cart_item['quantity']; ?> x $<?php echo number_format($cart_item['price'], 2); ?></p>
                    </div>
                <?php endforeach; ?>
                <div class="total-price">
                    Total: $<?php echo number_format($total_price, 2); ?>
                </div>
                <form method="post">
                    <button type="submit" name="place_order" class="place-order-btn">Place Order</button>
                </form>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>

        <?php if (isset($order_success) && $order_success): ?>
            <div class="checkout-success">
                <p>Your order has been placed successfully!</p>
            </div>
        <?php endif; ?>
        
        <footer>
            <p>&copy; 2024 Your E-Commerce Site</p>
        </footer>
    </div>
</body>
</html>
