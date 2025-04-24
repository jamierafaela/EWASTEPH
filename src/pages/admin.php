<?php 
session_start();
include 'db_connect.php';

// Process form aprove/rejct/reset
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id']) && isset($_POST['action'])) {
    $order_id = $_POST['order_id'];
    $action = $_POST['action'];
    

    if ($action == "approve") {
        $new_status = "Approved";
    } elseif ($action == "reject") {
        $new_status = "Rejected";
    } elseif ($action == "reset") {
        $new_status = "Pending";
    }

    if (isset($new_status)) {
        $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        $stmt->bind_param("si", $new_status, $order_id);

        if ($stmt->execute()) {
            if ($action == "reset") {
                $_SESSION['message'] = "Order #$order_id has been reset to Pending status.";
            } else {
                $_SESSION['message'] = "Order #$order_id has been successfully $new_status.";
            }
        } else {
            $_SESSION['message'] = "Error updating order: " . $conn->error;
        }

        $stmt->close();
    }
    

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get status
$pending_orders = $conn->query("SELECT * FROM orders WHERE order_status = 'Pending' ORDER BY order_date DESC");
$approved_orders = $conn->query("SELECT * FROM orders WHERE order_status = 'Approved' ORDER BY order_date DESC");
$rejected_orders = $conn->query("SELECT * FROM orders WHERE order_status = 'Rejected' ORDER BY order_date DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel - Orders</title>
    <style>
        /*
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

        th,
        td {
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
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
            padding: 12px;
            margin-bottom: 20px;
            text-align: center;
            border-radius: 6px;
            font-weight: bold;
        }
                */
    </style>

    <link rel="stylesheet" href="../../src/styles/adminPage.css">
</head>

<body>
    <div class="adminPage">
        <div class="adminPageTitle">
            <h2>Admin - Orders</h2>
            <?php if (isset($_SESSION['message'])): ?>
                <div class="flash-message"><?= $_SESSION['message']; ?></div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        </div>

        <div class="adminPageContent">
            <!--pending orders -->
            <h3>Pending Orders</h3>
            <div class="pendingTab">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Products</th>
                    <th>Total Price</th>
                    <th>Payment Method</th>
                    <th>Proof</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php while ($order = $pending_orders->fetch_assoc()): ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?= $order['full_name'] ?></td>
                        <td><?= $order['phone_number'] ?></td>
                        <td><?= $order['street'] ?>, <?= $order['city'] ?>, <?= $order['province'] ?>, <?= $order['zipcode'] ?></td>
                        <td>
                            <?php
                            $order_id = $order['order_id'];
                            $product_sql = "SELECT * FROM order_items WHERE order_id = $order_id";
                            $product_result = $conn->query($product_sql);
                            $product_list = "";
                            while ($product = $product_result->fetch_assoc()) {
                                $product_list .= $product['quantity'] . " x " . $product['product_name'] . "<br>";
                            }
                            echo $product_list ? $product_list : "No products";
                            ?>
                        </td>
                        <td>₱<?= $order['totalPrice'] ?></td>
                        <td><?= $order['payment_method'] ?></td>
                        <td>
                            <?php if (!empty($order['proofOfPayment'])): ?>
                                <a href="<?= $order['proofOfPayment'] ?>" target="_blank">View</a>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?= $order['order_status'] ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <input type="hidden" name="action" value="approve">
                                <button class="btn approve" type="submit">Approve</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <input type="hidden" name="action" value="reject">
                                <button class="btn reject" type="submit">Reject</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
            </div>
        </div>

        <div class="adminPageContent">
            <!-- aproved orders -->
            <h3>Approved Orders</h3>
            <div class="approvedTab">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Products</th>
                    <th>Total Price</th>
                    <th>Payment Method</th>
                    <th>Proof</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php while ($order = $approved_orders->fetch_assoc()): ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?= $order['full_name'] ?></td>
                        <td><?= $order['phone_number'] ?></td>
                        <td><?= $order['street'] ?>, <?= $order['city'] ?>, <?= $order['province'] ?>, <?= $order['zipcode'] ?></td>
                        <td>
                            <?php
                            $order_id = $order['order_id'];
                            $product_sql = "SELECT * FROM order_items WHERE order_id = $order_id";
                            $product_result = $conn->query($product_sql);
                            $product_list = "";
                            while ($product = $product_result->fetch_assoc()) {
                                $product_list .= $product['quantity'] . " x " . $product['product_name'] . "<br>";
                            }
                            echo $product_list ? $product_list : "No products";
                            ?>
                        </td>
                        <td>₱<?= $order['totalPrice'] ?></td>
                        <td><?= $order['payment_method'] ?></td>
                        <td>
                            <?php if (!empty($order['proofOfPayment'])): ?>
                                <a href="<?= $order['proofOfPayment'] ?>" target="_blank">View</a>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?= $order['order_status'] ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <input type="hidden" name="action" value="reset">
                                <button class="btn reset" type="submit">Reset to Pending</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
            </div>
        </div>

        <div class="adminPageContent">
            <!--rejected orders -->
            <h3>Rejected Orders</h3>
            <div class="rejectedTab">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Products</th>
                    <th>Total Price</th>
                    <th>Payment Method</th>
                    <th>Proof</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>

                <?php while ($order = $rejected_orders->fetch_assoc()): ?>
                    <tr>
                        <td><?= $order['order_id'] ?></td>
                        <td><?= $order['full_name'] ?></td>
                        <td><?= $order['phone_number'] ?></td>
                        <td><?= $order['street'] ?>, <?= $order['city'] ?>, <?= $order['province'] ?>, <?= $order['zipcode'] ?></td>
                        <td>
                            <?php
                            $order_id = $order['order_id'];
                            $product_sql = "SELECT * FROM order_items WHERE order_id = $order_id";
                            $product_result = $conn->query($product_sql);
                            $product_list = "";
                            while ($product = $product_result->fetch_assoc()) {
                                $product_list .= $product['quantity'] . " x " . $product['product_name'] . "<br>";
                            }
                            echo $product_list ? $product_list : "No products";
                            ?>
                        </td>
                        <td>₱<?= $order['totalPrice'] ?></td>
                        <td><?= $order['payment_method'] ?></td>
                        <td>
                            <?php if (!empty($order['proofOfPayment'])): ?>
                                <a href="<?= $order['proofOfPayment'] ?>" target="_blank">View</a>
                            <?php else: ?>
                                N/A
                            <?php endif; ?>
                        </td>
                        <td><?= $order['order_status'] ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                <input type="hidden" name="action" value="reset">
                                <button class="btn reset" type="submit">Reset to Pending</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
            </div>
        </div>
    </div>
</body>

</html>

<?php $conn->close(); ?>