<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rob's Local Website</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script>
        function toggleDropdown() {
            var dropdown = document.getElementById("dropdown");
            if (dropdown.style.display === "block") {
                dropdown.style.display = "none";
            } else {
                dropdown.style.display = "block";
            }
        }
    </script>
</head>
<body>
    <div class="hamburger-menu" onclick="toggleDropdown()">
        <div class="hamburger-icon">
            <svg viewBox="0 0 100 80" width="40" height="40">
                <rect width="100" height="10"></rect>
                <rect y="30" width="100" height="10"></rect>
                <rect y="60" width="100" height="10"></rect>
            </svg>
        </div>
    </div>
    <div id="dropdown" class="dropdown">
        <a href="welcome.php">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="chatbot.php">Our Chatbot</a>
        <a href="documents.php">Documents</a>
        <a href="stock_research.php">Stock Research</a>
        <a href="admin.php">Admin</a>
        <a href="logout.php">Logout</a>
    </div>

