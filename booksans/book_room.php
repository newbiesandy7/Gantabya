<?php
// book_room.php
session_start();
$conn = new mysqli("localhost", "root", "", "blog_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$hotel_id = $_POST['hotel_id'];
$room_id = $_POST['room_id'];
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';
$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$checkin = $_POST['checkin_date'];
$checkout = $_POST['checkout_date'];

// Basic validation
if (empty($hotel_id) || empty($room_id) || empty($user_id) || empty($user_name) || empty($user_email) || empty($checkin) || empty($checkout)) {
    echo "<script>alert('❌ All fields are required.'); window.history.back();</script>";
    exit;
}

// Insert booking request
$sql = "INSERT INTO bookings (hotel_id, room_id, user_id, user_name, user_email, checkin_date, checkout_date)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiissss", $hotel_id, $room_id, $user_id, $user_name, $user_email, $checkin, $checkout);

if ($stmt->execute()) {
    // Get hotel manager's email for notification
    $manager_email_query = $conn->prepare("SELECT email FROM hotel_managers WHERE id = ?");
    $manager_email_query->bind_param("i", $hotel_id);
    $manager_email_query->execute();
    $manager_email_result = $manager_email_query->get_result();
    $manager_email_row = $manager_email_result->fetch_assoc();
    $manager_email = $manager_email_row['email'];

    // Get room type for email
    $room_type_query = $conn->prepare("SELECT room_type FROM rooms WHERE id = ?");
    $room_type_query->bind_param("i", $room_id);
    $room_type_query->execute();
    $room_type_result = $room_type_query->get_result();
    $room_type_row = $room_type_result->fetch_assoc();
    $room_type = $room_type_row['room_type'];

    // Send email to hotel manager (requires mail server configuration)
    if (!empty($manager_email)) {
        $to_manager = $manager_email;
        $subject_manager = "New Booking Request for " . htmlspecialchars($room_type);
        $message_manager = "Dear Hotel Manager,\n\nYou have a new booking request:\n\n"
                         . "Room Type: " . htmlspecialchars($room_type) . "\n"
                         . "Guest Name: " . htmlspecialchars($user_name) . "\n"
                         . "Guest Email: " . htmlspecialchars($user_email) . "\n"
                         . "Check-in Date: " . htmlspecialchars($checkin) . "\n"
                         . "Check-out Date: " . htmlspecialchars($checkout) . "\n\n"
                         . "Please log in to your dashboard to confirm or cancel this booking.\n"
                         . "Link: http://localhost/hotel_manager/dashboard.php (Adjust if your URL is different)\n\n"
                         . "Thank you.";
        $headers_manager = "From: no-reply@gantabya.com\r\n" .
                           "Reply-To: " . htmlspecialchars($user_email) . "\r\n" .
                           "X-Mailer: PHP/" . phpversion();

        // Uncomment the line below to enable email sending
        // mail($to_manager, $subject_manager, $message_manager, $headers_manager);
    }

    echo "<script>alert('✅ Booking request sent! We will notify you once the hotel confirms.'); window.location.href='view.php?hotel_id=" . $hotel_id . "';</script>";
} else {
    echo "<script>alert('❌ Error: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
