<?php
session_start(); 
require_once 'db_connect.php'; 

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/ewasteWeb.php#loginSection");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'] ?? ''; // optional or hidden field
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_condition = $_POST['product_condition'];
    $product_price = $_POST['product_price'];
    $seller_id = $_SESSION['user_id'];

    $target_dir = "uploads/sell_products/";  
    $image_name = basename($_FILES["product_image"]["name"]); 
    $image_path = $target_dir . time() . "_" . $image_name;  
    
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $image_path)) {
        $product_image = $image_path;  
    } else {
        die("❌ Failed to upload product image.");  
    }

    $stmt = $conn->prepare("INSERT INTO products_sell (product_id, product_name, product_description, product_condition, product_price, product_image, seller_id) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssssi", $product_id, $product_name, $product_description, $product_condition, $product_price, $image_path, $seller_id);

    if ($stmt->execute()) {
        echo "<p class='success'>Product uploaded successfully!</p>";
    } else {
        echo "<p class='error'>Error uploading the product: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Your Product</title>
    <link rel="stylesheet" href="../styles/popups.css"
</head>
<body class="sellBody">
    <div class="container">
        <h2>Sell Your E-Waste Product</h2>

        <div class="content-wrapper">
            <!-- Left: Upload Form -->
            <div class="form-section">
                <form action="sell.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" value="<?php echo uniqid(); ?>">

                    <label for="product_name">Product Name:</label>
                    <input type="text" id="product_name" name="product_name" required>

                    <label for="product_description">Description:</label>
                    <textarea id="product_description" name="product_description" required placeholder="Describe your product..."></textarea>

                    <label for="product_condition">Condition:</label>
                    <select id="product_condition" name="product_condition" required>
                        <option value="New">New</option>
                        <option value="Used">Used</option>
                    </select>

                    <label for="product_price">Price (₱):</label>
                    <input type="number" id="product_price" name="product_price" step="0.01" required>

                    <label for="product_image">Product Image:</label>
                    <input type="file" id="product_image" name="product_image" accept="image/*" required>

                    <input type="submit" value="Upload Product">
                </form>
            </div>

            <!-- Divider Line -->
            <div class="divider"></div>

            <!-- Right: Uploaded Product Preview -->
            <div class="preview-section">
                <div class="urProducts">
                <h2 style="text-align:left;">Your Products</h2>
                </div>
                <?php
                $result = $conn->query("SELECT * FROM products_sell WHERE seller_id = " . $_SESSION['user_id'] . " ORDER BY product_sell_id DESC");

                if ($result->num_rows > 0) {
                    echo "<div class='product-list'>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='product-card'>";
                        echo "<img src='" . htmlspecialchars($row['product_image']) . "' alt='Product Image'>";
                        echo "<h3>" . htmlspecialchars($row['product_name']) . "</h3>";
                        echo "<p><strong>Status:</strong> " . htmlspecialchars($row['product_status']) . "</p>";
                        echo "<p><strong>Condition:</strong> " . htmlspecialchars($row['product_condition']) . "</p>";
                        echo "<p><strong>Price:</strong> ₱" . number_format($row['product_price'], 2) . "</p>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<p>No products uploaded yet.</p>";
                }
                ?>
            </div>
        </div>
        <a href="userdash.php" class="back-button">← Back</a>
    </div>
</body>
</html>
