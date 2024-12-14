<?php
session_start();

include '../core/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Debug: Check inputs
    echo "Username: $username<br>";
    echo "Password: $password<br>";

    // Fetch admin details
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    // Debug: Check if admin exists
    if ($admin) {
        echo "Admin Found: " . htmlspecialchars($admin['username']) . "<br>";
        echo "Stored Password: " . htmlspecialchars($admin['password']) . "<br>";

        // Check the password
        if ($password === $admin['password']) {
            echo "Password matched!<br>";

            // Store session data
            $_SESSION['logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['username'] = $admin['username'];

            // Redirect to admin panel
            header("Location: admin.php");
            exit();
        } else {
            echo "Password mismatch!<br>";
        }
    } else {
        echo "Admin not found!<br>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body>
    <h1>Admin Login</h1>
    <form method="POST" action="login.php">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>


