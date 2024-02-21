<?php include('admin-header.php') ?>

<style>
    .main-content {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .image-container {
        text-align: center;
    }

    .image-container img {
        max-width: 100%;
        max-height: 200px; /* Adjust as needed */
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .image-container p {
        margin: 5px 0;
    }

    .upload-btn {
        margin: 20px;
        text-align: center;
    }
</style>

<div class="upload-btn">
    <a href="upload_photo.php" class="btn btn-primary">Upload Photo</a>
</div>

<div class="main-content">
    <?php
    $imageFolder = '../img/categories';
    $images = scandir($imageFolder);

    foreach ($images as $image) {
        if ($image != "." && $image != "..") {
            echo '<div class="image-container">';
            echo '<img src="' . $imageFolder . '/' . $image . '" alt="' . pathinfo($image, PATHINFO_FILENAME) . '">';
            echo '<p>' . pathinfo($image, PATHINFO_FILENAME) . '</p>';
            echo '</div>';
        }
    }
    ?>
</div>

<script src="admin.js/main.js"></script>
</body>

</html>
