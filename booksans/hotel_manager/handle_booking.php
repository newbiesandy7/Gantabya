<?php
// Booking confirmation/cancellation handler (notifications only, no email)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && isset($_POST['booking_id'])) {
    $action = $_POST['action'];
    $booking_id = intval($_POST['booking_id']);
    $room_type = isset($_POST['room_type']) ? $_POST['room_type'] : '';
    $checkin_date = isset($_POST['checkin_date']) ? $_POST['checkin_date'] : '';
    $checkout_date = isset($_POST['checkout_date']) ? $_POST['checkout_date'] : '';

    $conn = new mysqli("localhost", "root", "", "blog_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($action === 'confirm') {
        $status = 'confirmed';
    } elseif ($action === 'cancel') {
        $status = 'cancelled';
    } else {
        exit('Invalid action.');
    }

    // Update booking status
    $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $booking_id);
    $stmt->execute();
    $stmt->close();

    // Insert notification into notifications table using mysqli
    $user_id_query = $conn->prepare("SELECT user_id FROM bookings WHERE id = ?");
    if (!$user_id_query) {
        echo "Error preparing user_id query: " . $conn->error;
    }
    $user_id_query->bind_param("i", $booking_id);
    if (!$user_id_query->execute()) {
        echo "Error executing user_id query: " . $user_id_query->error;
    }
    $user_id_result = $user_id_query->get_result();
    if (!$user_id_result) {
        echo "Error getting user_id result: " . $user_id_query->error;
    }
    $user_id_row = $user_id_result ? $user_id_result->fetch_assoc() : null;
    $notif_user_id = $user_id_row ? $user_id_row['user_id'] : null;
    if ($notif_user_id) {
        $notif_title = ($action === 'confirm') ? 'Booking Confirmed' : 'Booking Cancelled';
        $notif_msg = ($action === 'confirm')
            ? "Your booking for $room_type from $checkin_date to $checkout_date has been CONFIRMED."
            : "Your booking for $room_type from $checkin_date to $checkout_date has been CANCELLED.";
        $notif_stmt = $conn->prepare("INSERT INTO notifications (user_id, title, message) VALUES (?, ?, ?)");
        if ($notif_stmt) {
            $notif_stmt->bind_param("iss", $notif_user_id, $notif_title, $notif_msg);
            if (!$notif_stmt->execute()) {
                echo "Error inserting notification: " . $notif_stmt->error;
            }
            $notif_stmt->close();
        } else {
            echo "Error preparing notification statement: " . $conn->error;
        }
    } else {
        echo "Could not find user_id for booking_id: $booking_id";
    }

    // Redirect back to dashboard
    header("Location: dashboard.php");
    exit;
}
?>
