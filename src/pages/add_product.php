<?php
session_start();

$conn = new mysqli("localhost", "root", "", "ewaste_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $category = $_POST['category'];
    $image = $_POST['image']; 


    $stmt = $conn->prepare("INSERT INTO products (name, price, quantity, category, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sdiss", $name, $price, $quantity, $category, $image);

    if ($stmt->execute()) {
        echo "<script>alert('Product added successfully!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #2d572c;
            margin-top: 40px;
        }

        form {
            background-color: white;
            max-width: 500px;
            margin: 20px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        input, textarea, select {
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input:focus {
            outline: none;
            border-color: #3c9d47;
            box-shadow: 0 0 5px rgba(60, 157, 71, 0.3);
        }

        button {
            background-color: #3c9d47;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #32863b;
        }

        @media (max-width: 550px) {
            form {
                padding: 20px;
                width: 90%;
            }
        }
    </style>
</head>
<body>

<h2>Add New Product</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="number" step="0.01" name="price" placeholder="Price (e.g. 99.99)" required>
    <input type="number" name="quantity" placeholder="Quantity" required>
    <input type="text" name="category" placeholder="Category" required>
    <input type="text" name="image" placeholder="Image URL" required>
    <button type="submit">Add Product</button>
</form>

</body>
</html>
