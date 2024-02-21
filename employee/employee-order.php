<?php include('employee-header.php') ?>
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
                <th>Action</th> <!-- Add a new column for the action button -->
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
                    <td><a href="employee-order-details.php?order_id=<?php echo $row["order_id"]; ?>">Order Details</a></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="javascript/main.js"></script>

</body>

</html>
