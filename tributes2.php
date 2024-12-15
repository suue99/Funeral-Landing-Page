<?php
include 'core/db_connection.php';

// Fetch approved tributes
$result = $conn->query("SELECT * FROM tributes WHERE status='approved'");

// Fetch the banner image from the database or fallback to a default
$bannerImageQuery = $conn->query("SELECT image_path FROM banners WHERE banner_type='tribute' LIMIT 1");
$bannerImage = $bannerImageQuery->num_rows > 0 ? $bannerImageQuery->fetch_assoc()['image_path'] : 'default-banner.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tributes | Rev Elijah O. Akinyemi</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Include Header -->
    <?php include 'nav/header.php'; ?>

    <!-- Banner Section -->
    <div class="banner">
        <div class="banner-text">
            <h1>Rev. Elijah Oluranti Akinyemi</h1>
            <p>1956 - 2024</p>
            <p>“A life well-lived leaves a legacy of love and memories.”</p>
        </div>
        <div class="banner-image">
            <img src="<?= htmlspecialchars($bannerImage) ?>" alt="Rev. Elijah Oluranti Akinyemi">
        </div>
    </div>

    <!-- Tributes Section -->
    <div class="tributes-container">
        <h2>Tributes</h2>
        <?php if ($result->num_rows > 0): ?>
            <div class="tribute-grid">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="tribute-card">
                        <h3><?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['relationship']) ?>)</h3>
                        <?php
                        // Concatenate location and church name
                        $additionalInfo = [];
                        if (!empty($row['location'])) {
                            $additionalInfo[] = htmlspecialchars($row['location']);
                        }
                        if (!empty($row['church_name'])) {
                            $additionalInfo[] = htmlspecialchars($row['church_name']);
                        }
                        if (!empty($additionalInfo)) {
                            echo "<p class='additional-info'>" . implode(", ", $additionalInfo) . "</p>";
                        }
                        ?>
                        <p class="message-preview"><?= htmlspecialchars(substr($row['message'], 0, 100)) ?>...</p>
                        <?php if ($row['image']): ?>
                            <a href="#modal-<?= $row['id'] ?>">
                                <img src="<?= htmlspecialchars($row['image']) ?>" alt="Tribute Image" class="thumbnail">
                            </a>
                            <!-- Modal -->
                            <div id="modal-<?= $row['id'] ?>" class="modal">
                                <a href="#" class="modal-close">&times;</a>
                                <div class="modal-content">
                                    <img src="<?= htmlspecialchars($row['image']) ?>" alt="Full Tribute Image">
                                    <h3><?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['relationship']) ?>)</h3>
                                    <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No tributes have been submitted yet.</p>
        <?php endif; ?>
    </div>

    <!-- Include Footer -->
    <?php include 'nav/footer.php'; ?>
</body>
</html>
