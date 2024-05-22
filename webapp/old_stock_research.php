<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Research</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        .hamburger-menu {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(255, 223, 186, 0.9); /* Soft yellow-gold color */
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .hamburger-menu svg {
            width: 20px;
            height: 20px;
            fill: #333;
        }

        .dropdown {
            display: none;
            position: absolute;
            top: 60px;
            right: 20px;
            background-color: rgba(255, 223, 186, 0.9);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1;
        }

        .dropdown a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #333;
        }

        .dropdown a:hover {
            background-color: rgba(255, 223, 186, 1);
        }

        .show {
            display: block;
        }

        .watchlist {
            margin-top: 100px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .watchlist h2 {
            text-align: center;
        }

        .watchlist table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .watchlist table, th, td {
            border: 1px solid #ddd;
        }

        .watchlist th, .watchlist td {
            padding: 10px;
            text-align: center;
        }

        .add-stock-form {
            text-align: center;
            margin-top: 20px;
        }

        .add-stock-form input[type="text"] {
            padding: 10px;
            width: 200px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .add-stock-form button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-stock-form button:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function toggleDropdown() {
            document.getElementById("dropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.hamburger-menu') && !event.target.matches('.hamburger-menu *')) {
                var dropdowns = document.getElementsByClassName("dropdown");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</head>
<body>
    <div class="hamburger-menu" onclick="toggleDropdown()">
        <svg viewBox="0 0 100 80" width="40" height="40">
            <rect width="100" height="10"></rect>
            <rect y="30" width="100" height="10"></rect>
            <rect y="60" width="100" height="10"></rect>
        </svg>
    </div>
    <div id="dropdown" class="dropdown">
        <a href="welcome.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="chatbot.php">Our Chatbot</a>
        <a href="documents.php">Documents</a>
        <a href="stock_research.php">Stock Research</a>
    </div>
    <div class="watchlist">
        <h2>Stock Watchlist</h2>
        <table>
            <thead>
                <tr>
                    <th>Stock Symbol</th>
                    <th>Company Name</th>
                    <th>Current Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Placeholder for dynamic content -->
                <tr>
                    <td>GOOGL</td>
                    <td>Alphabet Inc.</td>
                    <td>$2750</td>
                    <td><a href="stock_detail.php?symbol=GOOGL">View Details</a></td>
                </tr>
            </tbody>
        </table>
        <div class="add-stock-form">
            <input type="text" id="stock-symbol" placeholder="Enter Stock Symbol">
            <button onclick="addStock()">Add Stock</button>
        </div>
    </div>
    <script>
        function addStock() {
            // Placeholder for add stock functionality
            alert('Add Stock functionality will be implemented here.');
        }
    </script>
</body>
</html>

