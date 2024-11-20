<?php
session_start();
include '../includes/db.php';

$cart = $_SESSION['cart'] ?? [];
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['name'];
    $email = $_POST['email'];

    foreach ($cart as $id => $quantity) {
        $result = $conn->query("SELECT price FROM products WHERE id = $id");
        $product = $result->fetch_assoc();
        $total += $product['price'] * $quantity;
    }

    $sql = "INSERT INTO orders (customer_name, email, total) VALUES ('$customer_name', '$email', '$total')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['cart'] = [];
        header("Location: success.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Checkout</h1>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
