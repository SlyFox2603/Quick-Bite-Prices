<?php
session_start();
require_once('../Scripts/security.php');

Security::checkHTTPS();

// confirm user is authorized for the page
Security::checkAuthority('user');

// user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/png" href="../Images/favicon.png">
    <link href="../CSS/base.css" rel="stylesheet">
</head>

<body>
    <header>
        <div id="logo">
            <a href="home.php"><img src="../Images/Quick_Bite_Prices_Logo.png" alt="Logo"></a>
        </div>
        <div class="title-container">
            <div id="title">Quick Bite Prices</div>
            <hr class="title-line">
            <nav>
                <form id="logoutForm" method="post" action="">
                    <a href="home.php">Home</a>
                    <a href="restaurants.php">Restaurants</a>
                    <a href="user_profile.php">My Profile</a>
                    <input type="hidden" name="logout" value="true">
                    <a href="#" onclick="document.getElementById('logoutForm').submit(); return false;">Log Out</a>
                </form>
            </nav>
        </div>
    </header>

    <section>
        <p>Welcome to Quick Bite Prices! This is your one stop for checking the prices of popular fast-food items! Get started by clicking a link in the bar above!</p>
    </section>
</body>

</html>