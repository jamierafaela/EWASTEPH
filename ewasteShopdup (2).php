<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EWastePH SHOP</title>

<!-- Stylesheets -->
<link rel="stylesheet" href="ewasteWebA.css">

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">

<!-- JavaScript -->
<script defer src="ewasteWeb.js"></script>

<style>
/* Cart Styling */
.cart {
    position: fixed;
    top: 0;
    right: -350px; /* Initially hidden */
    width: 300px;
    height: 100vh;
    background: white;
    box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
    transition: right 0.3s ease-in-out;
    padding: 20px;
    overflow-y: auto;
}

/* Show cart when active */
.cart.active {
    right: 0;
}

/* Close Button */
.cart .close {
    background: red;
    color: white;
    padding: 10px;
    text-align: center;
    cursor: pointer;
    margin-top: 10px;
}
</style>

</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo-container">
            <button formaction="ewasteWeb.php" class="logo"><img src="images/logo.png" alt="EWastePH Logo"></button>
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
</header>

<section id="shop" class="section shop-section">
    <h2>Shop</h2>
    <div class="shop-header">
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
        </select>
    </div>

    <div class="container">
        <header>
            <h1>LIST PRODUCT</h1>
            <div class="iconCart" onclick="toggleCart()">
                <img src="icon.png">
                <div class="totalQuantity">0</div>
            </div>
        </header>

        <div class="product-list">
            <h3>Latest Available Items</h3>
            <div class="product-grid" id="product-list">
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
            </div>
        </div>
    </div>
</section>

<!-- Shopping Cart -->
<div class="cart" id="cart">
    <h2>CART</h2>
    <div class="listCart">
        
    </div>
    <div class="buttons">
        <div class="close" onclick="toggleCart()">CLOSE</div>
        <div class="checkout">
            <a href="checkout1.php">CHECKOUT</a>
        </div>
    </div>
</div>

<script>

// Function to toggle cart visibility
function toggleCart() {
    document.getElementById("cart").classList.toggle("active");
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

document.querySelector(".checkout a").addEventListener("click", function (event) {
    event.preventDefault(); // Prevent the default link behavior

    // Retrieve cart data from local storage
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Create a hidden form to submit cart data
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'checkout1.php';

    cart.forEach((item, index) => {
        // Create hidden inputs for each item in the cart
        const inputName = document.createElement('input');
        inputName.type = 'hidden';
        inputName.name = `cart[${index}][name]`;
        inputName.value = item.name;
        form.appendChild(inputName);

        const inputPrice = document.createElement('input');
        inputPrice.type = 'hidden';
        inputPrice.name = `cart[${index}][price]`;
        inputPrice.value = item.price;
        form.appendChild(inputPrice);

        const inputQuantity = document.createElement('input');
        inputQuantity.type = 'hidden';
        inputQuantity.name = `cart[${index}][quantity]`;
        inputQuantity.value = item.quantity;
        form.appendChild(inputQuantity);
    });

    document.body.appendChild(form);
    form.submit(); // Submit the form
});


</script>

</body>
</html>
