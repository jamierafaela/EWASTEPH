<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="../../src/styles/popups.css"> 
    <style>
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 20px;
            font-weight: bold;
            color: #555;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .close-btn:hover {
            color: #000;
        }

        .popup-container {
            position: relative;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    include 'db_connect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['full_name'] = $row['full_name'];
                echo "
                <div class='popup-container1'>
                    <div class='popup-container active'>
                        <h2>✅ Login Successful!</h2>
                        <p>Welcome back, " . htmlspecialchars($row['full_name']) . ".</p>
                        <a href='ewasteWeb.php'>Continue</a>
                    </div>
                </div>";
            } else {
                echo "
                <div class='popup-container1'>
                    <div class='popup-container error active'>
                        <h2>❌ Incorrect Password</h2>
                        <p>Please try again.</p>
                        <a href='ewasteWeb.php#profile'>Retry</a>
                    </div>
                </div>
                ";
            }
        } else {
            echo "
                <div class='popup-container1'>
                    <div class='popup-container error active'>
                        <h2>⚠️ User Not Found</h2>
                        <p>Make sure you've signed up.</p>
                        <a href='signup.php'>Sign Up</a>
                    </div>
                </div>
            ";
        }
    }
    ?>

</body>
</html>
