<?php
session_start();
include 'db_connect.php';  

// Process form aprove/rejct/reset
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id']) && isset($_POST['action'])) {
    $product_id = intval($_POST['product_id']);
    $action = $_POST['action'];
    
  
    if ($action == "approve") {
        $new_status = "Approved";
    } elseif ($action == "reject") {
        $new_status = "Rejected";
    } elseif ($action == "reset") {
        $new_status = "Pending";
    }

    if ($product_id > 0 && in_array($action, ["approve", "reject", "reset"])) {
        $stmt = $conn->prepare("UPDATE products_sell SET product_status = ? WHERE product_sell_id = ?");
        $stmt->bind_param("si", $new_status, $product_id);  

        if ($stmt->execute()) {
            if ($action == "reset") {
                $_SESSION['message'] = "Product #$product_id has been reset to Pending status.";
            } else {
                $_SESSION['message'] = "Product #$product_id has been successfully $new_status.";
            }
        } else {
            $_SESSION['message'] = "Error updating product: " . $conn->error;
        }
        
        $stmt->close(); 
    } else {
        echo "Invalid input data.";
    }
    
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get status
$pending_products = $conn->query("SELECT * FROM products_sell WHERE product_status = 'Pending' ORDER BY created_at DESC");
$approved_products = $conn->query("SELECT * FROM products_sell WHERE product_status = 'Approved' ORDER BY created_at DESC");
$rejected_products = $conn->query("SELECT * FROM products_sell WHERE product_status = 'Rejected' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Products</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f4f1;
        }

        h2 {
            text-align: center;
            color: #2e7d32;
            margin-bottom: 30px;
        }

        h3 {
            color: #2e7d32;
            margin-top: 30px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 30px;
        }

        th, td {
            padding: 12px 10px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background-color: #2e7d32;
            color: white;
            font-weight: 600;
        }

        td {
            color: #333;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 0 2px;
        }

        .approve {
            background-color: #4caf50;
            color: white;
        }

        .approve:hover {
            background-color: #43a047;
        }

        .reject {
            background-color: #f44336;
            color: white;
        }

        .reject:hover {
            background-color: #e53935;
        }
        
        .reset {
            background-color: #ff9800;
            color: white;
        }
        
        .reset:hover {
            background-color: #f57c00;
        }

        a {
            color: #1976d2;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }

        .flash-message {
            padding: 10px;
            margin-bottom: 20px;
            background-color: #e8f5e9;
            border-left: 5px solid #4caf50;
            border-radius: 4px;
            color: #2e7d32;
        }
    </style>
</head>
<body>
    
    <h2>Admin - Products</h2>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="flash-message"><?= $_SESSION['message']; ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!--pending products -->
    <h3>Pending Products</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Condition</th>
            <th>Price (₱)</th>
            <th>Product Image</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while($product = $pending_products->fetch_assoc()): ?>
            <tr>
                <td><?= $product['product_sell_id'] ?></td>
                <td><?= $product['product_name'] ?></td>
                <td><?= $product['product_description'] ?></td>
                <td><?= $product['product_condition'] ?></td>
                <td>₱<?= $product['product_price'] ?></td>
                <td>
                    <?php if (!empty($product['product_image'])): ?>
                        <a href="<?= $product['product_image'] ?>" target="_blank">View</a>
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </td>
                <td><?= $product['product_status'] ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= $product['product_sell_id']; ?>">
                        <input type="hidden" name="action" value="approve">
                        <button class="btn approve" type="submit">Approve</button>
                    </form>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= $product['product_sell_id']; ?>">
                        <input type="hidden" name="action" value="reject">
                        <button class="btn reject" type="submit">Reject</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!--approved products -->
    <h3>Approved Products</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Condition</th>
            <th>Price (₱)</th>
            <th>Product Image</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while($product = $approved_products->fetch_assoc()): ?>
            <tr>
                <td><?= $product['product_sell_id'] ?></td>
                <td><?= $product['product_name'] ?></td>
                <td><?= $product['product_description'] ?></td>
                <td><?= $product['product_condition'] ?></td>
                <td>₱<?= $product['product_price'] ?></td>
                <td>
                    <?php if (!empty($product['product_image'])): ?>
                        <a href="<?= $product['product_image'] ?>" target="_blank">View</a>
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </td>
                <td><?= $product['product_status'] ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= $product['product_sell_id']; ?>">
                        <input type="hidden" name="action" value="reset">
                        <button class="btn reset" type="submit">Reset to Pending</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <!-- rejected products -->
    <h3>Rejected Products</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Condition</th>
            <th>Price (₱)</th>
            <th>Product Image</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while($product = $rejected_products->fetch_assoc()): ?>
            <tr>
                <td><?= $product['product_sell_id'] ?></td>
                <td><?= $product['product_name'] ?></td>
                <td><?= $product['product_description'] ?></td>
                <td><?= $product['product_condition'] ?></td>
                <td>₱<?= $product['product_price'] ?></td>
                <td>
                    <?php if (!empty($product['product_image'])): ?>
                        <a href="<?= $product['product_image'] ?>" target="_blank">View</a>
                    <?php else: ?>
                        N/A
                    <?php endif; ?>
                </td>
                <td><?= $product['product_status'] ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="product_id" value="<?= $product['product_sell_id']; ?>">
                        <input type="hidden" name="action" value="reset">
                        <button class="btn reset" type="submit">Reset to Pending</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>