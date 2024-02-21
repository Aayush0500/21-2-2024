<?php include('admin-header.php') ?>
<?php
// SQL query to fetch specific order details
$sql = "SELECT order_id, order_cost, order_status, user_id, user_phone, user_city, user_address, order_date FROM orders";
$result = $conn->query($sql);
?>

<div class="main-content">
    <h2>Order List</h2>

    <table class="order-table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Cost</th>
                <th>Order Status</th>
                <th>User ID</th>
                <th>User Phone</th>
                <th>User City</th>
                <th>User Address</th>
                <th>Order Date</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table rows with order data will go here -->
            <?php
            // Fetch and display each order
            while ($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $row["order_id"]; ?></td>
                    <td>$<?php echo $row["order_cost"]; ?></td>
                    <td><?php echo $row["order_status"]; ?></td>
                    <td><?php echo $row["user_id"]; ?></td>
                    <td><?php echo $row["user_phone"]; ?></td>
                    <td><?php echo $row["user_city"]; ?></td>
                    <td><?php echo $row["user_address"]; ?></td>
                    <td><?php echo $row["order_date"]; ?></td>
                    <td><a href="admin-edit-order.php?orderID=<?php echo $row["order_id"]; ?>" class="edit-button">Edit</a></td>
                    <td><button class="delete-button" data-orderid="<?php echo $row["order_id"]; ?>">Delete</button></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="admin.js/main.js"></script>
<script>
    $(document).ready(function() {
        // Attach click event to delete buttons
        $(".delete-button").click(function() {
            // Get the order ID from the data attribute
            var orderID = $(this).data("orderid");

            // Ask for confirmation
            var confirmDelete = confirm("Are you sure you want to delete this order?");

            // If confirmed, proceed with deletion
            if (confirmDelete) {
                // Perform AJAX request to delete the order
                $.ajax({
                    url: "delete-order.php", // Change this to the actual server endpoint for deleting orders
                    type: "POST",
                    data: {
                        orderID: orderID
                    },
                    success: function(response) {
                        // Update the UI or perform any other actions after successful deletion
                        console.log("Order deleted successfully");
                        // Reload the page or update the table if needed
                        location.reload();
                    },
                    error: function(error) {
                        console.error("Error deleting order:", error);
                    }
                });
            }
        });
    });
</script>
</body>

</html>