<?php
// handle_booking.php
session_start();
if (!isset($_SESSION['hotel_manager'])) {
    header("Location: hotel_manager/login.php"); // Redirect to manager login
    exit;
}

$conn = new mysqli("localhost", "root", "", "blog_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$booking_id = $_POST['booking_id'];
$action = $_POST['action'];
$user_email = $_POST['user_email'];
$room_type = $_POST['room_type'];
$checkin_date = $_POST['checkin_date'];
$checkout_date = $_POST['checkout_date'];
$user_name = $_POST['user_name']; // Added for personalized email

if ($action == 'confirm' || $action == 'cancel') {
  $sql = "UPDATE bookings SET status = ? WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("si", $action, $booking_id);

  if ($stmt->execute()) {
      // Prepare notification content
      if ($action == 'confirm') {
          $notif_title = "Booking Confirmed";
          $notif_msg = "Your booking for $room_type from $checkin_date to $checkout_date has been CONFIRMED.";
      } else { // action == 'cancel'
          $notif_title = "Booking Cancelled";
          $notif_msg = "Your booking for $room_type from $checkin_date to $checkout_date has been CANCELLED.";
      }

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
          // Debug: output values before insert
          // Remove or comment out these lines in production
          echo "<pre>user_id: $notif_user_id\ntitle: $notif_title\nmsg: $notif_msg</pre>";
          $notif_stmt = $conn->prepare("INSERT INTO notifications (user_id, title, message) VALUES (?, ?, ?)");
          if ($notif_stmt) {
              $notif_stmt->bind_param("iss", $notif_user_id, $notif_title, $notif_msg);
              if (!$notif_stmt->execute()) {
                  echo "Error inserting notification: " . $notif_stmt->error;
              } else {
                  echo "Notification inserted successfully.";
              }
              $notif_stmt->close();
          } else {
              echo "Error preparing notification statement: " . $conn->error;
          }
      } else {
          echo "Could not find user_id for booking_id: $booking_id";
      }

      header("Location: hotel_manager/dashboard.php"); 
      exit;
  } else {
      echo "Error updating booking status: " . $stmt->error;
  }
} else {
  echo "Invalid action";
}

$stmt->close();
$conn->close();
?>
