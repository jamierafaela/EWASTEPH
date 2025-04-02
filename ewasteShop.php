<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EWastePH SHOP</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="ewasteWeb.css">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Jersey+10&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Jersey+10&family=Jersey+25&display=swap" rel="stylesheet">
    
    <!-- JavaScript -->
    <script defer src="ewasteWeb.js"></script>
</head>

<body>
    <header>
        <form>
        <nav class="navbar">
            <div class="logo-container">
                <button formaction ="ewasteWeb.php" class="logo"><img src="images/logo.png" alt="EWastePH Logo"></button>
            </div>
            <ul class="nav-links">
                <li><a href="ewasteWeb.php#home">Home</a></li>
                <li><a href="ewasteWeb.php#about">About Us</a></li>
                <li><a href="ewasteWeb.php#faq">FAQ</a></li>
                <li><a href="ewasteWeb.php#contact">Contact Us</a></li>
                <li><a href="ewasteShop.php">Shop</a></li>
                <li><a href="#profile"><i class="fa fa-user"></i></a></li>
            </ul>
        </nav>
        </form>
    </header>

    <section id="shop" class="section shop-section">
        <h2>Shop</h2>
        <div class="shop-header">
            <form action="cart.php" method="GET">
                <button type="submit" class="cart-button">
                    <i class="fa fa-shopping-cart"></i>
                </button>
            </form>
            
            <!-- Search Bar -->
            <input type="text" id="search-bar" placeholder="Search products..." class="search-bar">
            
            <!-- Category Filter -->
            <select id="category-filter" class="category-filter">
                <option value="all">All Categories</option>
                <option value="motherboard">Motherboard</option>
                <option value="processor">Processor</option>
                <option value="ram">RAM</option>
                <option value="keyboard">Keyboard</option>
                <option value="laptop">Laptop</option>
                <option value="monitor">Monitor</option>
                <option value="hdd/sdd">HDD/SDD</option>
                <option value="chargers">USB</option>
                <option value="processor">Batteries</option>
                <option value="coolingFans">Cooling Fans</option>
                <option value="smartphones">Smartphones</option>
                <option value="tablets">Tablets</option>
                <option value="player">Player</option>
                <option value="smartphones">Smartphones</option>
                <option value="chargers">Chargers</option>

            </select>
        </div>
        






        <div class="new-products">
            <h3>Latest Available Items</h3>
            <div class="product-grid" id="product-list">
                    <div class="product-card" value="motherboard">
                        <img src="images/productsImg/motherboard1.png" alt="Motherboard">
                        <h3>Motherboard</h3>
                        <p>P 350.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card" value="processor">
                        <img src="images/productsImg/dellCpu.png" alt="Processor">
                        <h3>Dell CPU</h3>
                        <p>P 1,000.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card" value="laptop">
                        <img src="images/productsImg/defected_laptop.png" alt="RAM">
                        <h3>HP defected laptop</h3>
                        <p>P 500.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card" value="Player">
                        <img src="images/productsImg/discplayer.png" alt="RAM">
                        <h3>Disc Player</h3>
                        <p>P 500.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card" value="hardDrive">
                        <img src="images/productsImg/sd.png">
                        <h3>SD sht</h3>
                        <p>P 500.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
             </div>
        </div>


        <div class="all-products">
            <h3>All Available Items</h3>
            <div class="product-grid">
                    <div class="product-card">
                        <img src="images/productsImg/motherboard1.png" alt="Motherboard">
                        <h3>Motherboard</h3>
                        <p>P 350.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card">
                        <img src="images/productsImg/dellCpu.png" alt="Processor">
                        <h3>Dell CPU</h3>
                        <p>P 1,000.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card">
                        <img src="images/productsImg/defected_laptop.png" alt="RAM">
                        <h3>HP defected laptop</h3>
                        <p>P 500.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card">
                        <img src="images/productsImg/discplayer.png" alt="RAM">
                        <h3>Disc Player</h3>
                        <p>P 500.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card">
                        <img src="images/productsImg/sd.png" alt="RAM">
                        <h3>SD sht</h3>
                        <p>P 500.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card">
                        <img src="images/productsImg/discplayer.png" alt="RAM">
                        <h3>Disc Player</h3>
                        <p>P 500.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
                    <div class="product-card">
                        <img src="images/productsImg/sd.png" alt="RAM">
                        <h3>SD sht</h3>
                        <p>P 500.00</p>
                        <button class="btn">Add to Cart</button>
                        <button class="btn">Buy</button>
                    </div>
             </div>
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