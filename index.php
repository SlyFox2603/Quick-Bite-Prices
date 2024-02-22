<?php
session_start();
require_once('Scripts/users.php');
require_once('Scripts/users_controller.php');
require_once('Scripts/security.php');

Security::checkHTTPS();

// set login message
$login_msg = isset($_SESSION['logout_msg']) ? $_SESSION['logout_msg'] : '';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $user = UserController::getUserByEmailAndPassword($_POST['email'], $_POST['password']);

    if ($user && password_verify($_POST['password'], $user->getPassword())) {
        $_SESSION['user_id'] = $user->getUserId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['email'] = $user->getEMail();

        if ($user->getLevel() === '1') {
            $_SESSION['admin'] = false;
            $_SESSION['user'] = true;
            header("Location: Pages/home.php");
        } else if ($user->getLevel() === '2') {
            $_SESSION['admin'] = true;
            $_SESSION['user'] = false;
            header("Location: Pages/admin_panel.php");
        }
    } else {
        $login_msg = 'Incorrect password or that account does not exist.';
    }
}

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Bite Prices - Login</title>
    <link rel="icon" type="image/png" href="Images/favicon.png">
    <link href="CSS/base.css" rel="stylesheet">
    <link href="CSS/user.css" rel="stylesheet">
</head>

<body>
    <header>
        <div id="logo">
            <img src="Images/Quick_Bite_Prices_Logo.png" alt="Logo">
        </div>
        <div class="title-container">
            <div id="title">Quick Bite Prices</div>
            <hr class="title-line">
        </div>
    </header>

    <div class="login-container">
        <form method='POST'>
            <h3><input type="text" name="email" placeholder="E-Mail"></h3>
            <h3><input type="password" name="password" placeholder="Password"></h3>
            <input type="submit" value="Log In" name="login">
            <a href="Pages/create_user.php">Create Account</a>
        </form>
        <h2><?php echo $login_msg; ?></h2>
    </div>
</body>

</html>