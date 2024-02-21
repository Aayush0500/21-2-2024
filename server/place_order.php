<?php
session_start();

include("connection.php");

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    header("location: ../checkout.php?message=please login/register to place order");
    exit;
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['place_order'])) {

    // Get user info and store it in the database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $order_cost = $_SESSION['total'];
    $order_status = "not paid";
    $order_date = date("Y-m-d H:i:s");

    // Ensure user_id is not null (this check is redundant here)
    // if (!$user_id) {
    //     header("location: ../checkout.php?message=please login/register to place order");
    //     exit;
    // }

    $stmt = $conn->prepare("INSERT INTO orders(order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("issssss", $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

    $stmt_status =  $stmt->execute();

    if (!$stmt_status) {
        header('location: index.php');
        exit;
    }

    $order_id = $stmt->insert_id;

    foreach ($_SESSION['cart'] as $key => $value) {
        $product_id = $value['product_id'];
        $product_name = $value['product_name'];
        $product_image = $value['product_image'];
        $product_price = $value['product_price'];
        $product_weight = isset($value['weight']) ? $value['weight'] : '-';
        $product_quantity = isset($value['quantity_specific']) ? $value['quantity_specific'] : '1';

        $stmt1 = $conn->prepare("INSERT INTO order_items(order_id, product_id, product_name, product_image, product_price, product_quantity, user_id, order_date, product_weight) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt1->bind_param("isssdisds", $order_id, $product_id, $product_name, $product_image, $product_price, $product_quantity, $user_id, $order_date, $product_weight);

        $stmt1->execute();
    }

    unset($_SESSION['cart']); // or $_SESSION['cart'] = array(); to reset it to an empty array

    header('location: ../payment.php?order_status="order placed successfully"');
    exit;
}
?>
