<?php
include('includes/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    $stmt = $pdo->prepare('INSERT INTO users (username, password, email) VALUES (:username, :password, :email)');
    $stmt->execute(['username' => $username, 'password' => $password, 'email' => $email]);

    echo "Registration successful!";
}
?>

<form method="POST">
    Username: <input type="text" name="username" required>
    Password: <input type="password" name="password" required>
    Email: <input type="email" name="email" required>
    <button type="submit">Register</button>
</form>
