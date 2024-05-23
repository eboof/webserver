<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "webuser", "password", "webapp");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $conn->real_escape_string($_POST["username"]);
    $password = $conn->real_escape_string($_POST["password"]);

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            header("Location: welcome.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with that username";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('background.webp') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: rgba(255, 223, 186, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 320px;
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-box label {
            display: block;
            margin-bottom: 5px;
        }
        .login-box input[type="text"],
        .login-box input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .login-box button {
            width: 100%;
            padding: 12px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-box button:hover {
            background: #555;
        }
        .lp-form-fill-button {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form action="login.php" method="post" autocomplete="off">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" autocomplete="off" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" autocomplete="off" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>

