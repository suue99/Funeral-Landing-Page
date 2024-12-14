<?php
include 'core/db_connection.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploadDir = '/Applications/XAMPP/xamppfiles/htdocs/eoa/images/memory/'; // Ensure this is relative to your project root
    $imagePath = null;
   
    if (!empty($_FILES['image']['name'])) {
        $imageName = basename($_FILES['image']['name']);
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $newFileName = uniqid() . '.' . $fileExtension;
        $destPath = $uploadDir . $newFileName;

        if (in_array($fileExtension, $allowedExtensions)) {
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                echo "File uploaded successfully!";
            } else {
                echo "Error: Failed to move the uploaded file.<br>";
                echo "Temp File Path: $fileTmpPath<br>";
                echo "Destination Path: $destPath<br>";
                echo "Upload Directory: $uploadDir<br>";
                echo "Check if upload directory exists: " . (is_dir($uploadDir) ? 'Yes' : 'No') . "<br>";
                echo "Check if temp file exists: " . (file_exists($fileTmpPath) ? 'Yes' : 'No') . "<br>";
            }
            
        } else {
            echo "Error: Invalid file type. Allowed types are: " . implode(', ', $allowedExtensions);
        }
    } else {
        echo "No image uploaded.";
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload with Database</title>
</head>
<body>
    <h3>Image Upload with Database</h3>
    <!-- Form to upload the image -->
    <form action="image.php" method="post" enctype="multipart/form-data">
        <label for="image">Choose an image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
