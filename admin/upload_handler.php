<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = $_POST["file_name"];
    $image_folder = '../img/categories/';
    $target_file = $image_folder . $file_name . '.jpeg';

    $image_info = getimagesize($_FILES["photo"]["tmp_name"]);

    // Check if the uploaded file is an image
    if ($image_info !== false) {
        $mime_type = $image_info['mime'];

        // Create an image resource based on the MIME type
        switch ($mime_type) {
            case 'image/jpeg':
                $source_image = imagecreatefromjpeg($_FILES["photo"]["tmp_name"]);
                break;
            case 'image/png':
                $source_image = imagecreatefrompng($_FILES["photo"]["tmp_name"]);
                break;
            case 'image/gif':
                $source_image = imagecreatefromgif($_FILES["photo"]["tmp_name"]);
                break;
            default:
                echo "Unsupported image type.";
                exit();
        }

        // Convert and save as JPEG
        imagejpeg($source_image, $target_file, 80); // 80 is the quality, adjust as needed

        // Free up resources
        imagedestroy($source_image);

        echo "The file " . htmlspecialchars($file_name) . " has been uploaded and converted to JPEG.";
        // You can save the file name and other details in a database if needed
    } else {
        echo "Invalid file format. Only JPEG, PNG, and GIF are supported.";
    }
}
?>
