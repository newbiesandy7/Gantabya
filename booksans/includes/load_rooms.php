<?php
$hotel_id = isset($hotel_id) ? intval($hotel_id) : (isset($_GET['hotel_id']) ? intval($_GET['hotel_id']) : 0);
$conn = new mysqli("localhost", "root", "", "blog_db");

$rooms = $conn->query("SELECT id, room_type, description, image_path FROM rooms WHERE manager_id = $hotel_id ORDER BY id DESC");

if ($rooms->num_rows > 0) {
    while ($room = $rooms->fetch_assoc()) {
        $roomId = "room-" . htmlspecialchars($room['id']);
        echo '<div class="room-card">';
        echo '<img src="images/' . htmlspecialchars($room['image_path']) . '" alt="' . htmlspecialchars($room['room_type']) . '">';
        echo '<h3>' . htmlspecialchars($room['room_type']) . '</h3>';
        echo '<p>' . htmlspecialchars(substr($room['description'], 0, 100)) . '...</p>';
        echo '<button class="learn-btn" onclick="scrollToDetails(\'' . $roomId . '\')">Learn More</button>';
        echo '</div>';
    }
} else {
    echo '<p style="text-align: center; width: 100%; padding: 20px;">No rooms added yet for this hotel.</p>';
}
?>
