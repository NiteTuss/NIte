<?php
session_start();
include '../includes/db.php';

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    echo "<p>Your cart is empty.</p>";
    exit;
}

echo "<ul>";
foreach ($cart as $id => $quantity) {
    $result = $conn->query("SELECT * FROM products WHERE id = $id");
    $product = $result->fetch_assoc();
    echo "<li>" . $product['name'] . " (x$quantity) - $" . ($product['price'] * $quantity) . "</li>";
}
echo "</ul>";
?>
