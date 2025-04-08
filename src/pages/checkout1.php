<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="../styles/checkout.css">
</head>
<body>
    <div class="container">
        <div class="checkoutLayout">

            <!-- Return Cart Summary -->
            <div class="returnCart">
                <a href="../pages/ewasteShop.php">Keep shopping</a>
                <h1>List Product In Cart</h1>
                <div class="list">
                    <?php
                    $cart = [];
                    $totalItems = 0;
                    $totalPrice = 0;

                    if (isset($_GET['cartData'])) {
                        $cart = json_decode(urldecode($_GET['cartData']), true);
                    }

                    if (!empty($cart)) {
                        foreach ($cart as $item) {
                            $itemTotal = $item['price'] * $item['quantity'];
                            $totalItems += $item['quantity'];
                            $totalPrice += $itemTotal;

                            echo '<div class="item">';
                            echo '<img src="' . htmlspecialchars($item['image']) . '" alt="">';
                            echo '<div class="info">';
                            echo '<div class="name">' . htmlspecialchars($item['name']) . '</div>';
                            echo '<div class="price">P ' . number_format($item['price'], 2) . ' / each</div>';
                            echo '</div>';
                            echo '<div class="quantity">Qty: ' . htmlspecialchars($item['quantity']) . '</div>';
                            echo '<div class="returnPrice">P ' . number_format($itemTotal, 2) . '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>Your cart is empty.</p>';
                    }
                    ?>
                </div>
            </div>

            <!-- Checkout Form -->
            <div class="right">
                <h1>CHECKOUT</h1>
                <form action="checkout.php" method="POST" enctype="multipart/form-data">
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
                            <div class="totalQuantity"><?php echo $totalItems; ?></div>
                        </div>
                        <div class="row">
                            <div>Total Price</div>
                            <div class="totalPrice">P <?php echo number_format($totalPrice, 2); ?></div>
                        </div>

                        <!-- Payment Section -->
                        <div class="payment-section">
                            <h2>Select Payment Method</h2>
                            <div class="payment-options">
                                <label>
                                    <input type="radio" name="payment" value="gcash" onclick="showGcashDetails()" required> GCash
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

                    <!-- Submit -->
                    <button class="buttonCheckout" type="submit">CONFIRM CHECKOUT</button>
                </form>
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
