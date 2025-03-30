<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo "<p style='color: red;'>Error: User details not found. Please log in again.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h2>Welcome!</h2>

    <!-- Profile Picture Upload -->
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Upload Profile Picture:
        <input type="file" name="profile_picture"><br><br>
        <button type="submit">Upload</button>
    </form>

    <!-- Display User Details -->
    <div>
        <p>First Name: <?php echo $_SESSION['first_name'] ?? 'Not provided'; ?></p>
        <p>Last Name: <?php echo $_SESSION['last_name'] ?? 'Not provided'; ?></p>
        <p>Contact Number: <?php echo $_SESSION['contact_number'] ?? 'Not provided'; ?></p>
        <p>Email ID: <?php echo $_SESSION['email']; ?></p>
        <p>Event Registered: <?php echo $_SESSION['event_list'] ?? 'Not provided'; ?></p>
    </div>
</body>
</html>
