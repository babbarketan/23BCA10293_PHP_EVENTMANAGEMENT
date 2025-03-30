<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $first_name = $_POST['first_name'] ?? '';
  $last_name = $_POST['last_name'] ?? '';
  $contact_number = $_POST['contact_number'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $confirm_password = $_POST['confirm_password'] ?? '';
  $event_list = $_POST['event_list'] ?? '';

  if ($password !== $confirm_password) {
    echo "<p style='color: red;'>Passwords do not match!</p>";
  } else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Secure password storage

    $user_data = "$email|$hashed_password|$first_name|$last_name|$contact_number|$event_list\n";

    file_put_contents("users.txt", $user_data, FILE_APPEND); // Save user details

    echo "<p style='color: green;'>Registration successful!</p>";
    header("Location: login.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Event Registration</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <h2>Register for an Event</h2>
  <form method="post" action="register.php">
    First Name: <input type="text" name="first_name" required><br><br>
    Last Name: <input type="text" name="last_name" required><br><br>
    Contact Number: <input type="text" name="contact_number" required><br><br>
    Email ID: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    Confirm Password: <input type="password" name="confirm_password" required><br><br>
    Event List:
    <select name="event_list" required>
      <option value="">Select an event</option>
      <option value="Dance">Dance</option>
      <option value="Music">Music</option>
      <option value="Poetry">Poetry</option>
      <option value="Art">Art</option>
      <option value="Drama">Drama</option>
      <option value="Photography">Photography</option>
      <option value="Cooking">Cooking</option>
      <option value="Sports">Sports</option>
      <option value="Gaming">Gaming</option>
      <option value="Technology">Technology</option>
    </select><br><br>
    <button type="submit">Register</button>
  </form>
</body>

</html>