<?php
session_start();
require_once('../Scripts/users.php');
require_once('../Scripts/users_controller.php');
require_once('../Scripts/security.php');

Security::checkHTTPS();

// Confirm user is authorized for the page
Security::checkAuthority('user');

$error = "";

if(isset($_POST['update_password'])) {
    // Retrieve user input
    $email = $_POST['email'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    
    // Check if any field is empty
    if(empty($email) || empty($currentPassword) || empty($newPassword)) {
        $error = "All fields are required.";
    } else {
        // Check if the current password is correct
        $user = UserController::getUserByEmailAndPassword($email, $currentPassword);
        if ($user && password_verify($currentPassword, $user->getPassword())) {
            // Update the password with hashed value
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            if(UserController::updatePassword($email, $hashedNewPassword)) {
                echo "Password updated successfully.";
                Security::logout();
            } else {
                $error = "Failed to update password.";
            }
        } else {
            $error = "Invalid email or current password.";
        }
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="icon" type="image/png" href="../Images/favicon.png">
    <link href="../CSS/base.css" rel="stylesheet">
    <link href="../CSS/user.css" rel="stylesheet">
    <link href="../CSS/create_user.css" rel="stylesheet">
</head>

<body>
    <header>
        <div id="logo">
            <img src="../Images/Quick_Bite_Prices_Logo.png" alt="Logo">
        </div>
        <div class="title-container">
            <div id="title">Quick Bite Prices</div>
            <hr class="title-line">
        </div>
    </header>

    <div class="login-container">
        <form method='POST'>
            <h3><input type="text" name="email" placeholder="E-Mail"></h3>
            <h3><input type="password" name="current_password" placeholder="Current Password"></h3>
            <h3><input type="password" name="new_password" placeholder="New Password"></h3>
            <input style="width: 272px;" type="submit" value="Update Password" name="update_password">
            <a style="margin-left: 110px;" href="user_profile.php">Back</a>
            <?php if(!empty($error)) { ?>
                <h2><?php echo $error; ?></h2>
            <?php } ?>
        </form>
    </div>
</body>

</html>