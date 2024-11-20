<?php
$host = "localhost";
$user = "root";
$password = "";
$db_name = "ecommerce_shop";

$conn = new mysqli($host, $user, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select database
$conn->select_db($db_name);

// Create `products` table
$sql = "CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image VARCHAR(255) DEFAULT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Table `products` created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Create `orders` table
$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table `orders` created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert sample products
$sql = "INSERT INTO products (name, description, price, image)
        VALUES ('Product 1', 'Description for product 1', 10.00, 'assets/images/product1.jpg'),
               ('Product 2', 'Description for product 2', 20.00, 'assets/images/product2.jpg'),
               ('Product 3', 'Description for product 3', 30.00, 'assets/images/product3.jpg')";
$conn->query($sql);

echo "Sample products added.<br>";

$conn->close();
?>
