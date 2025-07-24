<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost", "root", "", "blog_db");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT id, password FROM hotel_managers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['hotel_manager'] = $id;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Hotel manager not found.";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - Hotel Manager</title>
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
    <h2>Hotel Manager Login</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" id="loginForm" novalidate>
      <input type="text" name="username" id="username" placeholder="Username" required>
      <input type="password" name="password" id="password" placeholder="Password" required>
      <div id="clientErrorMessage" class="error" style="display:none; color:#c00; margin-bottom:10px;"></div>
      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
  </div>
  <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
      var username = document.getElementById('username');
      var password = document.getElementById('password');
      var errorDiv = document.getElementById('clientErrorMessage');
      var errorMsg = '';
      username.style.borderColor = '';
      password.style.borderColor = '';
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
        errorMsg += 'Password must be at least 6 characters long.';
        password.style.borderColor = '#c00';
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
