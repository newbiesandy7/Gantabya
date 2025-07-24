<?php
session_start();
include '../db_conn.php';
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Browse Hotels</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">     
<link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/style.css"> 
    <meta charset="UTF-8">
  </head>
<body>
<?php
  include 'includes/navbar2.php';
?>
  <!-- <div class="dark-mode-toggle">
    <label>
      <input type="checkbox" id="darkToggle" />
      <span>🌙 Dark Mode</span>
    </label>
  </div> -->
  <h1 style="text-align: center; color: var(--main-green); margin: 40px 0 20px;">Available Hotels</h1>
  <div class="hotel-list">
    <?php
      $conn = new mysqli("localhost", "root", "", "blog_db");
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $hotels = $conn->query("SELECT id, hotel_name, hotel_location FROM hotel_managers ORDER BY hotel_name ASC");
      if ($hotels->num_rows > 0) {
          while ($hotel = $hotels->fetch_assoc()) {
              $hotel_id = $hotel['id'];
              $hotel_name = htmlspecialchars($hotel['hotel_name']);
              $hotel_location = htmlspecialchars($hotel['hotel_location']);

              // Fetch first slideshow image
              $img = "default_hotel.jpg"; // Default image if no slideshow image is found
              $img_res = $conn->query("SELECT image_path FROM slideshow WHERE manager_id=$hotel_id LIMIT 1");
              if ($img_res && $img_res->num_rows > 0) {
                  $img_row = $img_res->fetch_assoc();
                  $img = htmlspecialchars($img_row['image_path']);
              }
              echo '
              <div class="hotel-card">
                <img src="images/' . $img . '" alt="' . $hotel_name . '">
                <h3>' . $hotel_name . '</h3>
                <p>' . $hotel_location . '</p>
                <a href="view.php?hotel_id=' . $hotel_id . '" class="visit-btn">Visit Page</a>
              </div>';
          }
      } else {
          echo '<p style="text-align: center; width: 100%; padding: 50px;">No hotels registered yet. Please check back later!</p>';
      }
      $conn->close();
    ?>
  </div>
<?php
include "includes/footer2.php";
?>
<!-- Bootstrap JS for dropdowns -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>

