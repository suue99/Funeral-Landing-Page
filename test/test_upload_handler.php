<?php
// Include database connection
include 'core/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']); // Sanitize user input
    $imagePath = null;
    $uploadError = '';

    // Check if image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $imageName = basename($_FILES['image']['name']);
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Validate file type
        if (in_array($fileExtension, $allowedExtensions)) {
            $uploadDir = __DIR__ . '/Applications/XAMPP/xamppfiles/htdocs/eoa/images/memory/'; // Directory for images
            $newFileName = uniqid() . '.' . $fileExtension; // Unique file name
            $destinationPath = $uploadDir . $newFileName;

            // Move uploaded file
            if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                $imagePath = '/Applications/XAMPP/xamppfiles/htdocs/eoa/images/memory/' . $newFileName; // Save relative path
            } else {
                $uploadError = "Failed to move the uploaded file.";
            }
        } else {
            $uploadError = "Invalid file type. Allowed types are: " . implode(', ', $allowedExtensions);
        }
    } else {
        $uploadError = "No file uploaded.";
    }

    // Insert data into the database if no errors
    if (empty($uploadError)) {
        try {
            $stmt = $conn->prepare("INSERT INTO test_images (name, image_path) VALUES (?, ?)");
            $stmt->bind_param('ss', $name, $imagePath);

            if ($stmt->execute()) {
                echo "<p>Image uploaded successfully!</p>";
                echo "<p><strong>Name:</strong> $name</p>";
                echo "<p><strong>Image Path:</strong> $imagePath</p>";
                echo "<img src='$imagePath' alt='Uploaded Image' style='max-width: 300px;'>";
            } else {
                throw new Exception("Failed to insert data into the database.");
            }
        } catch (Exception $e) {
            echo "<p>Error: " . $e->getMessage() . "</p>";
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "<p>Error: $uploadError</p>";
    }
}
?>
