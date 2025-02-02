<?php
require_once '../Model/dbfunc.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    // Validate confirm password
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        $database = new Database();
        $db = $database->getConnection();

        // Check if email already exists
        if ($database->emailExists($email)) {
            $errors[] = "This email has already been used to register.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $data = [
                'name' => $username,
                'email' => $email,
                'password_hash' => $hashed_password
            ];

            if ($database->create('users', $data)) {
                echo "<script>
                alert('Registration is successful');
                setTimeout(function() {
                    window.location.href = 'login.php';
                }, 1000);
            </script>";
            } else {
                echo "Error: Could not register user.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Umrah Registration Form </title>
  <link rel="stylesheet" href="../css/registration.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script defer src="js/registration.js"></script>
</head>
<body>
  <div class="wrapper">
    <form action="registration.php" method="POST" id="registrationForm">
      <h1>Register</h1>
      <div class="input-box">
        <input type="text" id="username" name="username" placeholder="Username" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="email" id="email" name="email" placeholder="Email" required>
        <i class='bx bxs-envelope'></i>
      </div>
      <div class="input-box">
        <input type="password" id="password" name="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div class="input-box">
        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <div>
      <div class="error-messages">
        <?php 
          if (!empty($errors)) {
              echo '<ul>';
              foreach ($errors as $error) {
                  echo "<li>$error</li>";
              }
              echo '</ul>';
          }
        ?>
      </div>

      </div>
      <button type="submit" class="btn">Register</button>
      <div class="login-link">
        <p>Already have an account? <a href="login.php">Login</a></p>
      </div>
    </form>
  </div>
</body>
</html>
