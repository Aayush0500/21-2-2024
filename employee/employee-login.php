<?php

session_start();

include("../server/connection.php");

if (isset ($_SESSION['logged_in'])) {
    header("location: employee-index.php");
    exit;
}

if (isset($_POST['employee_login_btn'])) {

    $email = $_POST['employeename']; // Corrected field name
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT employee_id, employee_name, employee_email, employee_password FROM employee WHERE employee_email = ? AND employee_password = ? LIMIT 1");
    $stmt->bind_param("ss", $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($employee_id, $employee_name, $employee_email, $employee_password);

        if ($stmt->fetch()) {
            $_SESSION['employee_id'] = $employee_id;
            $_SESSION['employee_name'] = $employee_name;
            $_SESSION['employee_email'] = $employee_email;
            $_SESSION['logged_in'] = true;

            header('location: employee-index.php?message=logged in successfully');
            exit(); // Added exit to stop script execution after redirect
        } else {
            header('location: employee-login.php?error=wrong email or password'); // Corrected query string parameter name
            exit(); // Added exit to stop script execution after redirect
        }
    } else {
        // error
        header("location: employee-login.php?error=something went wrong");
        exit(); // Added exit to stop script execution after redirect
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>employee Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>employee Login</h2>
        <?php
        // Display errors if present
        if (isset($_GET['error'])) {
            echo '<div  style="color: red;" class="error-message">' . htmlspecialchars($_GET['error']) . '</div>';
        }
        ?>

        <form action="employee-login.php" method="post">
            <div class="form-group">
                <label for="employeename">employee Name:</label> <!-- Corrected label text -->
                <input type="text" id="employeename" name="employeename" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button name="employee_login_btn" type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
