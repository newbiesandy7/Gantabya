<?php
// hotel_manager/upload_handler.php
session_start();
if (!isset($_SESSION['hotel_manager'])) {
    header("Location: login.php");
    exit;
}

$manager_id = $_SESSION['hotel_manager'];
$conn = new mysqli("localhost", "root", "", "blog_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$upload_type = $_POST['upload_type'];
$target_dir = "../images/"; // Ensure this directory exists and is writable

if ($upload_type === 'slideshow' && isset($_FILES['slideshow_image'])) {
    $file = $_FILES['slideshow_image'];
    $caption = $_POST['caption'];
    $filename = uniqid() . '_' . basename($file['name']);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO slideshow (manager_id, image_path, caption) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $manager_id, $filename, $caption);
        $stmt->execute();
        $stmt->close();
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<p>Failed to upload slideshow image. Error: " . $file['error'] . "</p>";
    }
} elseif ($upload_type === 'room' && isset($_FILES['room_image'])) {
    $file = $_FILES['room_image'];
    $room_type = $_POST['room_type'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $filename = uniqid() . '_' . basename($file['name']);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        $stmt = $conn->prepare("INSERT INTO rooms (manager_id, room_type, description, price_per_night, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issds", $manager_id, $room_type, $description, $price, $filename);
        $stmt->execute();
        $stmt->close();
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<p>Failed to upload room image. Error: " . $file['error'] . "</p>";
    }
} else {
    echo "<p>Invalid request or missing file.</p>";
}

$conn->close();
?>
