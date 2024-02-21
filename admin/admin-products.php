<?php include('admin-header.php') ?>

<?php
// Check if the category ID is provided in the URL
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $stmtCategory = $conn->prepare("SELECT * FROM categories_product WHERE category_id = ?");
    $stmtCategory->bind_param("i", $category_id);
    $stmtCategory->execute();
    $products = $stmtCategory->get_result();

    $stmtSpecific = $conn->prepare("SELECT * FROM specific_weight_products WHERE category_id = ?");
    $stmtSpecific->bind_param("i", $category_id);
    $stmtSpecific->execute();
    $specificProducts = $stmtSpecific->get_result();
}else{
    header('Location: admin-categories.php');
}
?>


<div class="main-content">
    <h2>Product List</h2>

    <!-- Table for displaying products -->
    <table class="product-table">
    <h2 style="text-align: center;">categories_product</h2>
        <thead>
            <tr>
                <th>product_id</th>
                <th>product_name<t /h>
                <th>product_price</th>
                <th>category_id </th>
                <th>description </th>
                <th>product_image</th>
                <th>product_price_per_kg</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are rows returned
            if ($products->num_rows > 0) {
                // Fetch and display each product
                while ($row = $products->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["product_id"] . "</td>";
                    echo "<td>" . $row["product_name"] . "</td>";
                    echo "<td>" . $row["product_price"] . "</td>";
                    echo "<td>" . $row["category_id"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["product_image"] . "</td>";
                    echo "<td>" . $row["product_price_per_kg"] . "</td>";
                    echo "<td><a href='admin-edit-categories-products.php?productID=" . $row["product_id"] . "' class='edit-button'>Edit</a></td>";
                    echo "<td><a href='delete-product.php?productID=" . $row["product_id"] . "&productType=categories_product' class='delete-button'>Delete</a></td>";                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No products found.</td></tr>";
            }
            ?>

        </tbody>
    </table>
    <table class="product-table">
        <h2 style="text-align: center;">specific_weight_products</h2>
        <thead>
            <tr>
                <th>product_id</th>
                <th>product_name<t /h>
                <th>product_price</th>
                <th>category_id </th>
                <th>description </th>
                <th>product_image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <tbody>
            <?php
            // Check if there are rows returned
            if ($specificProducts->num_rows > 0) {
                // Fetch and display each product
                while ($row = $specificProducts->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["product_id"] . "</td>";
                    echo "<td>" . $row["product_name"] . "</td>";
                    echo "<td>" . $row["product_price"] . "</td>";
                    echo "<td>" . $row["category_id"] . "</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["product_image"] . "</td>";
                    echo "<td><a href='admin-edit-specific-weight-product.php?productID=" . $row["product_id"] . "' class='edit-button'>Edit</a></td>";
                    echo "<td><a href='delete-product.php?productID=" . $row["product_id"] . "&productType=specific_weight_products' class='delete-button'>Delete</a></td>";                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No products found.</td></tr>";
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
            // Get the product ID from the data attribute
            var productID = $(this).data("productid");

            // Ask for confirmation
            var confirmDelete = confirm("Are you sure you want to delete this product?");

            // If confirmed, proceed with deletion
            if (confirmDelete) {
                // Perform AJAX request to delete the product
                $.ajax({
                    url: "delete-product.php", // Change this to the actual server endpoint for deleting products
                    type: "POST",
                    data: {
                        productID: productID
                    },
                    success: function(response) {
                        // Update the UI or perform any other actions after successful deletion
                        console.log("Product deleted successfully");
                        // Reload the page or update the table if needed
                        location.reload();
                    },
                    error: function(error) {
                        console.error("Error deleting product:", error);
                    }
                });
            }
        });
    });
</script>
</body>

</html>