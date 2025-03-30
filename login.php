<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $errors = [];

  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Invalid email format or email is empty.";
  }

  if (empty($password)) {
    $errors[] = "Password cannot be empty.";
  }

  if (empty($errors)) {
    $users = file("users.txt", FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
      list($stored_email, $stored_password, $first_name, $last_name, $contact_number, $event_list) = explode("|", $user);

      if ($email === $stored_email && password_verify($password, $stored_password)) {
        $_SESSION['first_name'] = $first_name;
        $_SESSION['last_name'] = $last_name;
        $_SESSION['contact_number'] = $contact_number;
        $_SESSION['email'] = $email;
        $_SESSION['event_list'] = $event_list;

        header("Location: home.php"); // Redirect to home
        exit();
      }
    }

    echo "<p style='color: red;'>Invalid email or password!</p>";
  } else {
    foreach ($errors as $error) {
      echo "<p style='color: red;'>$error</p>";
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h2>Login to Your Account</h2>
  <form method="post" action="login.php">
    Email ID: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
  </form>
</body>

</html>