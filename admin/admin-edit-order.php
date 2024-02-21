<?php include('admin-header.php') ?>

<?php
// Include the file for database connection
include('../server/connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $orderID = $_POST["order_id"];
    $orderCost = $_POST["order_cost"];
    $orderStatus = $_POST["order_status"];
    $userID = $_POST["user_id"];
    $userPhone = $_POST["user_phone"];
    $userCity = $_POST["user_city"];
    $userAddress = $_POST["user_address"];
    $orderDate = $_POST["order_date"];

    // SQL query to update the order details
    $sql = "UPDATE orders SET 
            order_cost = '$orderCost',
            order_status = '$orderStatus',
            user_id = '$userID',
            user_phone = '$userPhone',
            user_city = '$userCity',
            user_address = '$userAddress',
            order_date = '$orderDate'
            WHERE order_id = '$orderID'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the order list page after successful update
        header("Location: admin-order.php");
        exit();
    } else {
        // Display an error message if the update fails
        echo "Error updating record: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}

// If order ID is provided in the URL, fetch the order details
if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];

    // SQL query to fetch order details by ID
    $sql = "SELECT * FROM orders WHERE order_id = '$orderID'";
    $result = $conn->query($sql);

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Fetch the order details
        $row = $result->fetch_assoc();

        // Assign order details to variables
        $orderID = $row["order_id"];
        $orderCost = $row["order_cost"];
        $orderStatus = $row["order_status"];
        $userID = $row["user_id"];
        $userPhone = $row["user_phone"];
        $userCity = $row["user_city"];
        $userAddress = $row["user_address"];
        $orderDate = $row["order_date"];

    } else {
        // Redirect or show an error if the order is not found
        header("Location: admin-order.php");
        exit();
    }

    // Close the database connection
    $conn->close();
} else {
    // Redirect or show an error if order ID is not provided
    header("Location: admin-order.php");
    exit();
}
?>

<div class="main-content">
            <h2>Edit Order</h2>

            <!-- Form for editing order details -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="editOrderForm">
                <div class="form-column">
                    <label for="order_id">Order ID</label>
                    <input type="text" name="order_id" id="order_id" value="<?php echo $orderID; ?>" readonly>
                </div>
                <div class="form-column">
                    <label for="order_cost">Order Cost</label>
                    <input type="text" name="order_cost" id="order_cost" value="<?php echo $orderCost; ?>">
                </div>
                <div class="form-column">
                    <label for="order_status">Order Status</label>
                    <input type="text" name="order_status" id="order_status" value="<?php echo $orderStatus; ?>">
                </div>
                <div class="form-column">
                    <label for="user_id">User ID</label>
                    <input type="text" name="user_id" id="user_id" value="<?php echo $userID; ?>">
                </div>
                <div class="form-column">
                    <label for="user_phone">User Phone</label>
                    <input type="text" name="user_phone" id="user_phone" value="<?php echo $userPhone; ?>">
                </div>
                <div class="form-column">
                    <label for="user_city">User City</label>
                    <input type="text" name="user_city" id="user_city" value="<?php echo $userCity; ?>">
                </div>
                <div class="form-column">
                    <label for="user_address">User Address</label>
                    <input type="text" name="user_address" id="user_address" value="<?php echo $userAddress; ?>">
                </div>
                <div class="form-column">
                    <label for="order_date">Order Date</label>
                    <input type="text" name="order_date" id="order_date" value="<?php echo $orderDate; ?>">
                </div>
                <button type="submit" class="update-button">Update</button>
            </form>
        </div>
    </div>

    </div>

    <script src="admin.js/main.js"></script>
</body>

</html>