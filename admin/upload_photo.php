<?php include('admin-header.php') ?>

<style>
    .upload-form {
        max-width: 400px;
        margin: 20px auto;
        text-align: center;
    }

    .upload-form input {
        width: 100%;
        margin-bottom: 10px;
        padding: 8px;
    }
</style>
<div class="main-content">
    <div class="upload-form">
        <h2>Upload Photo</h2>
        <form action="upload_handler.php" method="post" enctype="multipart/form-data">
            <label for="file_name">File Name:</label>
            <input type="text" name="file_name" required>

            <label for="photo">Choose Photo:</label>
            <input type="file" name="photo" accept="image/*" required>

            <button type="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>



<script src="admin.js/main.js"></script>
</body>

</html>