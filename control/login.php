<?php
require_once '../Model/dbfunc.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } 

    // If no errors, proceed with login
    if (empty($errors)) {
        $database = new Database();
        $db = $database->getConnection();

        if ($database->emailExists($email)) {
            if ($database->verifyUserPassword($email, $password)) {
              $userId = $database->getUserIdByEmail($email);
              echo "<script>window.location.href='../view/index.php?user_id={$userId}';</script>";
                exit();
            } else {
                $errors[] = "Wrong password.";
            }
        } else {
            $errors[] = "Wrong email address.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Umrah Login Form</title>
  <link rel="stylesheet" href="../css/loginStyles.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrapper">
    <form action="login.php" method="POST">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" name="email" placeholder="Email" required class="<?php echo !empty($errors) ? 'error' : ''; ?>" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required class="<?php echo !empty($errors) ? 'error' : ''; ?>">
        <i class='bx bxs-lock-alt'></i>
      </div>
      
      <div class="error-messages">
        <?php 
          if (!empty($errors)) {
              echo '<ul>';
              foreach ($errors as $error) {
                  echo "<li>$error</li>";
              }
              echo '</ul>';
              echo '<br>';
          }
        ?>
      </div>
      <button type="submit" class="btn">Login</button>
      <div class="register-link">
        <p>Don't have an account? <a href="registration.php">Register</a></p>
      </div>
    </form>
  </div>
</body>
</html>
