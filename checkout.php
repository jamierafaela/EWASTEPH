<?php
include 'db_connect.php'; // Data base connections
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = htmlspecialchars($_POST['full_name']);
    $phoneNumber = htmlspecialchars($_POST['phone_number']);
    $street = htmlspecialchars($_POST['street']);
    $city = htmlspecialchars($_POST['city']);
    $province = htmlspecialchars($_POST['province']);
    $zipcode = htmlspecialchars($_POST['zipcode']);

    $sql = "INSERT INTO orders (full_name, phone_number, street, city, province, zipcode)
            VALUES (?, ?, ?, ?, ?, ?)";

    //to prevent SQL injection or hack eme
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $fullName, $phoneNumber, $street, $city, $province, $zipcode);

    if ($stmt->execute()) {
        echo "<h2>Order placed successfully!</h2>";
        echo "<a href='index.html'>Go back to home</a>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request!";
}
?>
