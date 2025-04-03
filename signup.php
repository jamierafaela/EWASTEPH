<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="ewasteWeb.css"> <!-- Link to your CSS file -->
</head>

<body>
<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing

    // Check if email already exists
    $check_email = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        echo "Email already registered! Try logging in.";
    } else {
        // Insert new user
        $stmt = $conn->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $password);

        if ($stmt->execute()) {
            echo "<div class='registration-success-container'>
            <div class='registration-success-container1'>
                    <h2 class='success-message'>
                    Registration successful! <a href='preDashboard.php'>Complete your Profile</a>
                    </h2>
                    </div>
                </div>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>


<body>
</html>
