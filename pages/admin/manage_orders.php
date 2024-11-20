<?php include '../includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <h1>Order Management</h1>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM orders");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['customer_name']}</td>
                    <td>{$row['email']}</td>
                    <td>\${$row['total']}</td>
                    <td>{$row['status']}</td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
