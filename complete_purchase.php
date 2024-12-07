<?php
session_start();
require 'db.php'; // Include the database configuration file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check if there are items in the cart
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<h1>Your cart is empty!</h1>";
    echo "<a href='product_list.php'>Go back to shop</a>";
    exit;
}

// Retrieve user information
$user_id = $_SESSION['user_id']; // Assuming you store user_id in session
$total_order_price = 0;

// Insert each product into the orderz table
try {
    $pdo->beginTransaction(); // Start a transaction

    foreach ($_SESSION['cart'] as $cart_item) {
        $product_name = $cart_item['name'];
        $quantity = $cart_item['quantity'];
        $price = $cart_item['price'];
        $total_price = $price * $quantity;
        $total_order_price += $total_price;

        // Prepare and execute the insert statement
        $stmt = $pdo->prepare("
            INSERT INTO orderz (user_id, product_name, quantity, price, total_price)
            VALUES (:user_id, :product_name, :quantity, :price, :total_price)
        ");
        $stmt->execute([
            ':user_id' => $user_id,
            ':product_name' => $product_name,
            ':quantity' => $quantity,
            ':price' => $price,
            ':total_price' => $total_price,
        ]);
    }

    $pdo->commit(); // Commit the transaction

    // Clear the cart
    unset($_SESSION['cart']);
} catch (Exception $e) {
    $pdo->rollBack(); // Rollback the transaction if there's an error
    die("Failed to complete purchase: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Completed</title>
    <style>
        body { 
    font-family: Arial, sans-serif; 
    background-color: #fce4ec; /* Light pink background */
    margin: 0; 
    padding: 0; 
}

.container { 
    max-width: 800px; 
    margin: 50px auto; 
    padding: 30px; /* Increased padding for more space */
    background: white; 
    border-radius: 8px; 
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Slightly stronger shadow */
    text-align: center; 
}

h1 { 
    margin-bottom: 20px; 
    font-size: 2rem; /* Larger font size for heading */
    color: #e91e63; /* Pinkish heading color */
}

a { 
    text-decoration: none; 
    color: white; 
    background: #f06292; /* Light pink button background */
    padding: 12px 24px; /* Increased padding for a larger button */
    border-radius: 5px; 
    display: inline-block; 
    font-size: 1.1rem; /* Slightly larger font size for better visibility */
    transition: background-color 0.3s ease; /* Smooth transition for background color */
}

a:hover { 
    background: #ec407a; /* Darker pink on hover */
}

    </style>

</head>
<body>
    <div class="container">
        <h1>Thank You for Your Purchase!</h1>
        <p>Your order has been successfully placed.</p>
        <p>Total Order Price: $<?php echo number_format($total_order_price, 2); ?></p>
        <a href="product_list.php">Return to Shop</a>
    </div>
</body>
</html>
