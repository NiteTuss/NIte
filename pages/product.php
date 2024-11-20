<?php
include('includes/db.php');

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id');
$stmt->execute(['id' => $id]);
$product = $stmt->fetch();
?>

<h1><?= $product['name']; ?></h1>
<img src="assets/images/<?= $product['image']; ?>" alt="<?= $product['name']; ?>">
<p><?= $product['description']; ?></p>
<p>$<?= $product['price']; ?></p>

<form method="POST" action="cart.php">
    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
    Quantity: <input type="number" name="quantity" min="1" value="1">
    <button type="submit">Add to Cart</button>
</form>
