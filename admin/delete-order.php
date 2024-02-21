<?php
// Include the file for database connection
include('../server/connection.php');

// Check if order ID is provided
if (isset($_POST['orderID'])) {
    $orderID = $_POST['orderID'];

    // Perform the delete operation
    $deleteSql = "DELETE FROM orders WHERE order_id = '$orderID'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "Order deleted successfully";
    } else {
        echo "Error deleting order: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Order ID not provided";
}
?>
