<?php
include('admin-header.php');
include('../server/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission for specific_weight_products
    $productID = $_POST["product_id"];
    $productName = $_POST["product_name"];
    $productCategory = $_POST["category_id"];
    $productDescription = $_POST["description"];
    $productPrice = $_POST["product_price"];

    $sql = "UPDATE specific_weight_products SET 
            product_name = '$productName',
            category_id = '$productCategory',
            description = '$productDescription',
            product_price = '$productPrice'
            WHERE product_id = '$productID'";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the product list page after successful update, including the category_id
        header("Location: admin-products.php?category_id=$productCategory");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

if (isset($_GET['productID'])) {
    $productID = $_GET['productID'];
    $sql = "SELECT * FROM specific_weight_products WHERE product_id = '$productID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productID = $row["product_id"];
        $productName = $row["product_name"];
        $productCategory = $row["category_id"];
        $productDescription = $row["description"];
        $productPrice = $row["product_price"];
    } else {
        header("Location: admin-products.php");
        exit();
    }

    $conn->close();
} else {
    header("Location: admin-products.php");
    exit();
}
?>

<div class="main-content">
    <h2>Edit Specific Weight Product</h2>

    <!-- Form for editing specific weight product details -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="editSpecificWeightProductForm" enctype="multipart/form-data">
        <div class="form-column">
            <label for="product_id">Product ID</label>
            <input type="text" name="product_id" id="product_id" value="<?php echo $productID; ?>" readonly>
        </div>
        <div class="form-column">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" value="<?php echo $productName; ?>">
        </div>
        <div class="form-column">
            <label for="category_id">Product Category</label>
            <input type="text" name="category_id" id="category_id" value="<?php echo $productCategory; ?>">
        </div>
        <div class="form-column">
            <label for="description">Product Description</label>
            <input type="text" name="description" id="description" value="<?php echo $productDescription; ?>">
        </div>
        <div class="form-column">
            <label for="product_price">Product Price</label>
            <input type="text" name="product_price" id="product_price" value="<?php echo $productPrice; ?>">
        </div>

        <!-- You can add other fields as needed -->

        <button type="submit" class="update-button">Update</button>
    </form>
</div>

<script src="admin.js/main.js"></script>
</body>

</html>
