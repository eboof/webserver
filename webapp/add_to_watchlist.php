<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$asx_code = $_GET['code'];

// Connect to the webapp database to verify user
$conn_webapp = new mysqli('localhost', 'webuser', 'password', 'webapp');
if ($conn_webapp->connect_error) {
    die('Connection failed: ' . $conn_webapp->connect_error);
}
$sql_user = "SELECT id FROM users WHERE id = '$user_id'";
$result_user = $conn_webapp->query($sql_user);
if ($result_user->num_rows == 0) {
    die('Invalid user.');
}
$conn_webapp->close();

// Connect to the stock_research database to verify company
$conn_stock = new mysqli('localhost', 'webuser', 'password', 'stock_research');
if ($conn_stock->connect_error) {
    die('Connection failed: ' . $conn_stock->connect_error);
}
$sql_company = "SELECT asx_code FROM companies WHERE asx_code = '$asx_code'";
$result_company = $conn_stock->query($sql_company);
if ($result_company->num_rows == 0) {
    die('Invalid company.');
}

// Add to watchlist
$sql_watchlist = "INSERT INTO watchlist (user_id, asx_code, date_added) VALUES ('$user_id', '$asx_code', NOW())";
if ($conn_stock->query($sql_watchlist) === TRUE) {
    echo "Stock added to watchlist.";
} else {
    echo "Error: " . $sql_watchlist . "<br>" . $conn_stock->error;
}

$conn_stock->close();
?>

<a href="stock_research.php">Back to Stock Research</a>

