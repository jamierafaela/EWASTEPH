<?php
include 'db_connect.php';

// Handle form submission (approve/reject)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $action = $_POST['action'];
    $new_status = ($action == "approve") ? "Approved" : "Rejected";

    $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $order_id);

    if ($stmt->execute()) {
        echo "<script>alert('Order updated successfully!'); window.location.href='admin.php';</script>";
        exit();
    } else {
        echo "Error updating order: " . $conn->error;
    }

    $stmt->close();
}

// Fetch all orders
$sql = "SELECT * FROM orders ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid black; text-align: center; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; cursor: pointer; border: none; }
        .approve { background-color: green; color: white; }
        .reject { background-color: red; color: white; }
    </style>
</head>
<body>
    <h2>Admin - Manage Orders</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Payment Method</th>
            <th>Proof</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['full_name'] ?></td>
                <td><?= $row['phone_number'] ?></td>
                <td><?= $row['street'] ?>, <?= $row['city'] ?>, <?= $row['province'] ?>, <?= $row['zipcode'] ?></td>
                <td><?= $row['totalQuantity'] ?></td>   
                <td>₱<?= $row['totalPrice'] ?></td>
                <td><?= $row['payment_method'] ?></td>
                <td>
                    <?php if ($row['proofOfPayment']) { ?>
                        <a href="<?= $row['proofOfPayment'] ?>" target="_blank">View</a>
                    <?php } else { echo "N/A"; } ?>
                </td>
                <td><?= $row['order_status'] ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                        <button class="btn approve" name="action" value="approve">Approve</button>
                        <button class="btn reject" name="action" value="reject">Reject</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
