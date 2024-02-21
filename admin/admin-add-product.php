
<?php include('admin-header.php') ?>

<?php
// Include the file for database connection
include('../server/connection.php');

// Fetch categories from the category table
$stmtCategories = $conn->prepare("SELECT category_id, category_name FROM category");
$stmtCategories->execute();
$categories = $stmtCategories->get_result();
?>

<div class="main-content">
    <h2>Add Product</h2>

    <!-- Form for adding a new product -->
    <form action="add-product.php" method="post" id="addProductForm" enctype="multipart/form-data">
        <div class="form-column">
            <label for="product_type">Product Type</label>
            <select name="product_type" id="product_type" onchange="toggleFields(this.value)">
                <option value="categories_product">Categories Product</option>
                <option value="specific_weight_products">Specific Weight Product</option>
            </select>
        </div>

        <div class="form-column">
            <label for="category">Category</label>
            <select name="category" id="category">
                <?php while ($row = $categories->fetch_assoc()) : ?>
                    <option value="<?php echo $row['category_name']; ?> (<?php echo $row['category_id']; ?>)"><?php echo $row['category_name']; ?> (<?php echo $row['category_id']; ?>)</option>
                <?php endwhile; ?>
            </select>
        </div>

        <div class="form-column">
            <label for="category_id">Category ID</label>
            <input type="text" name="category_id" id="category_id" readonly>
        </div>

        <div class="form-column">
            <label for="product_id">Product ID</label>
            <input type="text" name="product_id" id="product_id">
        </div>


        <div class="form-column">
            <label for="product_name">Product Name</label>
            <input type="text" name="product_name" id="product_name">
        </div>

        <div class="form-column">
            <label for="product_price">Product Price</label>
            <input type="text" name="product_price" id="product_price">
        </div>

        <div class="form-column">
            <label for="description">Description</label>
            <input type="text" name="description" id="description">
        </div>

        <div class="form-column">
            <label for="product_image">Product Image</label>
            <input type="text" name="product_image" id="product_image">
        </div>

        <div class="form-column" id="price_per_kg_container">
            <label for="product_price_per_kg">Product Price Per Kg</label>
            <input type="number" name="product_price_per_kg" id="product_price_per_kg">
        </div>

        <button type="submit" class="add-button">Add Product</button>
    </form>
</div>

<script src="admin.js/main.js"></script>
<script>
    function toggleFields(productType) {
        var pricePerKgContainer = document.getElementById("price_per_kg_container");
        if (productType === "specific_weight_products") {
            pricePerKgContainer.style.display = "none";
        } else {
            pricePerKgContainer.style.display = "block";
        }
    }

    // Update category_id input based on user selection
    document.getElementById('category').addEventListener('change', function () {
        var selectedCategory = this.value;
        var categoryIdInput = document.getElementById('category_id');

        // Assuming the category value is in the format "Category Name (Category ID)"
        var categoryId = selectedCategory.match(/\(([^)]+)\)/)[1];

        categoryIdInput.value = categoryId;
    });
</script>
</body>

</html>