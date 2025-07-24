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

// Fetch hotel info 
$hotel_settings = $conn->query("SELECT * FROM hotel_managers WHERE id = $manager_id")->fetch_assoc();
if (!$hotel_settings) {
    echo "<h2>Hotel settings not found.</h2>";
    exit;
}
// Safely fetch customization settings
$background_type = isset($hotel_settings['background_type']) ? $hotel_settings['background_type'] : 'color';
$accent_color = isset($hotel_settings['accent_color']) ? $hotel_settings['accent_color'] : '#f7c948';

// Handle saving customization settings
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_customization'])) {
    $font_family = $_POST['font_family'];
    $text_color = $_POST['text_color'];
    // Fix: Use correct bind_param argument count (2 strings, 1 int)
    $update_stmt = $conn->prepare("UPDATE hotel_managers SET font_family = ?, text_color = ? WHERE id = ?");
    $update_stmt->bind_param("ssi", $font_family, $text_color, $manager_id);
    $update_stmt->execute();
    $update_stmt->close();
    // Refresh settings after update
    $hotel_settings = $conn->query("SELECT * FROM hotel_managers WHERE id = $manager_id")->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Hotel Manager Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">     
<link rel="stylesheet" href="../css/navbar_custom.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/script.js" defer></script>
  <style>
    
    #preview-frame {
      border: 1px solid #ccc;
      padding: 20px;
      margin-top: 20px;
      min-height: 150px;
      text-align: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      transition: all 0.3s ease;
      background-size: cover;
      background-position: center;
    }
    #preview-frame h2 {
      margin-bottom: 10px;
    }
    #preview-frame p {
      margin-bottom: 15px;
    }
    #preview-button {
      padding: 8px 15px;
      border-radius: 5px;
      border: none;
      color: white;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <div class="mb-4">
      <a href="../../index.php" class="btn btn-success" style="font-weight:600; border-radius:8px; padding:10px 24px; font-size:1.1em;"><i class="fa fa-arrow-left me-2"></i>Back to Mainpage</a>
    </div>
    <h2>Welcome, <?php echo htmlspecialchars($hotel_settings['hotel_name']); ?> Manager</h2>

    <!-- Slideshow Upload Section -->
    <section class="dashboard-section">
      <h3>Slideshow Images</h3>
      <form action="upload_handler.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="slideshow_image" required>
        <input type="text" name="caption" placeholder="Poetic Caption for Image">
        <input type="hidden" name="upload_type" value="slideshow">
        <button type="submit">Upload Slide</button>
      </form>
    </section>

    <!-- Room Entry Section -->
    <section class="dashboard-section">
      <h3>Add Room Type</h3>
      <form action="upload_handler.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="room_type" placeholder="Room Type (e.g. Deluxe Suite)" required>
        <textarea name="description" placeholder="Room Description" required></textarea>
        <input type="number" step="0.01" name="price" placeholder="Price per Night" required>
        <input type="file" name="room_image" required>
        <input type="hidden" name="upload_type" value="room">
        <button type="submit">Add Room</button>
      </form>
    </section>

    <!-- Existing Rooms -->
    <section class="dashboard-section">
        <h3>Your Rooms</h3>
        <?php
        $rooms = $conn->query("SELECT * FROM rooms WHERE manager_id = $manager_id ORDER BY id DESC");
        if ($rooms->num_rows > 0) {
            while ($room = $rooms->fetch_assoc()) {
                echo '<div style="margin-bottom: 20px; border-left: 4px solid var(--main-green); padding-left: 10px;">';
                echo '<strong>' . htmlspecialchars($room['room_type']) . '</strong><br>';
                echo 'Price: $' . htmlspecialchars($room['price_per_night']) . '<br>';
                echo '<small>' . htmlspecialchars(substr($room['description'], 0, 80)) . '...</small><br>';
                echo '<a href="edit_room.php?id=' . $room['id'] . '" style="color: var(--mustard-yellow);">Edit</a>';
                echo '</div>';
            }
        } else {
            echo "<p>You haven't added any rooms yet.</p>";
        }
        ?>
    </section>

    <!-- Page Customization Section -->
    <section class="dashboard-section">
      <h3>Customize Page Appearance</h3>
      <form action="dashboard.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="save_customization" value="1">
        <label>Choose Font:</label>
        <select name="font_family" id="fontSelect">
          <option value="'Segoe UI', sans-serif" <?php echo (isset($hotel_settings['font_family']) && $hotel_settings['font_family'] == "'Segoe UI', sans-serif" ? 'selected' : ''); ?>>Segoe UI</option>
          <option value="Arial, sans-serif" <?php echo (isset($hotel_settings['font_family']) && $hotel_settings['font_family'] == "Arial, sans-serif" ? 'selected' : ''); ?>>Arial</option>
          <option value="Georgia, serif" <?php echo (isset($hotel_settings['font_family']) && $hotel_settings['font_family'] == "Georgia, serif" ? 'selected' : ''); ?>>Georgia</option>
          <option value="Verdana, sans-serif" <?php echo (isset($hotel_settings['font_family']) && $hotel_settings['font_family'] == "Verdana, sans-serif" ? 'selected' : ''); ?>>Verdana</option>
          <option value="'Courier New', monospace" <?php echo (isset($hotel_settings['font_family']) && $hotel_settings['font_family'] == "'Courier New', monospace" ? 'selected' : ''); ?>>Courier New</option>
        </select>

        <label>Select Text Color:</label>
        <input type="color" name="text_color" id="textColorPicker" value="<?php echo htmlspecialchars(isset($hotel_settings['text_color']) ? $hotel_settings['text_color'] : '#222222'); ?>" />

        
        <button type="submit">Save Customization</button>
      </form>

      <h4>Live Preview</h4>
      <div id="preview-frame" style="
        <?php
        if (isset($hotel_settings['background_type']) && $hotel_settings['background_type'] == 'color') {
            echo 'background-color: ' . htmlspecialchars(isset($hotel_settings['background_value']) ? $hotel_settings['background_value'] : '#ffffff') . ';';
        } elseif (isset($hotel_settings['background_type']) && $hotel_settings['background_type'] == 'image' && isset($hotel_settings['background_value']) && $hotel_settings['background_value']) {
            echo 'background-image: url(../images/' . htmlspecialchars($hotel_settings['background_value']) . ');';
        }
        echo 'color: ' . htmlspecialchars(isset($hotel_settings['text_color']) ? $hotel_settings['text_color'] : '#222222') . ';';
        echo 'font-family: ' . htmlspecialchars(isset($hotel_settings['font_family']) ? $hotel_settings['font_family'] : "'Segoe UI', sans-serif") . ';';
        ?>
      ">
        <h2 id="preview-title" style="color: <?php echo htmlspecialchars(isset($hotel_settings['text_color']) ? $hotel_settings['text_color'] : '#222222'); ?>;">Your Hotel Name</h2>
        <p style="color: <?php echo htmlspecialchars(isset($hotel_settings['text_color']) ? $hotel_settings['text_color'] : '#222222'); ?>;">This is a sample room description.</p>
        <button id="preview-button" style="background-color: <?php echo htmlspecialchars(isset($hotel_settings['accent_color']) ? $hotel_settings['accent_color'] : '#f7c948'); ?>;">Book Now</button>
      </div>
    </section>

    <!-- Booking Requests Panel -->
    <section class="dashboard-section">
        <h3>Booking Requests</h3>
        <?php
        $bookings_sql = "SELECT b.*, r.room_type FROM bookings b JOIN rooms r ON b.room_id = r.id WHERE b.hotel_id = ? ORDER BY b.created_at DESC";
        $bookings_stmt = $conn->prepare($bookings_sql);
        $bookings_stmt->bind_param("i", $manager_id);
        $bookings_stmt->execute();
        $bookings_result = $bookings_stmt->get_result();

        if ($bookings_result->num_rows > 0) {
            while ($booking = $bookings_result->fetch_assoc()) {
                echo '<div class="booking-item">';
                echo '<p><strong>Room:</strong> ' . htmlspecialchars($booking['room_type']) . '</p>';
                echo '<p><strong>User:</strong> ' . htmlspecialchars($booking['user_name']) . ' (' . htmlspecialchars($booking['user_email']) . ')</p>';
                echo '<p><strong>Check-in:</strong> ' . htmlspecialchars($booking['checkin_date']) . '</p>';
                echo '<p><strong>Check-out:</strong> ' . htmlspecialchars($booking['checkout_date']) . '</p>';
                echo '<p><strong>Status:</strong> ' . htmlspecialchars($booking['status']) . '</p>';

                if ($booking['status'] == 'pending') {
                    echo '<form action="handle_booking.php" method="POST" style="display:inline-block; margin-right: 10px;">';
                    echo '<input type="hidden" name="booking_id" value="' . $booking['id'] . '">';
                    echo '<input type="hidden" name="user_email" value="' . htmlspecialchars($booking['user_email']) . '">';
                    echo '<input type="hidden" name="room_type" value="' . htmlspecialchars($booking['room_type']) . '">';
                    echo '<input type="hidden" name="checkin_date" value="' . htmlspecialchars($booking['checkin_date']) . '">';
                    echo '<input type="hidden" name="checkout_date" value="' . htmlspecialchars($booking['checkout_date']) . '">';
                    echo '<button type="submit" name="action" value="confirm">Confirm</button>';
                    echo '</form>';
                    echo '<form action="handle_booking.php" method="POST" style="display:inline-block;">';
                    echo '<input type="hidden" name="booking_id" value="' . $booking['id'] . '">';
                    echo '<input type="hidden" name="user_email" value="' . htmlspecialchars($booking['user_email']) . '">';
                    echo '<input type="hidden" name="room_type" value="' . htmlspecialchars($booking['room_type']) . '">';
                    echo '<input type="hidden" name="checkin_date" value="' . htmlspecialchars($booking['checkin_date']) . '">';
                    echo '<input type="hidden" name="checkout_date" value="' . htmlspecialchars($booking['checkout_date']) . '">';
                    echo '<button type="submit" name="action" value="cancel">Cancel</button>';
                    echo '</form>';
                }
                echo '</div>';
            }
        } else {
            echo "<p>No booking requests.</p>";
        }
        $bookings_stmt->close();
        ?>
    </section>

  </div>

  <script>
    const bgTypeSelect = document.getElementById("bgType");
    const bgColorInputDiv = document.getElementById("bgColorInput");
    const bgImageInputDiv = document.getElementById("bgImageInput");

    bgTypeSelect.addEventListener("change", function () {
      if (this.value === "color") {
        bgColorInputDiv.style.display = "block";
        bgImageInputDiv.style.display = "none";
      } else {
        bgColorInputDiv.style.display = "none";
        bgImageInputDiv.style.display = "block";
      }
    });

    // Live preview functionality
    const previewFrame = document.getElementById('preview-frame');
    const fontSelect = document.getElementById('fontSelect');
    const textColorPicker = document.getElementById('textColorPicker');
    const accentColorPicker = document.getElementById('accentColorPicker');
    const bgColorPicker = document.querySelector('input[name="background_color"]');
    const bgImageInput = document.querySelector('input[name="background_image"]');
    const previewTitle = document.getElementById('preview-title');
    const previewButton = document.getElementById('preview-button');

    fontSelect.addEventListener('change', () => {
      previewFrame.style.fontFamily = fontSelect.value;
    });

    textColorPicker.addEventListener('input', () => {
      previewFrame.style.color = textColorPicker.value;
      previewTitle.style.color = textColorPicker.value;
      previewFrame.querySelector('p').style.color = textColorPicker.value;
    });

    accentColorPicker.addEventListener('input', () => {
      previewButton.style.backgroundColor = accentColorPicker.value;
    });

    bgColorPicker.addEventListener('input', () => {
      if (bgTypeSelect.value === 'color') {
        previewFrame.style.backgroundImage = 'none';
        previewFrame.style.backgroundColor = bgColorPicker.value;
      }
    });

    bgImageInput.addEventListener('change', (e) => {
      if (bgTypeSelect.value === 'image') {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = function (e) {
            previewFrame.style.backgroundImage = `url(${e.target.result})`;
            previewFrame.style.backgroundSize = 'cover';
            previewFrame.style.backgroundPosition = 'center';
            previewFrame.style.backgroundColor = 'transparent';
          };
          reader.readAsDataURL(file);
        }
      }
    });
  </script>
</body>
</html>
