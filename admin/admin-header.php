<?php 


session_start();



if (!isset($_SESSION['logged_in'])) {
    // Redirect to the login page
    header('location: admin-login.php');
    exit;
}



?>
<?php include('../server/connection.php') ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard</title>
      <link rel="stylesheet" href="admin.css/main.css">
</head>

<body>
    <header class="header">
        <div class="header-content">
            <div class="header-left">
                <div class="company-name">Your Company Name</div>
            </div>
            <div class="header-right">
                <div class="mobile-menu-toggle" onclick="toggleMobileMenu()">☰</div>
            </div>
        </div>
    </header>

    <div class="main-container">
        <nav class="navigation">
            <ul>
                <li><a href="admin-index.php">Dashboard</a></li>
                <li><a href="admin-order.php">Orders</a></li>
                <li><a href="admin_categories.php">Products</a></li>
            
                <li><a href="admin-add-product.php">Add New Product</a></li>
                <li><a href="admin-user.php">user</a></li>

                <li><a href="#">Help</a></li>
                <li class="logout-mobile"><a href="logout.php?logout=1" class="logout-button">Logout</a></li>
            </ul>
        </nav>