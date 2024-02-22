<?php
session_start();
require_once('../Scripts/users.php');
require_once('../Scripts/users_controller.php');
require_once('../Scripts/security.php');

Security::checkHTTPS();

$error = "";

if(isset($_POST['create_account'])) {
    // Retrieve user input
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Check if any field is empty
    if(empty($email) || empty($username) || empty($password)) {
        $error = "All fields are required.";
    } else {
        // Create a new User object
        $newUser = new Users($email, $username, $password, $level = 1);
        
        // Insert the new user into the database
        if(UserController::createUser($newUser)) {
            header('Location: ../index.php');
            exit();
        } else {
            $error = "Failed to create user.";
        }
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
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
            <h3><input type="text" name="username" placeholder="Username"></h3>
            <h3><input type="password" name="password" placeholder="Password"></h3>
            <input type="submit" value="Create Account" name="create_account">
            <a href="../index.php">Back></a>
            <?php if(!empty($error)) { ?>
            <h2><?php echo $error;} ?></h2>
        </form>
    </div>
</body>

</html>