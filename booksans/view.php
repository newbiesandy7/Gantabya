<?php
session_start();
$sName = "localhost";
$uName = "root";
$pass = "";
$db_name = "blog_db";
try {
    $conn = new PDO("mysql:host=$sName;dbname=$db_name", 
                    $uName, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
}catch(PDOException $e){
  echo "Connection failed : ". $e->getMessage();
  exit();
}
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	 $logged = true;
	 $user_id = $_SESSION['user_id'];
}
?>
<?php
$hotel_id = isset($_GET['hotel_id']) ? intval($_GET['hotel_id']) : 0;
$stmt = $conn->prepare("SELECT * FROM hotel_managers WHERE id = ?");
$stmt->execute([$hotel_id]);
$hotel = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$hotel) {
    echo "<h2>Hotel not found.</h2>";
    exit;
}
$background_style = '';
// if ($hotel['background_type'] == 'color') {
//     $background_style = 'background-color: ' . htmlspecialchars($hotel['background_value']) . ';';
// } elseif ($hotel['background_type'] == 'image' && $hotel['background_value']) {
//     $background_style = 'background-image: url(images/' . htmlspecialchars($hotel['background_value']) . '); background-size: cover; background-position: center;';
// }
$font_family_style = 'font-family: ' . htmlspecialchars($hotel['font_family']) . ';';
$text_color_style = 'color: ' . htmlspecialchars($hotel['text_color']) . ';';
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($hotel['hotel_name']); ?> | Gantabya</title>
  <link rel="stylesheet" href="css/style.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">     
<link rel="stylesheet" href="css/navbar.css">
  <script src="js/script.js" defer></script>
  <style>
    * {
      <?php echo $background_style; ?>
      <?php echo $font_family_style; ?>
      <?php echo $text_color_style; ?>
    }
    .intro h1, .section-title, .room-card h3, .room-detail h3 {
      color: <?php echo $accent_color_value; ?>; /
    }
    .learn-btn, .book-btn, .booking-form button[type="submit"] {
      background-color: <?php echo $accent_color_value; ?>;
    }
    .learn-btn:hover, .book-btn:hover, .booking-form button[type="submit"]:hover {
      background-color: <?php echo $accent_color_value; ?>;
      filter: brightness(90%); 
    }
    .overlay {
      background-color: rgba(/*<?php echo hex2rgb($accent_color_value); ?>*/, 0.6); Use accent color for overlay
    }
    .room-detail {
        border-left-color: <?php echo $accent_color_value; ?>;
    }
    .room-detail p::first-letter {
        color: <?php echo $accent_color_value; ?>;
    }

    body.dark .intro h1, body.dark .section-title, body.dark .room-card h3, body.dark .room-detail h3 {
        color: #9FD3AF; 
    }
    body.dark .learn-btn, body.dark .book-btn, body.dark .booking-form button[type="submit"] {
        background-color: #FFCE4A; 
        color: #072C21;
    }
    body.dark .learn-btn:hover, body.dark .book-btn:hover, body.dark .booking-form button[type="submit"]:hover {
        background-color: #e5b93c; 
    }
    body.dark .overlay {
        background-color: rgba(159, 211, 175, 0.6);
    }
    body.dark .room-detail {
        border-left-color: #9FD3AF;
    }
    body.dark .room-detail p::first-letter {
        color: #FFCE4A;
    }
  </style>
</head>
<body>
  <?php
  include 'includes/navBar2.php';
  ?>
  <header class="hero-section" id="hero-section">
    <div class="slideshow">
      <?php include "includes/load_slideshow.php"; ?>
    </div>
    <div class="overlay">
      <p><?php echo htmlspecialchars($hotel['hotel_name']) . ' - ' . htmlspecialchars($hotel['hotel_location']); ?></p>
    </div>
  </header>
    <!-- <div class="dark-mode-toggle">
      <label>
        <input type="checkbox" id="darkToggle">
        <span>🌙 Dark Mode</span>
      </label>
    </div> -->

  <section class="rooms" id="rooms">
    <h2 class="section-title">Our Rooms</h2>
    <div class="room-grid">
      <?php include "includes/load_rooms.php"; ?>
    </div>
  </section>

  <section class="room-details" id="room-details">
    <?php include "includes/load_room_details.php"; ?>
  </section>

  <!-- Booking Form Popup -->
  <div class="booking-popup" id="bookingPopup">
    <div class="booking-form">
      <h3>Book Your Stay</h3>
      <form action="book_room.php" method="POST">
        <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>">
        <input type="hidden" name="room_id" id="bookingRoomId">

        <label>Room Type:</label>
        <input type="text" id="roomType" readonly>

        <label>Your Name:</label>
        <input type="text" name="user_name" required>

        <label>Your Email:</label>
        <input type="email" name="user_email" required>

        <label>Check-in:</label>
        <input type="date" name="checkin_date" required>

        <label>Check-out:</label>
        <input type="date" name="checkout_date" required>

        <button type="submit">Book Now</button>
        <button type="button" onclick="closeBooking()">Cancel</button>
      </form>
    </div>
  </div>
  
<?php
include "includes/footer2.php";
?>
</body>
</html>
