<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "webuser", "password", "webapp");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $conn->real_escape_string($_POST["username"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $password = password_hash(
        $conn->real_escape_string($_POST["password"]),
        PASSWORD_BCRYPT
    );

    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 'user')";
    if ($conn->query($sql) === true) {
        header("Location: login.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
        .register-box {
            background: rgba(255, 223, 186, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 320px;
        }
        .register-box h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .register-box label {
            display: block;
            margin-bottom: 5px;
        }
        .register-box input[type="text"],
        .register-box input[type="email"],
        .register-box input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .register-box button {
            width: 100%;
            padding: 12px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .register-box button:hover {
            background: #555;
        }
        .lp-form-fill-button {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Register</h2>
        <form action="register.php" method="post" autocomplete="off">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" autocomplete="off" required>
            <label for="email">Email</label>
            <input type="email" id="email" name="email" autocomplete="off" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" autocomplete="new-password" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>

