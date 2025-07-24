<?php
session_start();
if (!isset($_SESSION['hotel_manager'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "root", "", "blog_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$manager_id = $_SESSION['hotel_manager'];
$id = intval($_POST['id']);
$room_type = $_POST['room_type'];
$description = $_POST['description'];
$price = floatval($_POST['price_per_night']);

// Verify ownership
$stmt = $conn->prepare("SELECT id FROM rooms WHERE id = ? AND manager_id = ?");
$stmt->bind_param("ii", $id, $manager_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo "<p>Permission denied.</p>";
    exit;
}

$stmt->close();

// Update room
$update = $conn->prepare("UPDATE rooms SET room_type = ?, description = ?, price_per_night = ? WHERE id = ? AND manager_id = ?");
$update->bind_param("ssdii", $room_type, $description, $price, $id, $manager_id);
$update->execute();

header("Location: dashboard.php");
exit;
?>
