<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="../../src/styles/ewasteWeb.css"> 
</head>

<body>
    <form>
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
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['full_name'] = $row['full_name'];
                echo "<div class='logIn-success-container'>
                <div class='registration-success-container1'>
                        <h2 class='success-message'>
                        Log In Completed !</h2> <a href='ewasteWeb.php'>Continue</a>
                        </div>
                    </div>";
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "User not found!";
        }
    }
    ?>


    </form>
</body>
</html>
