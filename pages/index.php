<?php include '../includes/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Shop</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <header>
        <h1>Welcome to Our Shop</h1>
        <nav>
            <!-- Hoverable Cart -->
            <div class="hover-cart">
                <button class="cart-button">🛒 Cart (<span id="cart-count">0</span>)</button>
                <div class="cart-dropdown" id="cart-dropdown">
                    <h3>Your Cart</h3>
                    <div id="cart-items">
                        <p>Your cart is empty.</p>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="products">
            <?php
            $result = $conn->query("SELECT * FROM products");
            while ($row = $result->fetch_assoc()) {
                echo "
                <div class='product'>
                    <img src='../" . $row['image'] . "' alt='" . $row['name'] . "'>
                    <h2>" . $row['name'] . "</h2>
                    <p>" . $row['description'] . "</p>
                    <p><strong>$" . $row['price'] . "</strong></p>
                    <button class='add-to-cart' data-id='" . $row['id'] . "'>Add to Cart</button>
                </div>";
            }
            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 E-commerce Shop. All rights reserved.</p>
    </footer>

    <script>
        $(document).ready(function() {
            // Add to Cart functionality with AJAX
            $('.add-to-cart').click(function() {
                const productId = $(this).data('id');
                $.post('add_to_cart.php', { product_id: productId }, function(response) {
                    const data = JSON.parse(response);
                    if (data.success) {
                        $('#cart-count').text(data.total_items);
                        alert(data.message);
                        updateCartDropdown();
                    } else {
                        alert('Error: ' + data.message);
                    }
                });
            });

            // Update the hover cart dropdown content
            function updateCartDropdown() {
                $.get('view_cart.php', function(response) {
                    $('#cart-items').html(response);
                });
            }

            // Hover cart dropdown functionality
            $('.cart-button').hover(function() {
                $('#cart-dropdown').toggle();
            });
        });
    </script>
</body>
</html>
