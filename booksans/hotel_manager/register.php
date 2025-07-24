<?php
// hotel_manager/register.php

// Turn on error reporting to catch what's wrong
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $hotel_name = $_POST['hotel_name'];
    $hotel_location = $_POST['hotel_location'];

    $conn = new mysqli("localhost", "root", "", "blog_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    
    $conn->query("CREATE DATABASE IF NOT EXISTS blog_db");

    
    $conn->select_db("blog_db");

    // Hotel Managers
    $conn->query("CREATE TABLE IF NOT EXISTS hotel_managers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(100) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        hotel_name VARCHAR(255),
        hotel_location VARCHAR(255),
        -- Customization fields
        background_type VARCHAR(50) DEFAULT 'color', 
        background_value VARCHAR(255) DEFAULT '#FDFDFD', 
        font_family VARCHAR(255) DEFAULT \"'Segoe UI', sans-serif\", 
        text_color VARCHAR(7) DEFAULT '#333333',
        accent_color VARCHAR(7) DEFAULT '#6D9773' 
    )");

    // Table for Rooms (managed by hotel managers)
    $conn->query("CREATE TABLE IF NOT EXISTS rooms (
        id INT AUTO_INCREMENT PRIMARY KEY,
        manager_id INT,
        room_type VARCHAR(255),
        description TEXT,
        price_per_night DECIMAL(10,2),
        image_path VARCHAR(255), -- Stores filename
        FOREIGN KEY (manager_id) REFERENCES hotel_managers(id) ON DELETE CASCADE
    )");

    // Table for Slideshow Images (managed by hotel managers)
    $conn->query("CREATE TABLE IF NOT EXISTS slideshow (
        id INT AUTO_INCREMENT PRIMARY KEY,
        manager_id INT,
        image_path VARCHAR(255), -- Stores filename
        caption TEXT,
        FOREIGN KEY (manager_id) REFERENCES hotel_managers(id) ON DELETE CASCADE
    )");

    // Table for Bookings
    $conn->query("CREATE TABLE IF NOT EXISTS bookings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        hotel_id INT NOT NULL,
        room_id INT NOT NULL,
        user_name VARCHAR(255),
        user_email VARCHAR(255),
        checkin_date DATE,
        checkout_date DATE,
        status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (hotel_id) REFERENCES hotel_managers(id) ON DELETE CASCADE,
        FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
    )");

   


    // Check if username already exists
    $check_stmt = $conn->prepare("SELECT id FROM hotel_managers WHERE username = ?");
    $check_stmt->bind_param("s", $username);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $error = "Username already exists. Please choose a different one.";
    } else {
        // Insert new hotel manager
        $stmt = $conn->prepare("INSERT INTO hotel_managers (username, password, email, hotel_name, hotel_location) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $password, $email, $hotel_name, $hotel_location);

        if ($stmt->execute()) {
            $_SESSION['hotel_manager'] = $conn->insert_id;
            header("Location: dashboard.php");
            exit; // Important to exit after header redirect
        } else {
            $error = "Registration failed: " . $stmt->error;
        }
        $stmt->close();
    }
    $check_stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register Hotel Manager</title>
  <link rel="stylesheet" href="../css/style.css">
  <script src="../js/script.js" defer></script>
</head>
<body>

  <div class="dark-mode-toggle">
    <label>
    <input type="checkbox" id="darkToggle">
    <span>🌙 Dark Mode</span>
    </label>
  </div>

  <div class="form-container">
    <h2>Register as Hotel Manager</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" id="registerForm" novalidate>
      <input type="text" name="username" id="username" placeholder="Username" required>
      <input type="password" name="password" id="password" placeholder="Password" required>
      <input type="email" name="email" id="email" placeholder="Email">
      <input type="text" name="hotel_name" id="hotel_name" placeholder="Hotel Name" required>
      <input type="text" name="hotel_location" id="hotel_location" placeholder="Hotel Location" required>
      <div id="clientErrorMessage" class="error" style="display:none; color:#c00; margin-bottom:10px;"></div>
      <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="login.php">Login here</a>.</p>
  </div>
  <script>
    document.getElementById('registerForm').addEventListener('submit', function(event) {
      var username = document.getElementById('username');
      var password = document.getElementById('password');
      var email = document.getElementById('email');
      var hotelName = document.getElementById('hotel_name');
      var hotelLocation = document.getElementById('hotel_location');
      var errorDiv = document.getElementById('clientErrorMessage');
      var errorMsg = '';
      username.style.borderColor = '';
      password.style.borderColor = '';
      email.style.borderColor = '';
      hotelName.style.borderColor = '';
      hotelLocation.style.borderColor = '';
      errorDiv.style.display = 'none';
      // Validate Username
      if (username.value.trim() === '') {
        errorMsg += 'Username is required.<br>';
        username.style.borderColor = '#c00';
      }
      // Validate Password
      if (password.value.trim() === '') {
        errorMsg += 'Password is required.<br>';
        password.style.borderColor = '#c00';
      } else if (password.value.length < 6) {
        errorMsg += 'Password must be at least 6 characters long.<br>';
        password.style.borderColor = '#c00';
      }
      // Validate Email (if provided)
      if (email.value.trim() !== '' && !/^\S+@\S+\.\S+$/.test(email.value)) {
        errorMsg += 'Please enter a valid email address.<br>';
        email.style.borderColor = '#c00';
      }
      // Validate Hotel Name
      if (hotelName.value.trim() === '') {
        errorMsg += 'Hotel Name is required.<br>';
        hotelName.style.borderColor = '#c00';
      }
      // Validate Hotel Location
      if (hotelLocation.value.trim() === '') {
        errorMsg += 'Hotel Location is required.';
        hotelLocation.style.borderColor = '#c00';
      }
      if (errorMsg) {
        event.preventDefault();
        errorDiv.innerHTML = errorMsg;
        errorDiv.style.display = 'block';
      }
    });
  </script>
</body>
</html>
