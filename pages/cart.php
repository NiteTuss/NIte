<?php
session_start();
include '../includes/db.php';

// Add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + 1;
}

// Remove from cart
if (isset($_GET['remove'])) {
    $product_id = $_GET['remove'];
    unset($_SESSION['cart'][$product_id]);
}

// Get cart items
$cart = $_SESSION['cart'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Your Cart</h1>
    <div class="cart">
        <?php if (empty($cart)) : ?>
            <p>Your cart is empty.</p>
        <?php else : ?>
            <?php
            $total = 0;
            foreach ($cart as $id => $quantity) {
                $result = $conn->query("SELECT * FROM products WHERE id = $id");
                $product = $result->fetch_assoc();
                $total += $product['price'] * $quantity;
                echo "<div class='cart-item'>
                        <h2>" . $product['name'] . "</h2>
                        <p>Quantity: $quantity</p>
                        <p>Price: $" . ($product['price'] * $quantity) . "</p>
                        <a href='cart.php?remove=$id'>Remove</a>
                      </div>";
            }
            ?>
            <h2>Total: $<?php echo $total; ?></h2>
            <a href="checkout.php">Proceed to Checkout</a>
        <?php endif; ?>
    </div>
</body>
</html>
