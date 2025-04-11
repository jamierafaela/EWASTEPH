<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Input fields
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zipcode = $_POST['zipcode'];
    $payment_method = $_POST['payment'];

    $totalQuantity = 0;
    $totalPrice = 0;


    $cart = isset($_POST['cartData']) ? json_decode(urldecode($_POST['cartData']), true) : [];

    // Calculate cart 
    foreach ($cart as $item) {
        $quantity = intval($item['quantity']);
        $price = floatval($item['price']);
        $itemTotal = $price * $quantity;

        $totalQuantity += $quantity;
        $totalPrice += $itemTotal;
    }

    $gcashNumber = NULL;
    $gcashName = NULL;
    $proofOfPayment = NULL;

    // If payment method is GCash
    if ($payment_method === "gcash") {
        $gcashNumber = $_POST['gcashNumber'];
        $gcashName = $_POST['gcashName'];


        if (!isset($_FILES['proofOfPayment']) || $_FILES['proofOfPayment']['error'] !== 0) {
            die("❌ Proof of payment is required for GCash transactions.");
        }

        // Upload file
        $target_dir = "uploads/proof/";
        $proof_name = basename($_FILES["proofOfPayment"]["name"]);
        $proof_path = $target_dir . time() . "_" . $proof_name;

        if (move_uploaded_file($_FILES["proofOfPayment"]["tmp_name"], $proof_path)) {
            $proofOfPayment = $proof_path;
        } else {
            die("❌ Failed to upload proof of payment.");
        }
    }

    // Insert into DB 
    $stmt = $conn->prepare("INSERT INTO orders 
        (full_name, phone_number, street, city, province, zipcode, totalQuantity, totalPrice, payment_method, gcashNumber, gcashName, proofOfPayment) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssidsdss", 
        $full_name, $phone_number, $street, $city, $province, $zipcode,
        $totalQuantity, $totalPrice, $payment_method,
        $gcashNumber, $gcashName, $proofOfPayment
    );

    if ($stmt->execute()) {
        echo "✅ Order placed successfully!<br>";
        echo "<a href='ewasteWeb.php'>Go back to home</a>";
        exit;
    } else {
        echo "❌ DB Error: " . $stmt->error;
    }

    $stmt->close();
}




$conn->close();
?>
