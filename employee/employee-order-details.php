<?php
include('employee-header.php');

// Check if order_id is provided in the URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details based on the provided order_id
    $orderDetailsSql = "SELECT  product_id, product_name, product_image, product_price, product_weight, product_quantity FROM order_items WHERE order_id = '$order_id'";
    $orderDetailsResult = $conn->query($orderDetailsSql);
}

?>

<div class="main-content">
    <h2>Order Details</h2>

    <?php
    // Fetch and display order details
    if ($orderDetailsResult->num_rows > 0) {
    ?>
        <table class="order-table">
            <thead>
                <tr>
               
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Product Weight</th>
                    <th>Product Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($itemRow = $orderDetailsResult->fetch_assoc()) {
                ?>
                    <tr>
                  
                        <td><?php echo $itemRow["product_id"]; ?></td>
                        <td><?php echo $itemRow["product_name"]; ?></td>
                        <td><?php echo $itemRow["product_image"]; ?></td>
                        <td><?php echo $itemRow["product_price"]; ?></td>
                        <td><?php echo $itemRow["product_weight"]; ?></td>
                        <td><?php echo $itemRow["product_quantity"]; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
    } else {
        echo "<p>No items found for this order.</p>";
    }
    ?>
</div>

<script src="javascript/employee-main.js"></script>
</body>

</html>
