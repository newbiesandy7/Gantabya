<?php
session_start();
require_once 'db_conn.php';
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
} else {
    header("Location: login.php");
    exit();
}

// Fetch notifications for the user
$notifications = [];
try {
    $stmt = $conn->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC");
    $stmt->execute([$user_id]);
    $notifications = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Error fetching notifications: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Notifications</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar_custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'inc/NavBar.php'; ?>
<div class="container" style="max-width: 800px; margin: 40px auto;">
    <h2>Your Notifications</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <?php if (empty($notifications)): ?>
        <div class="alert alert-info">No notifications yet.</div>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($notifications as $note): ?>
                <li class="list-group-item <?php echo $note['is_read'] ? '' : 'list-group-item-warning'; ?>">
                    <strong><?php echo htmlspecialchars($note['title']); ?></strong><br>
                    <?php echo htmlspecialchars($note['message']); ?><br>
                    <small><?php echo date('F j, Y, g:i a', strtotime($note['created_at'])); ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
