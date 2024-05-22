<?php
session_start();
if (isset($_GET['token'])) {
    $conn = new mysqli('localhost', 'webuser', 'password', 'webapp');
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    $token = $conn->real_escape_string($_GET['token']);
    $result = $conn->query("SELECT * FROM users WHERE token='$token' LIMIT 1");

    if ($result->num_rows > 0) {
        $conn->query("UPDATE users SET token=NULL WHERE token='$token'");
        echo 'Your email has been verified! You can now <a href="login.php">login</a>.';
    } else {
        echo 'Invalid token or email already verified.';
    }

    $conn->close();
} else {
    echo 'No token provided.';
}
?>
