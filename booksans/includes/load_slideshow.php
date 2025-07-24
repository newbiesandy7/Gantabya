<?php
$hotel_id = isset($hotel_id) ? intval($hotel_id) : (isset($_GET['hotel_id']) ? intval($_GET['hotel_id']) : 0);
$conn = new mysqli("localhost", "root", "", "blog_db");

$slides = $conn->query("SELECT image_path, caption FROM slideshow WHERE manager_id = $hotel_id ORDER BY id DESC");

if ($slides->num_rows > 0) {
    $first = true;
    while ($row = $slides->fetch_assoc()) {
        echo '<div class="slide' . ($first ? ' active' : '') . '">';
        echo '<img src="images/' . htmlspecialchars($row['image_path']) . '" alt="Slide">';
        echo '<div class="overlay"><p>' . htmlspecialchars($row['caption']) . '</p></div>';
        echo '</div>';
        $first = false;
    }
} else {
    echo "<div class='slide active'><img src='images/default_hero.jpg' alt='Welcome'><div class='overlay'><p>Welcome to our hotel!</p></div></div>";
    // You might want a default image in your /images/ folder named default_hero.jpg
}
?>
