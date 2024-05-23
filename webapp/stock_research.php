<?php
include('header.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Connect to the stock_research database to fetch watchlist and company details
$conn_stock = new mysqli('localhost', 'webuser', 'password', 'stock_research');
if ($conn_stock->connect_error) {
    die('Connection failed: ' . $conn_stock->connect_error);
}

$sql = "SELECT companies.asx_code, companies.company_name, companies.sector, companies.industry_group, watchlist.date_added
        FROM watchlist
        JOIN companies ON watchlist.asx_code = companies.asx_code
        WHERE watchlist.user_id = '$user_id'";
$result = $conn_stock->query($sql);

echo "<h2>My Watchlist</h2>";
if ($result->num_rows > 0) {
    echo "<table>
            <tr><th>ASX Code</th><th>Company Name</th><th>Sector</th><th>Industry Group</th><th>Date Added</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['asx_code']}</td>
                <td>{$row['company_name']}</td>
                <td>{$row['sector']}</td>
                <td>{$row['industry_group']}</td>
                <td>{$row['date_added']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No stocks in your watchlist.";
}

$conn_stock->close();
?>

<a href="search_company.php">Add More Stocks</a>
<?php
include('tail.php');
?>

