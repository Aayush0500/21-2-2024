<?php include('admin-header.php') ?>

<?php



// SQL query to fetch specific order details
$sql = "SELECT user_id, user_name, user_email, user_phone, user_password
FROM users";
$result = $conn->query($sql);

?>

<div class="main-content">
    <h2>User Management</h2>

    <!-- Table for displaying user details -->
    <table class="user-table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Phone</th>
                <th>User Password</th>
                
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are rows returned
            if ($result->num_rows > 0) {
                // Fetch and display each user
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["user_id"] . "</td>";
                    echo "<td>" . $row["user_name"] . "</td>";
                    echo "<td>" . $row["user_email"] . "</td>";
                    echo "<td>" . $row["user_phone"] . "</td>";
                    echo "<td>" . $row["user_password"] . "</td>";
                    echo "<td><button class='delete-button' data-userid='" . $row["user_id"] . "'>Delete</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No users found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>


<script src="admin.js/main.js"></script>
</body>

</html>