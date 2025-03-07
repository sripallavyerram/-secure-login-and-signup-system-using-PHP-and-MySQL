<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_auth');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        die("Error: Passwords do not match!");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user data into MySQL database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Signup successful! <a href='login.html'>Login here</a>";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
