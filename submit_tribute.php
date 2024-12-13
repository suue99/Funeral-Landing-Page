<?php
include 'core/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $relationship = htmlspecialchars($_POST['relationship']);
    $message = htmlspecialchars($_POST['message']);
    $location = isset($_POST['location']) ? htmlspecialchars($_POST['location']) : null;
    $church_name = isset($_POST['church_name']) ? htmlspecialchars($_POST['church_name']) : null;

    // Handle file upload if an image is provided
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = uniqid() . '-' . basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
            $imagePath = $uploadFile;
        }
    }

    // Insert the data into the tributes table
    $stmt = $conn->prepare("INSERT INTO tributes (name, relationship, message, location, church_name, image, status) VALUES (?, ?, ?, ?, ?, ?, 'pending')");
    $stmt->bind_param("ssssss", $name, $relationship, $message, $location, $church_name, $imagePath);

    if ($stmt->execute()) {
        echo "Your tribute has been submitted for approval.";
    } else {
        echo "There was an error submitting your tribute. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
?>