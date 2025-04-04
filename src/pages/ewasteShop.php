<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EWastePH SHOP</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="../styles/ewasteShop.css">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Jersey+10&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Jersey+10&family=Jersey+25&display=swap" rel="stylesheet">
    
    <!-- JavaScript -->
    <script defer src="../scripts/ewasteWeb.js"></script>
</head>

<body>
    <header>
        <form>
        <nav class="navbar">
            <div class="logo-container">
                <button formaction ="../pages/ewasteWeb.php" class="logo"><img src="../../Public/images/logo.png" alt="EWastePH Logo"></button>
            </div>
            <ul class="nav-links">
                <li><a href="../pages/ewasteWeb.php#home">Home</a></li>
                <li><a href="../pages/ewasteWeb.php#about">About Us</a></li>
                <li><a href="../pages/ewasteWeb.php#faq">FAQ</a></li>
                <li><a href="../pages/ewasteWeb.php#contact">Contact Us</a></li>
                <li><a href="../pages/ewasteShop.php">Shop</a></li>
                <li><a href="../pages/ewasteWeb.php#profile"><i class="fa fa-user"></i></a></li>
            </ul>
        </nav>
        </form>
    </header>

    <section id="shop" class="section shop-section">
        <h2>Shop</h2>
        <div class="shop-header">
            <!--<form action="cart.php" method="GET">
                <button type="submit" formaction="checkout1.php" class="cart-button">
                    <i class="fa fa-shopping-cart"></i>
                </button>
            </form>
            `-->
            
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

            <div class="iconCart" onclick="toggleCart()">
                    <div class="cartIcon">
                        <i class="fas fa-cart-plus" alt="Cart Icon" onclick="toggleCart()"></i>
                    </div>
                    <div class="totalQuantity">0</div>
                </div>
        </div>

        <div class="container">
            <div class="new-products">
                <h3>Latest Available Items</h3>
                <div class="product-grid" id="product-list">
                        <div class="product-card" value="motherboard">
                            <img src="/EWastePH/Public/images/productsImg/motherboard1.png" alt="Motherboard">
                            <h3>Motherboard</h3>
                            <p>P 350.00</p>
                            <button class="btn">Add to Cart</button>
                            <button class="btn">Buy</button>
                        </div>
                        <div class="product-card" value="processor">
                            <img src="/EWastePH/Public/images/productsImg/dellCpu.png" alt="Processor">
                            <h3>Dell CPU</h3>
                            <p>P 1,000.00</p>
                            <button class="btn">Add to Cart</button>
                            <button class="btn">Buy</button>
                        </div>
                        <div class="product-card" value="laptop">
                            <img src="/EWastePH/Public/images/productsImg/defected_laptop.png" alt="RAM">
                            <h3>HP defected laptop</h3>
                            <p>P 500.00</p>
                            <button class="btn">Add to Cart</button>
                            <button class="btn">Buy</button>
                        </div>
                        <div class="product-card" value="Player">
                            <img src="/EWastePH/Public/images/productsImg/discplayer.png" alt="RAM">
                            <h3>Disc Player</h3>
                            <p>P 500.00</p>
                            <button class="btn">Add to Cart</button>
                            <button class="btn">Buy</button>
                        </div>
                        <div class="product-card" value="hardDrive">
                            <img src="/EWastePH/Public/images/productsImg/sd.png">
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
        </div>
    </section>

        <!-- Shopping Cart --> 
    <div class="cart" id="cart">
            <h2>CART</h2>
            <div class="listCart">
                <div class="item">
                    <img src="images/productsImg/motherboard1.png" alt="Motherboard">
                    <div class="content">
                        <div class="name">Product name</div>
                        <div class="price">$50/1 product</div>
                    </div>
                    <div class="quantity">
                        <button>-</button>
                        <span class="value">3</span>
                        <button>+</button>
                    </div>
                </div>
    </div>
    <div class="buttons">
        <div class="close" onclick="toggleCart()">CLOSE</div>
            <div class="checkout">
                <a href="checkout1.php">CHECKOUT</a>
            </div>
        </div>
    </div>


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
// Function to toggle the cart visibility
function toggleCart() {
    const cart = document.querySelector('.cart');
    const cartPosition = cart.style.right === '0px' ? '-100%' : '0px'; // Slide in/out
    cart.style.right = cartPosition;
}

document.addEventListener("DOMContentLoaded", function () {
    const cart = [];
    const cartContainer = document.querySelector(".listCart");
    const totalQuantity = document.querySelector(".totalQuantity");

    document.querySelectorAll(".product-card .btn:first-of-type").forEach((button, index) => {
        button.addEventListener("click", function () {
            const productCard = button.closest(".product-card");
            const productName = productCard.querySelector("h3").innerText;
            const productPrice = productCard.querySelector("p").innerText.replace("P ", "");
            const productImage = productCard.querySelector("img").src;

            let existingProduct = cart.find(item => item.name === productName);
            if (existingProduct) {
                existingProduct.quantity++;
            } else {
                cart.push({ name: productName, price: parseFloat(productPrice), image: productImage, quantity: 1 });
            }

            updateCart();
        });
    });

    function updateCart() {
        cartContainer.innerHTML = "";
        let total = 0;
        cart.forEach((item, index) => {
            total += item.quantity;
            cartContainer.innerHTML += `
                <div class="item">
                    <img src="${item.image}" alt="${item.name}">
                    <div class="content">
                        <div class="name">${item.name}</div>
                        <div class="price">P ${item.price}/1 product</div>
                    </div>
                    <div class="quantity">
                        <button class="decrease" data-index="${index}">-</button>
                        <span class="value">${item.quantity}</span>
                        <button class="increase" data-index="${index}">+</button>
                    </div>
                </div>
            `;
        });

        totalQuantity.innerText = total;
        attachQuantityHandlers();
    }

    function attachQuantityHandlers() {
        document.querySelectorAll(".decrease").forEach(button => {
            button.addEventListener("click", function () {
                const index = button.getAttribute("data-index");
                if (cart[index].quantity > 1) {
                    cart[index].quantity--;
                } else {
                    cart.splice(index, 1);
                }
                updateCart();
            });
        });

        document.querySelectorAll(".increase").forEach(button => {
            button.addEventListener("click", function () {
                const index = button.getAttribute("data-index");
                cart[index].quantity++;
                updateCart();
            });
        });
    }
});

</script>    
</body>
</html>