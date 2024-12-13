<?php
include 'core/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $conn->query("UPDATE tributes SET status='approved' WHERE id=$id");
    } elseif ($action === 'reject') {
        $conn->query("DELETE FROM tributes WHERE id=$id");
    }
}

$result = $conn->query("SELECT * FROM tributes WHERE status='pending'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Pending Tributes</h1>
    <?php if ($result->num_rows > 0): ?>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Relationship</th>
            <th>Message</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['relationship']) ?></td>
            <td><?= htmlspecialchars($row['message']) ?></td>
            <td><?= $row['image'] ? "<img src='" . htmlspecialchars($row['image']) . "' width='100'>" : "No Image" ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" name="action" value="approve">Approve</button>
                    <button type="submit" name="action" value="reject">Reject</button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <?php else: ?>
    <p>No pending tributes.</p>
    <?php endif; ?>
</body>
</html>
