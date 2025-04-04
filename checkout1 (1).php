<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <form action="checkout.php" method="POST">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="checkout.css">
    <title>Checkout Page</title>
</head>
<body>
    <div class="container">
        <div class="checkoutLayout">
            <div class="returnCart">
                <a href="/">Keep shopping</a>
                <h1>List Product In Cart</h1>
                <div class="list">
                    <?php
                    if (isset($_POST['cart'])) {
                        foreach ($_POST['cart'] as $item) {
                            echo '<div class="item">';
                            echo '<img src="products/motherboard.png" alt="">'; // You may want to adjust this to use the actual image path
                            echo '<div class="info">';
                            echo '<div class="name">' . htmlspecialchars($item['name']) . '</div>';
                            echo '<div class="price">P ' . htmlspecialchars($item['price']) . '/1 product</div>';
                            echo '</div>';
                            echo '<div class="quantity">' . htmlspecialchars($item['quantity']) . '</div>';
                            echo '<div class="returnPrice">P ' . (htmlspecialchars($item['price']) * htmlspecialchars($item['quantity'])) . '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Your cart is empty.</p>';
                    }
                    ?>
                </div>
            </div>

            <div class="right">
                <h1>CHECKOUT</h1>
                <div class="form">
                    <div class="group">
                        <label for="full-name">Full Name</label>
                        <input type="text" name="full_name" id="full-name" required>
                    </div>
                    <div class="group">
                        <label for="phone-number">Phone Number</label>
                        <input type="text" name="phone_number" id="phone-number" required>
                    </div>
                    <div class="group">
                        <label for="street">Street</label>
                        <input type="text" name="street" id="street" required>
                    </div>
                    <div class="group">
                        <label for="city">City</label>
                        <input type="text" name="city" id="city" required>
                    </div>
                    <div class="group">
                        <label for="province">Province</label>
                        <input type="text" name="province" id="province" required>
                    </div>
                    <div class="group">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" name="zipcode" id="zipcode" required>
                    </div>
                </div>
                <div class="return">
                    <div class="row">
                        <div>Total Quantity</div>
                        <div class="totalQuantity"><?php echo count($_POST['cart']); ?></div>
                    </div>
                    <div class="row">
                        <div>Total Price</div>
                        <div class="totalPrice">
                            <?php
                            $totalPrice = 0;
                            foreach ($_POST['cart'] as $item) {
                                $totalPrice += $item['price'] * $item['quantity'];
                            }
                            echo 'P ' . $totalPrice;
                            ?>
                        </div>
                    </div>
                    <div class="payment-section">
                        <h2>Select Payment Method</h2>
                        <div class="payment-options">
                            <label>
                                <input type="radio" name="payment" value="gcash" onclick="showGcashDetails()"> GCash
                            </label>
                            <label>
                                <input type="radio" name="payment" value="others" onclick="hideGcashDetails()"> Others
                            </label>
                        </div>
                        <div class="gcash-details" id="gcashDetails" style="display:none;">
                            <label for="gcashNumber">GCash Number:</label>
                            <input type="text" id="gcashNumber" name="gcashNumber" placeholder="Enter your GCash number">
                            <label for="gcashName">GCash Account Name:</label>
                            <input type="text" id="gcashName" name="gcashName" placeholder="Enter account holder's name">
                            <div class="upload-proof">
                                <label for="proofOfPayment">Upload Proof of Payment:</label>
                                <input type="file" id="proofOfPayment" name="proofOfPayment">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="buttonCheckout">CHECKOUT</button> 
            </div>
        </div>
    </div>

    <script>
        function showGcashDetails() {
            document.getElementById("gcashDetails").style.display = "flex";
        }

        function hideGcashDetails() {
            document.getElementById("gcashDetails").style.display = "none";
        }
    </script>
</body>
</html>