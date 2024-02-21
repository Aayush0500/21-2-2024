<?php
// Start the session
session_start();

// Check if the logout parameter is present and set to 1
if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    // Check if the admin is logged in
    if (isset($_SESSION['admin_logged_in'])) {
        // Clear specific session variables
        unset($_SESSION['admin_logged_in']);
        unset($_SESSION['admin_email']);
        unset($_SESSION['admin_name']);
    }

    // Clear other session variables, adjust the keys as needed
    unset($_SESSION['cart']);
    unset($_SESSION['add_to_cart']);
    unset($_SESSION['total']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);
    unset($_SESSION['logged_in']);
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_name']);
    unset($_SESSION['admin_email']);

    // Optionally, destroy the entire session
    // session_destroy();

    // Set a success message
    $_SESSION['message'] = "You have been successfully logged out.";

    // Prevent caching
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");

    // Redirect to the login page using JavaScript with history clearing
    echo '<script>window.location.href = "admin-login.php";</script>';
    echo '<script>window.history.forward();</script>';
    exit;
}

// If the logout parameter is not present, display session variables (for debugging purposes)
var_dump($_SESSION);
exit;
?>
