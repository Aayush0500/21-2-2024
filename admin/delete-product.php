<?php
// Include the file for database connection
include('../server/connection.php');

// Check if product ID and type are provided in the URL
if (isset($_GET['productID']) && isset($_GET['productType'])) {
    $productID = $_GET['productID'];
    $productType = $_GET['productType'];

    // Define the table based on the product type
    $table = ($productType === 'categories_product') ? 'categories_product' : 'specific_weight_products';

    // Perform the delete operation
    $deleteSql = $conn->prepare("DELETE FROM $table WHERE product_id = ?");
    $deleteSql->bind_param("i", $productID);

    // Response format
    $response = [
        'success' => false,
        'message' => ''
    ];

    if ($deleteSql->execute()) {
        $response['success'] = true;
        $response['message'] = "Product deleted successfully from $table";
    } else {
        $response['message'] = "Error deleting product from $table: " . $deleteSql->error;
    }

    // Close the database connection
    $deleteSql->close();

    // Redirect back to the admin page after deletion
    header("Location: admin-product.php");
    exit();
} else {
    $response['message'] = "Product ID or type not provided";
}

// Output JSON response (optional)
header('Content-Type: application/json');
echo json_encode($response);
?>
