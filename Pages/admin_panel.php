<?php
session_start();
require_once('../Scripts/security.php');

Security::checkHTTPS();

// confirm user is authorized for the page
Security::checkAuthority('admin');

// user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}

// Access username from session variable
$username = $_SESSION['username'];
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="icon" type="image/png" href="../Images/favicon.png">
    <link href="../CSS/base.css" rel="stylesheet">
    <link href="../CSS/user.css" rel="stylesheet">
    <link href="../CSS/user_profile.css" rel="stylesheet">
</head>

<body>
    <header>
        <div id="logo">
            <a><img src="../Images/Quick_Bite_Prices_Logo.png" alt="Logo"></a>
        </div>
        <div class="title-container">
            <div id="title">Quick Bite Prices</div>
            <hr class="title-line">
            <nav>
                <form id="logoutForm" method="post" action="">
                    <input type="hidden" name="logout" value="true">
                    <a href="#" onclick="document.getElementById('logoutForm').submit(); return false;">Log Out</a>
                </form>
            </nav>
        </div>
    </header>

    <div class="user-container">
        <h1>Welcome <?php echo $username; ?></h1>
        <hr class="title-line">
        <a style="font-size: 30px" href="add_chain.php">Add Restaurant</a>
        <a style="font-size: 30px;margin-left: 157px;" href="#">Add Food</a>
    </div>
</body>

</html>