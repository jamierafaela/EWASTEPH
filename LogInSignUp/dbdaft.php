<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Database connection
$db_host = "localhost";
$db_user = "username";
$db_pass = "password";
$db_name = "e_waste_ph";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user information
$user_id = $_SESSION['user_id'];
$user_query = "SELECT username, email, profile_image FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Get dashboard statistics
$stats = array(
    'total_listed' => 0,
    'total_purchased' => 0,
    'wallet_balance' => 0
);

// Get total items listed
$listed_query = "SELECT COUNT(*) as total FROM listings WHERE seller_id = ?";
$stmt = $conn->prepare($listed_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stats['total_listed'] = $row['total'];

// Get total items purchased
$purchased_query = "SELECT COUNT(*) as total FROM orders WHERE buyer_id = ?";
$stmt = $conn->prepare($purchased_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stats['total_purchased'] = $row['total'];

// Get wallet balance
$wallet_query = "SELECT balance FROM wallets WHERE user_id = ?";
$stmt = $conn->prepare($wallet_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stats['wallet_balance'] = $row ? $row['balance'] : 0;

// Get recent activity
$activity_query = "SELECT a.activity_type, a.description, a.created_at 
                  FROM activities a 
                  WHERE a.user_id = ? 
                  ORDER BY a.created_at DESC 
                  LIMIT 1";
$stmt = $conn->prepare($activity_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$recent_activity = $result->fetch_assoc();

// Get announcements
$announcements_query = "SELECT title, content, created_at 
                       FROM announcements 
                       WHERE expiry_date >= CURDATE() 
                       ORDER BY created_at DESC 
                       LIMIT 3";
$result = $conn->query($announcements_query);
$announcements = array();
while ($row = $result->fetch_assoc()) {
    $announcements[] = $row;
}

// Format date/time
function time_elapsed_string($datetime) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    if ($diff->d > 7) {
        return $ago->format('M j, Y');
    } elseif ($diff->d > 0) {
        return $diff->d . ' day' . ($diff->d > 1 ? 's' : '') . ' ago';
    } elseif ($diff->h > 0) {
        return $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
    } elseif ($diff->i > 0) {
        return $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ago';
    } else {
        return 'just now';
    }
}

// Close connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-WastePH User Dashboard</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            color: #333;
        }
        
        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #f5f5f5;
            border-bottom: 1px solid #ddd;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #222;
            text-decoration: none;
        }
        
        .dashboard-title {
            font-size: 28px;
            font-weight: normal;
            margin-left: 20px;
        }
        
        .search-bar {
            padding: 8px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 250px;
        }
        
        /* Main Layout */
        .container {
            display: flex;
            padding: 20px;
            gap: 20px;
        }
        
        /* Sidebar */
        .sidebar {
            width: 280px;
            flex-shrink: 0;
        }
        
        .profile-card, .sidebar-menu {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        
        .profile-image {
            width: 100%;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-bottom: 1px solid #eee;
            background-color: #f8f8f8;
            overflow: hidden;
        }
        
        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .profile-image-placeholder {
            width: 100px;
            height: 100px;
            background-color: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: #aaa;
            border-radius: 50%;
        }
        
        .profile-details, .sidebar-menu-section {
            padding: 15px;
            text-align: center;
        }
        
        .sidebar-menu-section {
            border-bottom: 1px solid #eee;
        }
        
        .sidebar-menu-section:last-child {
            border-bottom: none;
        }
        
        .username {
            font-size: 18px;
            margin-bottom: 15px;
        }
        
        .profile-link, .sidebar-link {
            display: block;
            text-decoration: none;
            color: #333;
            margin: 10px 0;
            transition: color 0.3s;
        }
        
        .profile-link:hover, .sidebar-link:hover {
            color: #0066cc;
        }
        
        .section-title {
            font-size: 18px;
            margin-bottom: 15px;
            text-align: left;
        }
        
        /* Main Content */
        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
        }
        
        .card-header {
            margin-bottom: 15px;
            font-size: 20px;
            font-weight: bold;
        }
        
        /* Overview Cards */
        .dashboard-overview {
            margin-bottom: 0px;
        }
        
        .stats-container {
            display: flex;
            gap: 15px;
            margin-top: 15px;
        }
        
        .stat-card {
            flex: 1;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 15px;
            text-align: center;
        }
        
        .stat-card h3 {
            font-size: 16px;
            margin-bottom: 8px;
            color: #555;
        }
        
        .stat-card p {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }
        
        /* Widget Grid */
        .widget-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 0px;
        }
        
        @media (max-width: 768px) {
            .widget-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /* Listings Management */
        .listings-actions {
            margin-top: 10px;
        }
        
        .listings-action {
            display: block;
            margin: 10px 0;
            text-decoration: none;
            color: #333;
            transition: color 0.3s;
        }
        
        .listings-action:hover {
            color: #0066cc;
        }
        
        /* Messages */
        .inbox-button {
            display: block;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            color: #333;
            margin-top: 15px;
            transition: background-color 0.3s;
        }
        
        .inbox-button:hover {
            background-color: #eee;
        }
        
        /* Announcements */
        .announcement-item {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        
        .announcement-item:last-child {
            border-bottom: none;
        }
        
        .announcement-title {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .announcement-date {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
        }
        
        /* Recent Activity */
        .activity-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        
        .activity-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #0066cc;
            margin-right: 8px;
        }
        
        .activity-time {
            font-size: 12px;
            color: #777;
            margin-left: auto;
        }
        
        /* Responsive Design */
        @media (max-width: 992px) {
            .container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <div style="display: flex; align-items: center;">
            <a href="index.php" class="logo">E-WastePH</a>
            <span class="dashboard-title">User Dashboard</span>
        </div>
        <form method="GET" action="search.php">
            <input type="text" name="q" class="search-bar" placeholder="Search listings...">
        </form>
    </header>
    
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-image">
                    <?php if ($user['profile_image']): ?>
                        <img src="uploads/profiles/<?php echo htmlspecialchars($user['profile_image']); ?>" alt="Profile Image">
                    <?php else: ?>
                        <div class="profile-image-placeholder"><?php echo strtoupper(substr($user['username'], 0, 1)); ?></div>
                    <?php endif; ?>
                </div>
                <div class="profile-details">
                    <h2 class="username"><?php echo htmlspecialchars($user['username']); ?></h2>
                    <a href="edit_profile.php" class="profile-link">Edit Profile</a>
                    <a href="change_password.php" class="profile-link">Change Password</a>
                    <a href="logout.php" class="profile-link">Logout</a>
                </div>
            </div>
            
            <!-- Sidebar Menu -->
            <div class="sidebar-menu">
                <div class="sidebar-menu-section">
                    <h3 class="section-title">Listings Management</h3>
                    <a href="listings.php?type=active" class="sidebar-link">Active Listings</a>
                    <a href="add_listing.php" class="sidebar-link">Add New Listing</a>
                    <a href="listings.php?type=sold" class="sidebar-link">Sold Listings</a>
                </div>
                <div class="sidebar-menu-section">
                    <h3 class="section-title">Cart & Wishlist</h3>
                    <a href="cart.php" class="sidebar-link">View Cart</a>
                    <a href="wishlist.php" class="sidebar-link">View Wishlist</a>
                </div>
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
                        <p><?php echo $stats['total_listed']; ?></p>
                    </div>
                    <div class="stat-card">
                        <h3>Total Items Purchased</h3>
                        <p><?php echo $stats['total_purchased']; ?></p>
                    </div>
                </div>
                <div class="stats-container" style="margin-top: 15px;">
                    <div class="stat-card">
                        <h3>Recent Activity</h3>
                        <?php if ($recent_activity): ?>
                            <div class="activity-item">
                                <span class="activity-dot"></span>
                                <span><?php echo htmlspecialchars($recent_activity['description']); ?></span>
                                <span class="activity-time"><?php echo time_elapsed_string($recent_activity['created_at']); ?></span>
                            </div>
                        <?php else: ?>
                            <p>No recent activity</p>
                        <?php endif; ?>
                    </div>
                    <div class="stat-card">
                        <h3>Wallet Balance</h3>
                        <p>₱<?php echo number_format($stats['wallet_balance'], 2); ?></p>
                    </div>
                </div>
            </section>
            
            <!-- Widgets Grid -->
            <div class="widget-grid">
                <!-- Listings Management -->
                <section class="card">
                    <h2 class="card-header">Listings Management</h2>
                    <div class="listings-actions">
                        <a href="listings.php?type=active" class="listings-action">Active Listings</a>
                        <a href="add_listing.php" class="listings-action">Add New Listing</a>
                        <a href="listings.php?type=sold" class="listings-action">Sold Listings</a>
                    </div>
                </section>
                
                <!-- Messages -->
                <section class="card">
                    <h2 class="card-header">Messages</h2>
                    <a href="inbox.php" class="inbox-button">Inbox</a>
                </section>
            </div>
            
            <!-- Orders & Transactions -->
            <section class="card">
                <h2 class="card-header">Orders & Transactions</h2>
                <a href="orders.php?type=purchases" class="listings-action">Purchase History</a>
                <a href="orders.php?type=sales" class="listings-action">Sales History</a>
            </section>
            
            <!-- Admin Announcements -->
            <section class="card">
                <h2 class="card-header">Admin Announcements & Alerts</h2>
                <div id="announcements">
                    <?php if (count($announcements) > 0): ?>
                        <?php foreach ($announcements as $announcement): ?>
                            <div class="announcement-item">
                                <div class="announcement-title"><?php echo htmlspecialchars($announcement['title']); ?></div>
                                <div><?php echo htmlspecialchars($announcement['content']); ?></div>
                                <div class="announcement-date"><?php echo time_elapsed_string($announcement['created_at']); ?></div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No new announcements</p>
                    <?php endif; ?>
                </div>
            </section>
        </main>
    </div>
    
    <script>
        // Additional JavaScript can be added here
        document.addEventListener('DOMContentLoaded', function() {
            // Add functionality for real-time notifications or updates
            // For example, WebSocket connections for instant messaging
        });
    </script>
</body>
</html>