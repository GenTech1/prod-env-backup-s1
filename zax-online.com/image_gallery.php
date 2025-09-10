<!DOCTYPE html>
<html>
<head>
    <title>Image Gallery</title>
    <style>
        .image-item {
            display: inline-block;
            margin: 10px;
        }
        .image-item img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <h1>Image Gallery</h1>

    <?php
    // Define the directory where the images are stored
    $image_dir = 'images/';

    // Get all files from the image directory
    $image_files = glob($image_dir . '*');

    // Check if any image files exist
    if (!empty($image_files)) {
        // Display all image files
        foreach ($image_files as $image_file) {
            echo '<div class="image-item">';
            echo '<img src="' . $image_file . '" alt="Image">';
            echo '</div>';
        }
    } else {
        echo 'No images found.';
    }
    ?>

</body>
</html>

