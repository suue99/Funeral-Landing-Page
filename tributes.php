<?php
include 'core/db_connection.php';

$result = $conn->query("SELECT * FROM tributes WHERE status='approved'");


// Dynamically fetch the banner image from the database or fallback to a default
$bannerImageQuery = $conn->query("SELECT image_path FROM banners WHERE banner_type='tribute' LIMIT 1");
$bannerImage = $bannerImageQuery->num_rows > 0 ? $bannerImageQuery->fetch_assoc()['image_path'] : 'default-banner.jpg';

?>
<!DOCTYPE html>
<html>
<head>
    <title>Tributes | Rev Elijah O. Akinyemi</title>
</head>
<body>
<?php include 'nav/header.php'; ?>
    <!-- Banner Section -->
    <div class="banner">
        <div class="banner-text">
            <h1>Rev. Elijah Oluranti Akinyemi</h1>
            <p>1956 - 2024</p>
        </div>
        <div class="banner-image">
            <img src="<?= htmlspecialchars($bannerImage) ?>" alt="Rev. Elijah Oluranti Akinyemi">
        </div>
    </div>

        <!-- Tributes Section -->
    <div class="tributes-container">
        <h1>Tributes</h1>
        <?php if ($result->num_rows > 0): ?>
    <div class="tributes-container">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="tribute">
            <h2>
                <?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['relationship']) ?>)
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
                    echo "<span> | " . implode(", ", $additionalInfo) . "</span>";
                }
                ?>
            </h2>
            <p><?= htmlspecialchars($row['message']) ?></p>
            <?php if ($row['image']): ?>
            <img src="<?= htmlspecialchars($row['image']) ?>" alt="Tribute Image">
            <?php endif; ?>
        </div>
        <hr>
        <?php endwhile; ?>
    </div>
    <?php else: ?>
    <p>No approved tributes yet.</p>
    <?php endif; ?>
    </div>
</body>
</html>
