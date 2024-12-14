<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Image Upload</title>
</head>
<body>
    <h1>Image Upload Test</h1>
    <form action="test_upload_handler.php" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        <br><br>

        <button type="submit">Upload</button>
    </form>
</body>
</html>
