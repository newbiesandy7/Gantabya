<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gantabya - Your Hotel Booking Platform</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">     
<link rel="stylesheet" href="../css/navbar_custom.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            text-align: center;
            background-color: var(--cream);
            color: var(--dark-text);
        }
        .main-content {
            padding: 50px;
            max-width: 800px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .main-content h1 {
            color: var(--main-green);
            font-size: 3em;
            margin-bottom: 20px;
        }
        .main-content p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .main-content .btn-group a {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            background-color: var(--bright-gold);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .main-content .btn-group a:hover {
            background-color: #e0a800;
        }
        .dark-mode-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        /* Dark mode specific styles for index.php */
        body.dark .main-content {
            background-color: #0b2d21;
            color: #9FD3AF;
            box-shadow: 0 10px 30px rgba(255,255,255,0.05);
        }
        body.dark .main-content h1 {
            color: #9FD3AF;
        }
        body.dark .main-content .btn-group a {
            background-color: #FFCE4A;
            color: #072C21;
        }
        body.dark .main-content .btn-group a:hover {
            background-color: #e5b93c;
        }
    </style>
    <script src="js/script.js" defer></script>
</head>
<body>
    <!-- <div class="dark-mode-toggle">
        <label>
            <input type="checkbox" id="darkToggle">
            <span>🌙 Dark Mode</span>
        </label>
    </div> -->

    <div class="main-content">
        <h1>Welcome to Gantabya!</h1>
        <p>Your ultimate platform for discovering and booking amazing hotels.</p>
        <div class="btn-group">
            <a href="browse.php">Browse Hotels</a>
            <a href="hotel_manager/login.php">Hotel Manager Login</a>
        </div>
    </div>
</body>
<!-- Bootstrap JS for dropdowns -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</html>
