<?php
include('../server/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productType = $_POST["product_type"];
    $categoryID = $_POST["category_id"];
    $productID = $_POST["product_id"];
    $productName = $_POST["product_name"];
    $productPrice = $_POST["product_price"];
    $description = $_POST["description"];

    // Handle specific_weight_product case
    if ($productType === "specific_weight_products") {
        // Additional specific_weight_product logic
        // Define the $sql variable for specific_weight_product case
        $sql = "INSERT INTO specific_weight_products (product_id, product_name, category_id, description, product_price)
                VALUES ('$productID', '$productName', '$categoryID', '$description', '$productPrice')";
    } else {
        // Handle categories_product case
        $productPricePerKg = $_POST["product_price_per_kg"];
        // Insert data into categories_product table
        $sql = "INSERT INTO categories_product (product_id, product_name, category_id, description, product_price, product_price_per_kg)
                VALUES ('$productID', '$productName', '$categoryID', '$description', '$productPrice', '$productPricePerKg')";
    }
    

    if ($conn->query($sql) === TRUE) {
        // Redirect to the appropriate product list page after successful insertion
        header("Location: admin-products.php?category_id=$categoryID");
        exit();
    } else {
        echo "Error inserting record: " . $conn->error;
    }

    $conn->close();
} else {
    // If the form is not submitted, redirect to admin-add-product.php
    header("Location: admin-add-product.php");
    exit();
}
?>
