<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-WastePH User Dashboard</title>
    <link rel="stylesheet" href="../styles/ewasteWeb.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
    
    <div class="userDashSec">
        <div class="container">
            <!-- Sidebar -->
            <aside class="sidebar">
                <!-- Profile Card -->
                <div class="profile-card">
                    <div class="profile-image">
                        <div class="profile-image-placeholder">X</div>
                    </div>
                    <div class="profile-details">
                        <h2 class="username">Username</h2>
                        <a href="#" class="profile-link">Edit Profile</a>
                        <a href="#" class="profile-link">Change Password</a>
                        <button id="logoutBtn" class="btn" onclick="window.location.href='logout.php'">Log out</button>
                    </div>
                </div>
                
                <!-- Sidebar Menu -->
                <div class="sidebar-menu">
                    <div class="sidebar-menu-section">
                        <h3 class="section-title">View</h3>
                        <a href="#" class="sidebar-link">Likes<i class="fas fa-heart"></i></a>
                        <a href="#" class="sidebar-link">Wishlist<i class="fas fa-star"></i></a>
                        <a href="#" class="sidebar-link">My Purchases<i class="fas fa-shopping-cart"></i></a>

                    </div>
                    <div class="sidebar-menu-section">
                        <h3 class="section-title">Notifications</h3>
                        <a href="#" class="sidebar-link">Alerts<i class="fas fa-bell"></i></a>
                    </div>
                    <div class="sidebar-menu-section">
                        <h3 class="section-title">Settings</h3>
                        <a href="#" class="sidebar-link">Account Settings<i class="fas fa-cog"></i></a>
                        <a href="#" class="sidebar-link">Privacy Settings<i class="fas fa-shield-alt"></i></a>
                </div>

            </aside>
            
            <!-- Main Content -->
            <main class="main-content">
                <!-- Dashboard Overview -->
                <section class="card dashboard-overview">
                    <h2 class="card-header">Dashboard Overview</h2>
                    <div class="stats-container">
                        <div class="stat-card">
                            <h3>Total Items Listed for Sale</h3>
                            <p id="totalListed">0</p>
                        </div>
                        <div class="stat-card">
                            <h3>Total Items Purchased</h3>
                            <p id="totalPurchased">0</p>
                        </div>
                    </div>
                    <div class="stats-container" style="margin-top: 15px;">
                        <div class="stat-card">
                            <h3>Recent Activity</h3>
                            <p id="recentActivity">No recent activity</p>
                        </div>
                        <div class="stat-card">
                            <h3>Wallet Balance</h3>
                            <p id="walletBalance">₱0.00</p>
                        </div>
                    </div>
                </section>
                
                <!-- Widgets Grid -->
                <div class="widget-grid">
                    <!-- Listings Management -->
                    <section class="card">
                        <h2 class="card-header">Listings Management</h2>
                        <div class="listings-actions">
                            <a href="#" class="listings-action">Active Listings</a>
                            <a href="#" class="listings-action">Add New Listing</a>
                            <a href="#" class="listings-action">Sold Listings</a>
                        </div>
                    </section>
                </div>
                
                <!-- Orders & Transactions -->
                <section class="card">
                    <h2 class="card-header">Orders & Transactions</h2>
                    <a href="#" class="listings-action">Purchase History</a>
                    <a href="#" class="listings-action">Sales History</a>
                </section>
                
                <!-- Admin Announcements -->
                <section class="card">
                    <h2 class="card-header">Admin Announcements & Alerts</h2>
                    <div id="announcements">
                        <p>No new announcements</p>
                    </div>
                </section>
            </main>
        </div>
    </div>
</body>
</html>
