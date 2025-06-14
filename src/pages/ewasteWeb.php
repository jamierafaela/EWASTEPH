<?php
// 1. CONNECT TO DATABASE
$conn = new mysqli("localhost", "root", "", "ewaste_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products ORDER BY product_id DESC";
$result = $conn->query($sql);
?>

<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EWastePH</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="../../src/styles/ewasteWeb.css">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Jersey+10&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Jersey+10&family=Jersey+25&display=swap" rel="stylesheet">

    <!-- JavaScript -->
    <script defer src="../../src/scripts/ewasteWeb.js"></script>
</head>





<body>

    <!-- Header and Navigation -->
    <header>
        <nav class="navbar">
            <div class="logo-container">
                <a href="#home" class="logo"><img src="../../Public/images/logo.png" alt="EWastePH Logo"></a>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#about">About Us</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#contact">Contact Us</a></li>
                <li><a href="ewasteShop.php">Shop</a></li>
                <li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="userdash.php"><i class="fa fa-user"></i></a>
                <?php else: ?>
                    <a href="#profile"><i class="fa fa-user"></i></a>
                <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->

    <!-- Home Section -->
     
    <section id="home" class="section home-section">
        <div class="text-box">
            
            <h1>E-WASTE PH</h1>
            <p>"Old tech, New harm—Dispose responsibly, Save our Planet."</p>
            <div class="cta-buttons">
            <button onclick="handleAction('buy')" class="btn">Buy</button>
            <button onclick="handleAction('sell')" class="btn">Sell</button>

            
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="section about-section">
        <h2>About Us</h2>
        <p>E-Waste Philippines is a dedicated waste management company based in Las Piñas, Philippines. Founded in 2023, we aim to tackle the growing issue of electronic waste responsibly through recycling and reusing e-waste items.</p>
        <div class="mission-vision">
            <div class="mission">
                <h3>Mission</h3>
                <p>Our mission is to transform how the Philippines manages electronic waste, promoting responsible e-waste disposal to protect our environment.</p>
            </div>
            <div class="vision">
                <h3>Vision</h3>
                <p>We envision a cleaner, safer Philippines where e-waste is no longer a threat to health or the environment.</p>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="section faq-section">
        <section class="faq">
            <div class="faq-name">
                <h1 class="faq-header">FAQ</h1>
                <h1 class="faq-header"><b>Need Assistance?</b></h1>
                <h2 class="faq-welcome">
                    Welcome to the E-WastePH Shop FAQ section! Here, we answer your most frequently asked questions about our electronic waste shop, where you can buy and sell e-waste scraps. We’re committed to promoting sustainable practices by giving old electronics a new purpose.
                </h2>
            </div>

            <div class="faq-box">
                <div class="faq-wrapper">
                    <input type="checkbox" class="faq-trigger" id="faq-trigger-1">
                    <label class="faq-title" for="faq-trigger-1">
                        What is E-WastePH Shop?
                        <i class="fa fa-chevron-right"></i>
                    </label>
                    <div class="faq-detail">
                        <p>E-WastePH is a platform that facilitates the buying and selling of electronic waste (e-waste) scraps. Our goal is to help individuals and businesses recycle or repurpose their unused electronics, contributing to a greener future.</p>
                    </div>
                </div>

                <div class="faq-wrapper">
                    <input type="checkbox" class="faq-trigger" id="faq-trigger-2">
                    <label class="faq-title" for="faq-trigger-2">
                        What can I buy at E-WastePH?
                        <i class="fa fa-chevron-right"></i>
                    </label>
                    <div class="faq-detail">
                        <p>You can find:
                        <ul>
                            <li>Refurbished electronics</li>
                            <li>Spare parts for repairs</li>
                            <li>Recyclable materials for DIY projects</li>
                            <li>Rare and vintage electronic components</li>
                        </ul>
                        </p>
                    </div>
                </div>

                <div class="faq-wrapper">
                    <input type="checkbox" class="faq-trigger" id="faq-trigger-3">
                    <label class="faq-title" for="faq-trigger-3">
                        How do I sell my E-Waste?
                        <i class="fa fa-chevron-right"></i>
                    </label>
                    <div class="faq-detail">
                        <p>
                        <ul>
                            <li>Step 1: Create an account on our platform.</li>
                            <li>Step 2: List your e-waste with photos and descriptions.</li>
                            <li>Step 3: Set a price or choose to recycle it for free.</li>
                            <li>Step 4: Connect with buyers or schedule a pickup/drop-off for recycling.</li>
                        </ul>
                        </p>
                    </div>
                </div>

                <div class="faq-wrapper">
                    <input type="checkbox" class="faq-trigger" id="faq-trigger-4">
                    <label class="faq-title" for="faq-trigger-4">
                        Why should I recycle E-Waste?
                        <i class="fa fa-chevron-right"></i>
                    </label>
                    <div class="faq-detail">
                        <p>
                            E-waste contains valuable materials like gold, silver, and copper, but also harmful chemicals that can damage the environment if improperly disposed of. Recycling helps recover these materials and reduces landfill waste.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </section>




    <!-- Contact Section -->
    <section id="contact" class="section contact-section">
        <h2>Contact Us</h2>
        <div class="contact-info">
            <p><strong>Email:</strong> support@ewasteph.org</p>
            <p><strong>Phone:</strong> 0929369606</p>
            <p><strong>Address:</strong> Las Piñas, Philippines</p>
        </div>
        <form class="contact-form">
            <input type="text" placeholder="Name" required>
            <input type="email" placeholder="Email" required>
            <textarea placeholder="Message" rows="5" required></textarea>
            <button type="submit" class="btn">Send</button>
        </form>
    </section>

    <!-- Shop Section -->
    <section id="shop" class="section shop-section">
        <h2>Shop</h2>
        <div class="new-products">
            <h3>Latest Available Items</h3>
            <div class="product-grid" id="product-list">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="product-card" data-category="<?= htmlspecialchars($row['category']) ?>">
                            <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                            <h3><?= htmlspecialchars($row['name']) ?></h3>
                            <p>P <?= number_format($row['price'], 2) ?></p>
                           
                            <button class="btn add-to-cart" <?= $row['quantity'] <= 0 ? 'disabled' : '' ?>>Add to Cart</button>
                            <!--buy will not work when not logged in-->
                            <button class="btn" <?= $row['quantity'] <= 0 ? 'disabled style="background-color: gray; cursor: not-allowed;"' : '' ?> 
                                    onclick="<?= $row['quantity'] > 0 ? ($isLoggedIn ? 'location.href=\'checkout1.php?name=' . urlencode($row['name']) . '&price=' . $row['price'] . '&quantity=1&image=' . urlencode($row['image']) . '\'' : 'document.getElementById(\"loginSection\").scrollIntoView({ behavior: \"smooth\" })') : 'return false;' ?>">Buy
                            </button>

                        </div>
                    <?php endwhile; ?>
                    <?php else: ?>
                        <p>No products available.</p>
                    <?php endif; ?>
            </div>
        </div>

        <form>
            <div class="show-more-container">
                <button type="submit" formaction="ewasteShop.php" class="show-more-btn">Show More in SHOP</button>
            </div>
        </form>
        </div>

    </section>


    <!-- Profile Section -->
    <?php if (!isset($_SESSION['user_id'])): ?>
        <section id="loginSection" class="section profile-section">
            <section class="profile-contents">
                <div class="logIn">

                    <h2 id="formTitle">Log in</h2>
                    <p id="formToggleText">
                        New to site? <a href="#" id="toggleForm">Sign up</a>
                    </p>
                </div>
            <?php endif; ?>
            <div class="continueAcc">
                <!-- PHP Check for Form Handling -->
                <?php
                // Check if there's an error to show
                if (isset($_GET['error'])) {
                    echo "<p style='color: red;'>" . htmlspecialchars($_GET['error']) . "</p>";
                }
                ?>

                <!-- Log In Form -->
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <div id="loginForm">
                        <form action="login.php" method="POST">
                            <input type="hidden" name="signin" value="1">

                            <ul>
                                <li>
                                    <label>Email:</label>
                                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                                </li>
                                <li>
                                    <label> Password:</label>
                                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                                </li>
                                <li>
                                    <button type="submit" class="btn">Log in</button>
                                </li>
                            </ul>
                        </form>
                    </div>
                <?php endif; ?>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <!-- Sign Up Form -->
                    <div id="signupForm" class="hidden">
                        <form action="signup.php" method="POST">
                            <input type="hidden" name="signup" value="1">
                            <ul>
                                <li>
                                    <label>Name:</label>
                                    <input type="text" id="full_name" name="full_name" placeholder="Enter your name" required>
                                </li>
                                <li>
                                    <label>Email:</label>
                                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                                </li>
                                <li>
                                    <label>Password:</label>
                                    <input type="password" id="password" name="password" placeholder="Enter your password" required oninput="validatePasswordMatch()"minlength="8">
                                </li>
                                <li>
                                   <label>Confirm Password:</label>
                                   <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your password" required oninput="validateConfirmPassword(this)" minlength="8">  
                                </li>
                                <li>
                                    <button type="submit" class="btn">Sign up</button>
                                </li>
                            </ul>
                        </form>
                    </div>
            </div>
            </section>
        <?php endif; ?>
        </section>

        <!-- Back to Top Button -->
        <button id="upButton" title="Go to top">
            <i class="fa fa-arrow-up"></i>
        </button>

        <!-- Footer -->
        <footer>
            <p>&copy; 2024 EWastePH. All rights reserved. </p>
            <div class="footer-links">
                <a href="#">Privacy Policy </a>
                <a href="#">Terms of Service</a>
            </div>
            <div class="footer-social">
                <a href="https://www.facebook.com/yourpage" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://twitter.com/yourprofile" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/yourprofile" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>
        </footer>

        <script>

// script for login
  const isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;

  function handleAction(action) {
    if (isLoggedIn) {

      if (action === 'buy') {
        window.location.href = "ewasteShop.php";
      } else if (action === 'sell') {
        window.location.href = "sell.php";
      }
    } else {

      document.getElementById("loginSection").scrollIntoView({ behavior: "smooth" });
    }
  }


//confirmpass
  const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        function validatePassword(input) {
            if (input.value.length < 8 ) {
                input.setCustomValidity("Please enter at least 8 characters for your password.");
            } else {
                input.setCustomValidity("");
            }
            validatePasswordMatch();
        }

        function validateConfirmPassword(input) {
            if (input.value.length < 8 ) {
                input.setCustomValidity("Please enter at least 8 characters for your confirmed password.");
            } else if (passwordInput.value !== confirmPasswordInput.value) {
                input.setCustomValidity("Passwords do not match.");
            } else {
                input.setCustomValidity("");
            }
        }

        function validatePasswordMatch() {
            if (confirmPasswordInput.value.length >= 8 && passwordInput.value !== confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity("Passwords do not match.");
            } else if (confirmPasswordInput.value.length >= 8 && passwordInput.value === confirmPasswordInput.value) {
                confirmPasswordInput.setCustomValidity("");
            }
        }

        passwordInput.addEventListener('input', function() {
            validatePassword(this);
        });

        confirmPasswordInput.addEventListener('input', function() {
            validateConfirmPassword(this);
        });

</script>


</body>

</html>