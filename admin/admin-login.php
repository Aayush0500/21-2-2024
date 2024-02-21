<?php

session_start();

include("../server/connection.php");

if (isset ($_SESSION['logged_in'])) {
    header("location: ./admin-index.php");
    exit;
}

if (isset($_POST['admin_login_btn'])) {

    $email = $_POST['adminname']; // Corrected field name
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);

        if ($stmt->fetch()) {
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['logged_in'] = true;

            header('location: admin-index.php?message=logged in successfully');
            exit(); // Added exit to stop script execution after redirect
        } else {
            header('location: admin-login.php?error=wrong email or password'); // Corrected query string parameter name
            exit(); // Added exit to stop script execution after redirect
        }
    } else {
        // error
        header("location: admin-login.php?error=something went wrong");
        exit(); // Added exit to stop script execution after redirect
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin.css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <?php
        // Display errors if present
        if (isset($_GET['error'])) {
            echo '<div  style="color: red;" class="error-message">' . htmlspecialchars($_GET['error']) . '</div>';
        }
        ?>

        <form action="admin-login.php" method="post">
            <div class="form-group">
                <label for="adminname">Admin Name:</label> <!-- Corrected label text -->
                <input type="text" id="adminname" name="adminname" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button name="admin_login_btn" type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
