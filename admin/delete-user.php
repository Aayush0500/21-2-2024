<?php
// Include the file for database connection
include('../server/connection.php');
// Check if user ID is provided
if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];

    // Perform the delete operation
    $deleteSql = "DELETE FROM users WHERE user_id = '$userID'";
    if ($conn->query($deleteSql) === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "User ID not provided";
}
?>
