<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_auth');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username_email = $_POST['username_email'];
    $password = $_POST['password'];

    // Retrieve the user record from the database
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $username, $hashed_password);
    $stmt->fetch();

    // Verify password
    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;
        echo "Login successful! <a href='dashboard.php'>Go to Dashboard</a>";
    } else {
        echo "Invalid credentials!";
    }

    $stmt->close();
    $conn->close();
}
?>
