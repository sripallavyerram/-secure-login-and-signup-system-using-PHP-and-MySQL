<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Access denied! Please log in.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="logout.php">Logout</a>
</body>
</html>
