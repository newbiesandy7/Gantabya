<?php
$hotel_id = isset($hotel_id) ? intval($hotel_id) : (isset($_GET['hotel_id']) ? intval($_GET['hotel_id']) : 0);
$conn = new mysqli("localhost", "root", "", "blog_db");

$rooms = $conn->query("SELECT id, room_type, description FROM rooms WHERE manager_id = $hotel_id ORDER BY id DESC");

if ($rooms->num_rows > 0) {
    while ($room = $rooms->fetch_assoc()) {
        $roomId = "room-" . htmlspecialchars($room['id']);
        echo '<div class="room-detail" id="' . $roomId . '">';
        echo '<h3>' . htmlspecialchars($room['room_type']) . '</h3>';
        echo '<p>' . nl2br(htmlspecialchars($room['description'])) . '</p>';
        // Pass room ID and type to openBooking function
        echo '<button class="book-btn" onclick="openBooking(' . htmlspecialchars($room['id']) . ', \'' . htmlspecialchars($room['room_type']) . '\')">Book Now</button>';
        echo '</div>';
    }
} else {
    echo '<div class="room-detail"><p>No room details available yet. Please check back later!</p></div>';
}
?>
