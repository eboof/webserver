<?php include('header.php'); ?>

<div class="dialog-box">
    <h2>Stock Research</h2>
    <p>Manage your stock watchlists below.</p>

    <!-- Form to add new watchlist -->
    <form action="stock_research.php" method="post">
        <label for="new_watchlist">Add a Watchlist:</label>
        <input type="text" id="new_watchlist" name="new_watchlist" required>
        <button type="submit" name="add_watchlist">Add</button>
    </form>

    <hr>

    <?php
    session_start();
    $conn = new mysqli('localhost', 'webuser', 'password', 'webapp');

    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Get user ID
    $user_id = $_SESSION['user_id'];

    // Handle adding new watchlist
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_watchlist'])) {
        $new_watchlist = $conn->real_escape_string($_POST['new_watchlist']);
        $sql = "INSERT INTO watchlists (user_id, name) VALUES ('$user_id', '$new_watchlist')";
        $conn->query($sql);
    }

    // Handle adding new stock to a watchlist
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_stock'])) {
        $watchlist_id = $conn->real_escape_string($_POST['watchlist_id']);
        $asx_code = $conn->real_escape_string($_POST['asx_code']);
        $company_name = $conn->real_escape_string($_POST['company_name']);
        $date_added = date('Y-m-d');
        $closing_price = $conn->real_escape_string($_POST['closing_price']);
        $sql = "INSERT INTO watchlist_items (watchlist_id, asx_code, company_name, date_added, closing_price) VALUES ('$watchlist_id', '$asx_code', '$company_name', '$date_added', '$closing_price')";
        $conn->query($sql);
    }

    // Handle deleting a stock from a watchlist
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_stock'])) {
        $stock_id = $conn->real_escape_string($_POST['delete_stock']);
        $sql = "DELETE FROM watchlist_items WHERE id='$stock_id'";
        $conn->query($sql);
    }

    // Handle deleting a watchlist
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_watchlist'])) {
        $watchlist_id = $conn->real_escape_string($_POST['delete_watchlist']);
        $sql = "DELETE FROM watchlists WHERE id='$watchlist_id'";
        $conn->query($sql);
        // Also delete all items in the watchlist
        $sql = "DELETE FROM watchlist_items WHERE watchlist_id='$watchlist_id'";
        $conn->query($sql);
    }

    // Fetch the user's watchlists
    $sql = "SELECT * FROM watchlists WHERE user_id='$user_id'";
    $result_watchlists = $conn->query($sql);

    if ($result_watchlists->num_rows > 0) {
        while ($watchlist = $result_watchlists->fetch_assoc()) {
            echo "<h3>{$watchlist['name']} <form action='stock_research.php' method='post' style='display:inline;'>
                <input type='hidden' name='delete_watchlist' value='{$watchlist['id']}'>
                <button type='submit' class='delete-btn'>&#128465;</button>
                </form></h3>";

            echo "<!-- Form to add new stock to watchlist -->
                <form action='stock_research.php' method='post'>
                    <input type='hidden' name='watchlist_id' value='{$watchlist['id']}'>
                    <label for='asx_code'>ASX Code:</label>
                    <input type='text' id='asx_code' name='asx_code' required>
                    <label for='company_name'>Company Name:</label>
                    <input type='text' id='company_name' name='company_name' required>
                    <label for='closing_price'>Closing Price:</label>
                    <input type='text' id='closing_price' name='closing_price' required>
                    <button type='submit' name='add_stock'>Add</button>
                </form>";

            // Fetch stocks in the watchlist
            $watchlist_id = $watchlist['id'];
            $sql = "SELECT * FROM watchlist_items WHERE watchlist_id='$watchlist_id'";
            $result_stocks = $conn->query($sql);

            if ($result_stocks->num_rows > 0) {
                echo "<div class='table-container'>
                    <table>
                        <thead>
                            <tr>
                                <th>ASX Code</th>
                                <th>Company Name</th>
                                <th>Date Added</th>
                                <th>Closing Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";
                while ($stock = $result_stocks->fetch_assoc()) {
                    echo "<tr>
                            <td>{$stock['asx_code']}</td>
                            <td>{$stock['company_name']}</td>
                            <td>{$stock['date_added']}</td>
                            <td>{$stock['closing_price']}</td>
                            <td>
                                <form action='stock_research.php' method='post' style='display:inline;'>
                                    <input type='hidden' name='delete_stock' value='{$stock['id']}'>
                                    <button type='submit' class='delete-btn'>&#128465;</button>
                                </form>
                            </td>
                          </tr>";
                }
                echo "</tbody></table></div>";
            } else {
                echo "<p>No stocks in this watchlist.</p>";
            }

            echo "<hr>";
        }
    } else {
        echo "<p>You have no watchlists. Add a watchlist to get started.</p>";
    }

    $conn->close();
    ?>

</div>

<?php include('tail.php'); ?>

