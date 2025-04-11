<?php
// 1. CONNECT TO DATABASE
$conn = new mysqli("localhost", "root", "", "ewaste_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>EWastePH SHOP</title>
    <link rel="stylesheet" href="../styles/ewasteShop.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Jersey+10&family=Jersey+25&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <form>
            <nav class="navbar">
                <div class="logo-container">
                    <button formaction="../pages/ewasteWeb.php" class="logo"><img src="../../Public/images/logo.png" alt="EWastePH Logo" /></button>
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
            <input type="text" id="search-bar" placeholder="Search products..." class="search-bar" />
            <select id="category-filter" class="category-filter">
                <option value="all">All Categories</option>
                <option value="motherboard">Motherboard</option>
                <option value="processor">Processor</option>
                <option value="ram">RAM</option>
                <option value="keyboard">Keyboard</option>
                <option value="laptop">Laptop</option>
                <option value="monitor">Monitor</option>
                <option value="hdd">HDD/SDD</option>
                <option value="usb">USB</option>
                <option value="batteries">Batteries</option>
                <option value="coolingFans">Cooling Fans</option>
                <option value="smartphones">Smartphones</option>
                <option value="tablets">Tablets</option>
                <option value="player">Player</option>
                <option value="chargers">Chargers</option>
            </select>

            <div class="iconCart" onclick="toggleCart()">
                <div class="cartIcon"><i class="fas fa-cart-plus"></i></div>
                <div class="totalQuantity">0</div>
            </div>
        </div>

        <div class="container">
            <div class="new-products">
                <h3>Latest Available Items</h3>
                <div class="product-grid" id="product-list">
                <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <div class="product-card" data-category="<?= htmlspecialchars($row['category']) ?>">
                                <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                                <h3><?= htmlspecialchars($row['name']) ?></h3>
                                <p>P <?= number_format($row['price'], 2) ?></p>
                               
                                <button class="btn add-to-cart" <?= $row['quantity'] <= 0 ? 'disabled' : '' ?>>Add to Cart</button>
                                <button class="btn" <?= $row['quantity'] <= 0 ? 'disabled style="background-color: gray; cursor: not-allowed;"' : '' ?> onclick="<?= $row['quantity'] > 0 ? 'location.href=\'checkout1.php?name=' . urlencode($row['name']) . '&price=' . $row['price'] . '&quantity=1&image=' . urlencode($row['image']) . '\'' : 'return false;' ?>"> Buy</button>
                                
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No products available.</p>
                    <?php endif; ?>

                    

                    
            </div>

            <div class="all-products">
                <h3>All Available Items</h3>
                <div class="product-grid" id="product-list">
                <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <div class="product-card" data-category="<?= htmlspecialchars($row['category']) ?>">
                                <img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                                <h3><?= htmlspecialchars($row['name']) ?></h3>
                                <p>P <?= number_format($row['price'], 2) ?></p>
                                <p>Stock: <?= $row['quantity'] ?></p>
                                <button class="btn add-to-cart" <?= $row['quantity'] <= 0 ? 'disabled' : '' ?>>Add to Cart</button>
                                <a href="checkout1.php?id=<?= $row['id'] ?>&name="add_to_cart<?= urlencode($row['name']) ?>&price=<?= $row['price'] ?> class="btn">Buy</a>
                                
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No products available.</p>
                    <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Cart Section -->
    <div class="cart" id="cart">
        <h2>CART</h2>
        <div class="listCart"></div>
        <div class="buttons">
            <div class="close" onclick="toggleCart()">CLOSE</div>
            <div class="checkout">
                <a id="checkoutLink" href="#">CHECKOUT</a>
            </div>
        </div>
    </div>

    <script>

    function toggleCart() {
        const cart = document.querySelector('.cart');
        cart.style.right = cart.style.right === '0px' ? '-100%' : '0px';
    }

    document.addEventListener("DOMContentLoaded", function () {
        const cart = [];
        const cartContainer = document.querySelector(".listCart");
        const totalQuantity = document.querySelector(".totalQuantity");
        const products = document.querySelectorAll(".product-card");

        // FEATURE: Filter Products Based on Selected Category
        document.getElementById("category-filter").addEventListener("change", function () {
            const selected = this.value;
            products.forEach(product => {
                if (selected === "all" || product.dataset.category === selected) {
                    product.style.display = "block";
                } else {
                    product.style.display = "none";
                }
            });
        });


        document.querySelectorAll(".product-card .btn.add-to-cart").forEach(button => {
            button.addEventListener("click", function () {
                const productCard = button.closest(".product-card");
                const productName = productCard.querySelector("h3").innerText;
                const productPrice = parseFloat(productCard.querySelector("p:first-of-type").innerText.replace("P ", "").replace(",", ""));
                const productImage = productCard.querySelector("img").src;

                // Check if product is already in the cart
                const existingItem = cart.find(item => item.name === productName);
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    cart.push({ name: productName, price: productPrice, image: productImage, quantity: 1 });
                }
                updateCart();
            });
        });

    
        function updateCart() {
            cartContainer.innerHTML = "";
            let total = 0;

            // Display all items in the cart
            cart.forEach((item, index) => {
                total += item.quantity;
                cartContainer.innerHTML += `
                    <div class="item">
                        <img src="${item.image}" alt="${item.name}">
                        <div class="content">
                            <div class="name">${item.name}</div>
                            <div class="price">P ${item.price} / 1 product</div>
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

            
            document.getElementById("checkoutLink").href = "checkout1.php?cartData=" + encodeURIComponent(JSON.stringify(cart));
        }


        function attachQuantityHandlers() {

            document.querySelectorAll(".decrease").forEach(button => {
                button.addEventListener("click", function () {
                    const index = button.getAttribute("data-index");
                    if (cart[index].quantity > 1) {
                        cart[index].quantity--;
                    } else {
                        cart.splice(index, 1); // Remove item if quantity is 1
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
<?php $conn->close(); ?>