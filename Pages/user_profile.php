<?php
session_start();
require_once('../Scripts/security.php');
require_once('../Scripts/users_controller.php');

Security::checkHTTPS();

// confirm user is authorized for the page
Security::checkAuthority('user');

// user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}

// user clicked the delete account button
if (isset($_POST['deleteAccount'])) {
    UserController::deleteAccount($_SESSION['username']);
    Security::logout();
}

// Get the username from the session
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $username; ?>'s Profile</title>
    <link rel="icon" type="image/png" href="../Images/favicon.png">
    <link href="../CSS/base.css" rel="stylesheet">
    <link href="../CSS/user.css" rel="stylesheet">
    <link href="../CSS/user_profile.css" rel="stylesheet">
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

    <div class="user-container">
        <h1>Welcome <?php echo $username; ?></h1>
        <hr class="title-line">
        <a style="font-size: 30px;margin-left: 120px;margin-right: 120px;" href="change_password.php">Change Password</a>
        <form id="deleteAccountForm" method="post" action="">
            <input type="hidden" name="deleteAccount" value="true">
            <button style="font-size: 30px;margin-left: 135px;margin-right: 135px;margin-top: 20px;" type="submit" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
        </form>
    </div>
</body>

</html>