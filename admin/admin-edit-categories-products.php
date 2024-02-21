<?php
include('admin-header.php');
include('../server/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productID = $_POST["product_id"];
    $productName = $_POST["product_name"];
    $productCategory = $_POST["category_id"];
    $productDescription = $_POST["description"];
    $productPrice = $_POST["product_price"];
    $productpriceperkg = $_POST["product_price_per_kg"];

    $sql = "UPDATE categories_product SET 
            product_name = '$productName',
            category_id = '$productCategory',
            description = '$productDescription',
            product_price = '$productPrice',
            product_price_per_kg = '$productpriceperkg'
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
    $sql = "SELECT * FROM categories_product WHERE product_id = '$productID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productID = $row["product_id"];
        $productName = $row["product_name"];
        $productCategory = $row["category_id"];
        $productDescription = $row["description"];
        $productPrice = $row["product_price"];
        $productpriceperkg = $row["product_price_per_kg"];
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
    <h2>Edit Product</h2>

    <!-- Form for editing product details -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="editProductForm" enctype="multipart/form-data">
        <div class="form-column">
            <label for="product_id">Product ID</label>
            <input type="text" name="product_id" id="product_id" value="<?php echo $productID; ?>" readonly>
        </div>
        <div class="form-column">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name" value="<?php echo $productName; ?>">
        </div>
        <div class="form-column">
            <label for="product_category">Product Category</label>
            <input type="text" name="category_id" id="category_id" value="<?php echo $productCategory; ?>">
        </div>
        <div class="form-column">
            <label for="product_description">Product Description</label>
            <input type="text" name="description" id="description" value="<?php echo $productDescription; ?>">
        </div>
        <div class="form-column">
            <label for="product_image">Product Image</label>
            <input type="text" name="product_image" id="product_image">
        </div>

        <div class="form-column">
            <label for="product_price">Product Price</label>
            <input type="text" name="product_price" id="product_price" value="<?php echo $productPrice; ?>">
        </div>

        <div class="form-column">
            <label for="product_price_per_kg">Product Price Per Kg</label>
            <input type="number" name="product_price_per_kg" id="product_price_per_kg" value="<?php echo $productpriceperkg; ?>">
        </div>

        <button type="submit" class="update-button">Update</button>
    </form>
</div>


<script src="admin.js/main.js"></script>
</body>

</html>