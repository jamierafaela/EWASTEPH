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
                <li><a href="#profile"><i class="fa fa-user"></i></a></li>
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
                    <a href="#shop" class="btn">Buy</a>
                    <a href="#contact" class="btn">Sell</a>
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
                <div class="product-grid">
                    <div class="product-card">
                        <img src="/EWastePH/Public/images/productsImg/motherboard1.png" alt="Motherboard">
                        <h3>Motherboard</h3>
                        <p>P 350.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card">
                        <img src="/EWastePH/Public/images/productsImg/dellCpu.png" alt="Processor">
                        <h3>Dell CPU</h3>
                        <p>P 1,000.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card">
                        <img src="/EWastePH/Public/images/productsImg/defected_laptop.png" alt="RAM">
                        <h3>HP defected laptop</h3>
                        <p>P 500.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card">
                        <img src="/EWastePH/Public/images/productsImg/discplayer.png" alt="RAM">
                        <h3>Disc Player</h3>
                        <p>P 500.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card">
                        <img src="/EWastePH/Public/images/productsImg/sd.png" alt="RAM">
                        <h3>SD sht</h3>
                        <p>P 500.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                </div>
            </div>

            <form>
                <div class="show-more-container">
                    <button type="submit" formaction ="ewasteShop.php" class="show-more-btn">Show More in SHOP</button>
                </div>
            </form>
            </div>
            
        </section>


<!-- Profile Section -->
        <section id="profile" class="section profile-section">
                <section class="profile-contents">
                    <div class="logIn">
                        <h2 id="formTitle">Log in</h2>
                        <p id="formToggleText">
                            New to site? <a href="#" id="toggleForm">Sign up</a>
                        </p>
                    </div>

                    <div class="continueAcc">
                        <!-- PHP Check for Form Handling -->
                        <?php
                        // Check if there's an error to show
                        if (isset($_GET['error'])) {
                            echo "<p style='color: red;'>" . htmlspecialchars($_GET['error']) . "</p>";
                        }
                        ?>

                        <!-- Log In Form -->
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
                                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                                    </li>
                                    <li>
                                        <button type="submit" class="btn">Sign up</button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </section>
                <div class="profile-info hidden">
                    <h2>Welcome, <span id="userName"></span></h2>
                    <p>Your profile information will be displayed here.</p>
                    <button id="logoutBtn" class="btn">Log out</button>
                </div>
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
</body>
</html>