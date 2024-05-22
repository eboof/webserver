<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Detail</title>
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

        .stock-detail {
            margin-top: 100px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .stock-detail h2 {
            text-align: center;
        }

        .stock-info {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .stock-info div {
            background: rgba(255, 223, 186, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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
    <div class="stock-detail">
        <h2>Stock Details for <span id="stock-symbol"></span></h2>
        <div class="stock-info">
            <div>
                <h3>Fundamentals</h3>
                <p>PE Ratio: <span id="pe-ratio">N/A</span></p>
                <p>EPS: <span id="eps">N/A</span></p>
                <p>Dividend Yield: <span id="dividend-yield">N/A</span></p>
            </div>
            <div>
                <h3>Analyst Expectations</h3>
                <p>Rating: <span id="rating">N/A</span></p>
                <p>Price Target: <span id="price-target">N/A</span></p>
            </div>
            <div>
                <h3>Management</h3>
                <p>CEO: <span id="ceo">N/A</span></p>
                <p>Chairman: <span id="chairman">N/A</span></p>
            </div>
        </div>
    </div>
</body>
</html>
