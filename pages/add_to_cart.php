<?php
session_start();

$product_id = $_POST['product_id'] ?? null;
if (!$product_id) {
    echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
    exit;
}

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add product to the cart
$_SESSION['cart'][$product_id] = ($_SESSION['cart'][$product_id] ?? 0) + 1;

// Generate cart summary
$cart = $_SESSION['cart'];
$total_items = array_sum($cart);

echo json_encode(['success' => true, 'message' => 'Product added to cart!', 'total_items' => $total_items]);
exit;
?>
