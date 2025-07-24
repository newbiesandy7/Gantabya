<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6D9773;
            --dark-accent: #0C3B2E;
            --button-color: #BB8A52;
            --highlight-color: #FFBA00;
            --text-color: #333;
            --background-light: #f8f8f8;
            --container-bg: #fff;
            --border-color: #e0e0e0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #e6f3e6 0%, #f8f8f8 100%);
            color: var(--text-color);
            min-height: 100vh;
        }

        .w-450 {
            width: 100%;
            max-width: 450px;
        }

        .card-glass {
            background: rgba(255,255,255,0.85);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            border-radius: 1rem;
            border: 1px solid var(--border-color);
            backdrop-filter: blur(4px);
        }

        .btn-custom-primary {
            background: linear-gradient(90deg, var(--primary-color) 60%, #4CAF50 100%);
            border: none;
            color: #fff;
            font-weight: 700;
            border-radius: 0.7rem;
            padding: 0.85rem 2rem;
            box-shadow: 0 2px 8px rgba(109,151,115,0.08);
            transition: background 0.3s, box-shadow 0.3s;
        }
        .btn-custom-primary:hover {
            background: linear-gradient(90deg, #388E3C 60%, var(--primary-color) 100%);
            box-shadow: 0 4px 16px rgba(109,151,115,0.18);
            color: #fff;
        }

        .link-custom-secondary {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        .link-custom-secondary:hover {
            color: var(--dark-accent);
        }

        .form-control {
            border-radius: 0.5rem;
            border: 1.5px solid var(--border-color);
            box-shadow: 0 1px 4px rgba(109,151,115,0.04);
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus {
            border-color: var(--highlight-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 186, 0, 0.18);
        }

        .display-4, .fs-1 {
            color: var(--dark-accent);
            font-weight: 700;
            letter-spacing: 1px;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
        }
        .logo-section img {
            max-width: 120px;
            height: auto;
            border-radius: 1rem;
            box-shadow: 0 8px 24px rgba(109,151,115,0.12);
            animation: logoPop 1.2s cubic-bezier(.68,-0.55,.27,1.55) 1;
        }
        @keyframes logoPop {
            0% { transform: scale(0.7); opacity: 0; }
            60% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); }
        }

        .shadow {
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100 p-3" style="background: none;">
        <form class="card-glass w-450 p-4"
              action="php/login.php"
              method="post"
              id="loginForm">

            <div class="logo-section">
                <img src="img/LOGO_WB-removebg-preview.png" alt="Company Logo" class="img-fluid">
            </div>

            <h4 class="display-4 fs-1 text-center mb-5">LOGIN</h4>

            <?php if(isset($_GET['error'])){ ?>
            <div class="alert alert-danger" role="alert">
              <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
            <?php } ?>

            <div id="clientErrorMessage" class="alert alert-danger d-none" role="alert"></div>

            <div class="mb-4">
                <label for="username" class="form-label"><i class="fa fa-user me-2"></i>User name</label>
                <input type="text"
                       class="form-control"
                       id="username"
                       name="uname"
                       value="<?php echo isset($_GET['uname']) ? htmlspecialchars($_GET['uname']) : ""; ?>"
                       placeholder="Enter your username">
            </div>

            <div class="mb-5">
                <label for="password" class="form-label"><i class="fa fa-lock me-2"></i>Password</label>
                <input type="password"
                       class="form-control"
                       id="password"
                       name="pass"
                       placeholder="Enter your password">
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
                <button type="submit" class="btn btn-custom-primary mb-2 w-100"><i class="fa fa-sign-in me-2"></i>Login</button>
                <div class="w-100 mt-2">
                    <div class="row g-2 justify-content-center mb-2">
                        <div class="col-12 text-center">
                            <span class="fw-bold text-dark">Have admin access?</span><br>
                            <a href="admin-login.php" class="link-custom-secondary ms-2"><i class="fa fa-user-shield me-1"></i>Admin Login</a>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center" style="margin-top:-10px; margin-bottom:8px;">
                        <hr style="width: 60%; border-top: 2px solid var(--highlight-color);">
                    </div>
                    <div class="text-center mt-1">
                        <span class="fw-bold text-dark">Don't have an account?</span>
                        <a href="signup.php" class="link-custom-secondary ms-2"><i class="fa fa-user-plus me-1"></i>Sign Up</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            const usernameInput = document.getElementById('username');
            const passwordInput = document.getElementById('password');
            const clientErrorMessage = document.getElementById('clientErrorMessage');
            let isValid = true;
            let errorMessage = '';

            // Reset previous error messages
            clientErrorMessage.classList.add('d-none');
            clientErrorMessage.textContent = '';
            usernameInput.classList.remove('is-invalid');
            passwordInput.classList.remove('is-invalid');

            // Validate Username
            if (usernameInput.value.trim() === '') {
                errorMessage = 'Username is required.';
                usernameInput.classList.add('is-invalid');
                isValid = false;
            }

            // Validate Password
            if (passwordInput.value.trim() === '') {
                if (errorMessage !== '') errorMessage += '<br>'; // Add line break if there's already an error
                errorMessage += 'Password is required.';
                passwordInput.classList.add('is-invalid');
                isValid = false;
            } else if (passwordInput.value.trim().length < 6) { // Example: minimum password length
                if (errorMessage !== '') errorMessage += '<br>';
                errorMessage += 'Password must be at least 6 characters long.';
                passwordInput.classList.add('is-invalid');
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault(); // Stop form submission
                clientErrorMessage.innerHTML = errorMessage;
                clientErrorMessage.classList.remove('d-none');
            }
        });
    </script>
</body>
</html>