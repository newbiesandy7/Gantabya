<?php
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

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM rooms WHERE id = ? AND manager_id = ?");
$stmt->bind_param("ii", $id, $manager_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<p>Room not found or you don't have permission.</p>";
    exit;
}

$room = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Room</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">     
<link rel="stylesheet" href="../css/navbar_custom.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Edit Room</h2>
        <form action="edit_room_handler.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $room['id']; ?>">
            <label>Room Type</label>
            <input type="text" name="room_type" value="<?php echo htmlspecialchars($room['room_type']); ?>" required>

            <label>Description</label>
            <textarea name="description" required><?php echo htmlspecialchars($room['description']); ?></textarea>

            <label>Price per Night</label>
            <input type="number" name="price_per_night" value="<?php echo $room['price_per_night']; ?>" step="0.01" required>

            <button type="submit">Save Changes</button>
        </form>
    </div>
</body>
</html>
