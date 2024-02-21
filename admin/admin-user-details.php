<?php include('admin-header.php') ?>


            <div class="main-content">
                <h2>Edit User</h2>

                <!-- Form for editing user details -->
                <form action="#" method="post" id="editUserForm">
                    <div class="form-column">
                        <label for="user_id">User ID</label>
                        <input type="text" name="user_id" id="user_id" value="1" readonly>
                    </div>
                    <div class="form-column">
                        <label for="user_name">User Name</label>
                        <input type="text" name="user_name" id="user_name" value="John Doe">
                    </div>
                    <div class="form-column">
                        <label for="user_email">User Email</label>
                        <input type="email" name="user_email" id="user_email" value="john.doe@example.com">
                    </div>
                    <div class="form-column">
                        <label for="user_phone">User Phone</label>
                        <input type="text" name="user_phone" id="user_phone" value="1234567890">
                    </div>
                    <div class="form-column">
                        <label for="user_password">User Password</label>
                        <input type="password" name="user_password" id="user_password" value="password123">
                    </div>
                    <button type="submit" class="update-button">Update</button>
                </form>
            </div>
    </div>


    <script src="admin.js/main.js"></script>
</body>

</html>