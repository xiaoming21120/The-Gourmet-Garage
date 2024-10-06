<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Replace with your actual admin credentials
  $admin_username = "techblitz";
  $admin_password = "techblitz";

  if ($username == $admin_username && $password == $admin_password) {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin.php");
    exit;
  } else {
    $error = "Invalid username or password!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Admin Login</h1>
  <?php if (isset($error)) { ?>
    <p style="color: red;"><?php echo $error; ?></p>
  <?php } ?>
  <form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Login</button>
  </form>
</body>
</html>