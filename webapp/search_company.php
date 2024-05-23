<?php
include('header.php');
?>
<div class="content">
    <h2>Search Company</h2>
    <form method="post" action="search_company.php">
        <input type="text" name="search" placeholder="Enter ASX Code or Company Name" required>
        <button type="submit">Search</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $search = $_POST['search'];
        $conn = new mysqli('localhost', 'webuser', 'password', 'stock_research');
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        $sql = "SELECT * FROM companies WHERE asx_code LIKE '%$search%' OR company_name LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table><tr><th>ASX Code</th><th>Company Name</th><th>Sector</th><th>Industry Group</th><th>Action</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['asx_code']}</td>
                        <td>{$row['company_name']}</td>
                        <td>{$row['sector']}</td>
                        <td>{$row['industry_group']}</td>
                        <td><a href='add_to_watchlist.php?code={$row['asx_code']}'>Add to Watchlist</a></td>
                      </tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }

        $conn->close();
    }
    ?>
</div>
<?php
include('tail.php');
?>

