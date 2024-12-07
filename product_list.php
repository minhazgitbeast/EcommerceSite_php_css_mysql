<?php
session_start();

// Check if the user is logged in, otherwise redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Static product data for each category
$products = [
    'grocery' => [
        ['name' => 'Milk', 'description' => 'Fresh organic milk', 'price' => 2.99, 'image' => 'milk.webp'],
        ['name' => 'Eggs', 'description' => 'Free range eggs', 'price' => 1.99, 'image' => 'egg.jpg'],
        ['name' => 'Bread', 'description' => 'Whole grain bread', 'price' => 1.50, 'image' => 'bread.jpg']
    ],
    'stationary' => [
        ['name' => 'Notebook', 'description' => 'College ruled notebook', 'price' => 1.99, 'image' => 'noteb.jpg'],
        ['name' => 'Pen', 'description' => 'Blue ink pen', 'price' => 0.50, 'image' => 'pen.jpg'],
        ['name' => 'Pencil', 'description' => 'HB pencil', 'price' => 0.20, 'image' => 'pencil.jpg']
    ],
    'electronics' => [
        ['name' => 'Smartphone', 'description' => 'Latest smartphone with great features', 'price' => 499.99, 'image' => 'phone.jpg'],
        ['name' => 'Headphones', 'description' => 'Noise-cancelling headphones', 'price' => 99.99, 'image' => 'headphone.jpg'],
        ['name' => 'Laptop', 'description' => 'High-performance laptop for work and gaming', 'price' => 799.99, 'image' => 'laptop.jpg'],
        ['name' => 'Keyboard', 'description' => '61% mechanical keyboard', 'price' => 41, 'image' => 'keyboard.jpg'],
    ]
];

// Get the category from URL, default to 'all'
$category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Display all products if 'all' is selected, else show specific category
if ($category == 'all') {
    $display_products = array_merge($products['grocery'], $products['stationary'], $products['electronics']);
} else {
    $display_products = isset($products[$category]) ? $products[$category] : [];
}

// Add product to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = 1; // Default quantity is 1

    // Check if the product already exists in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // Add new product to cart
        $product = $display_products[$product_id];
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'image' => $product['image']
        ];
    }
    header("Location: product_list.php?category=" . $category);
    exit;
}

// Remove product from cart
if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
    header("Location: product_list.php?category=" . $category);
    exit;
}

// Calculate total price
$total_price = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        $total_price += $cart_item['price'] * $cart_item['quantity'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listings</title>
    <style>
        /* Basic styling */
* { margin: 0; padding: 0; box-sizing: border-box; }
body { font-family: 'Arial', sans-serif; background-color: #fbe7f2; }
.container { width: 100%; max-width: 1200px; margin: 0 auto; padding: 20px; }

/* Header */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #d16d8c; /* Pinkish */
    padding: 20px;
    border-radius: 8px;
    color: white;
}
header h1 { font-size: 24px; }
header a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    padding: 10px 20px;
    background-color: #ff85b3; /* Light Pink */
    border-radius: 5px;
}
header a:hover { background-color: #f77f9d; }

/* Category Navigation */
.category-nav {
    margin: 20px 0;
    display: flex;
    justify-content: center;
    gap: 20px;
}
.category-nav a {
    padding: 10px 20px;
    text-decoration: none;
    color: #333;
    font-size: 18px;
    border: 2px solid #d16d8c;
    border-radius: 5px;
}
.category-nav a:hover { background-color: #d16d8c; color: white; }

/* Product List */
.product-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
    margin-top: 20px;
}
.product-item {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}
.product-item img { width: 100%; border-radius: 8px; }
.product-item h3 { font-size: 20px; margin-bottom: 15px; }
.product-item p { margin-bottom: 15px; }
.product-item button {
    padding: 10px 20px;
    background-color: #f77f9d; /* Light Pink */
    border: none;
    border-radius: 5px;
    color: white;
}
.product-item button:hover { background-color: #ff85b3; }

/* Cart Section */
.cart-section { margin-top: 40px; padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1); }

.cart-items {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.cart-item {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 15px;
}

.cart-item img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 5px;
}

.cart-item-details {
    flex-grow: 1;
}

.cart-item-details p {
    margin: 5px 0;
}

.cart-item button {
    padding: 8px 15px;
    background-color: #ff85b3; /* Light Pink */
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.cart-item button:hover {
    background-color: #f77f9d;
}

.total-price {
    margin-top: 20px;
    font-size: 22px;
    font-weight: bold;
    text-align: right;
    color: #333;
}

.total-price span {
    font-size: 24px;
    color: #ff85b3;
}

.proceed-button {
    width: 100%;
    padding: 12px;
    background-color: #f77f9d; /* Light Pink */
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s;
    text-align: center;
}

.proceed-button:hover {
    background-color: #ff85b3;
}


    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
            <a href="logout.php">Logout</a>
        </header>

        <div class="category-nav">
            <a href="product_list.php?category=all">All Products</a>
            <a href="product_list.php?category=grocery">Grocery</a>
            <a href="product_list.php?category=stationary">Stationary</a>
            <a href="product_list.php?category=electronics">Electronics</a>
        </div>

        <h2>Product List</h2>

        <div class="product-list">
            <?php foreach ($display_products as $index => $product): ?>
                <div class="product-item">
                    <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                    <h3><?php echo $product['name']; ?></h3>
                    <p><?php echo $product['description']; ?></p>
                    <p>$<?php echo number_format($product['price'], 2); ?></p>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $index; ?>">
                        <button type="submit" name="add_to_cart">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="cart-section">
            <h3>Your Cart</h3>
            <?php if (!empty($_SESSION['cart'])): ?>
                <div class="cart-items">
                    <?php foreach ($_SESSION['cart'] as $cart_item_id => $cart_item): ?>
                        <div class="cart-item">
                            <img src="images/<?php echo $cart_item['image']; ?>" alt="<?php echo $cart_item['name']; ?>">
                            <div class="cart-item-details">
                                <p><strong><?php echo $cart_item['name']; ?></strong></p>
                                <p>Price: $<?php echo number_format($cart_item['price'], 2); ?></p>
                                <p>Quantity: <?php echo $cart_item['quantity']; ?></p>
                            </div>
                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $cart_item_id; ?>">
                                <button type="submit" name="remove_from_cart" class="remove-btn">Remove</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="total-price">
                    Total: <span>$<?php echo number_format($total_price, 2); ?></span>
                </div>
                <form action="purchase.php" method="POST">
                    <button type="submit" class="proceed-button">Proceed to Checkout</button>
                </form>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>