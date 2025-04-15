<?php
session_start(); 
require_once 'db_connect.php'; 

// makes sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../pages/ewasteWeb.php#loginSection");
    exit();
}



require_once 'db_connect.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
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
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .container {
            background-color: white;
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            border-radius: 8px;
            width: 100%;
            max-width: 700px;
            box-sizing: border-box;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        input, textarea, select {
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
        }

        input[type="file"] {
            padding: 6px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 18px;
            padding: 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            text-align: center;
            font-weight: bold;
        }

        .success {
            color: green;
            text-align: center;
            font-weight: bold;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .product-card h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #333;
        }

        .product-card p {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sell Your E-Waste Product</h2>

        <!-- Product Upload Form -->
        <form action="sell.php" method="POST" enctype="multipart/form-data">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>

            <label for="product_description">Description:</label>
            <textarea id="product_description" name="product_description" placeholder="Describe your product in detail..." required></textarea>

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

        
        <h2>Your Products</h2>

        <?php
        $result = $conn->query("SELECT * FROM products_sell ORDER BY product_sell_id DESC");

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
            echo "<p>No products available yet.</p>";
        }
        ?>
    </div>
</body>
</html>

