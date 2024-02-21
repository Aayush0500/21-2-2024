<?php include('admin-header.php');

include('../server/connection.php');

// Prepare a query to select category_id, category_name, and category_image_url from the "category" table
$stmt = $conn->prepare("SELECT category_id, category_name, category_image_url FROM category");

// Execute the prepared statement
$stmt->execute();

// Get the result set
$categories = $stmt->get_result();
?>
<link rel="stylesheet" href="../css files/home.css">
<link rel="stylesheet" href="../css files/shop.css">




<div class="main-content">
    <div class="category-cards">
        <?php
        // Loop through the categories and display each category card
        while ($category = $categories->fetch_assoc()) {
        ?>
            <a href="admin-products.php?category_id=<?php echo $category['category_id']; ?>">
                <div class="category-card">
                    <!-- Assuming you have images stored in a folder named "img" -->
                    <img src="../img/categories/<?php echo $category['category_image_url']; ?>.jpeg" alt="<?php echo $category['category_name']; ?>">
                    <h3><?php echo $category['category_name']; ?></h3>
                </div>
            </a>
        <?php } ?>
    </div>
</div>

<script src="admin.js/main.js"></script>
</body>

</html>