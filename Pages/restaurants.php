<?php
session_start();
require_once('../Scripts/chains_db.php');
require_once('../Scripts/security.php');

Security::checkHTTPS();

// confirm user is authorized for the page
Security::checkAuthority('user');

// user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}

// Fetch chains for each region
$northeastChains = ChainsDB::getChainsByRegion(1);
$midwestChains = ChainsDB::getChainsByRegion(2);
$southChains = ChainsDB::getChainsByRegion(3);
$westChains = ChainsDB::getChainsByRegion(4);
$everywhereChains = ChainsDB::getChainsByRegion(5);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurants</title>
    <link rel="icon" type="image/png" href="../Images/favicon.png">
    <link href="../CSS/base.css" rel="stylesheet">
    <link href="../CSS/restaurants.css" rel="stylesheet">
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
    <!-- Display each restaurant in it's corresponding region -->
    <div class="container">
        <div class="tall-box">
            <h1>Everywhere</h1>
            <hr class="title-line">
            <?php foreach ($everywhereChains as $chain) { ?>
                <a style="font-size: 30px;" href="prices.php?restaurant=<?php echo urlencode($chain->getChainName()); ?>"><?php echo $chain->getChainName(); ?></a><br>
            <?php } ?>
        </div>
        <div class="box-topleft" style="margin-botton: 20px;">
            <h1>Northeast</h1>
            <hr class="title-line">
            <?php foreach ($northeastChains as $chain) { ?>
                <a style="font-size: 30px;" href="prices.php?restaurant=<?php echo urlencode($chain->getChainName()); ?>"><?php echo $chain->getChainName(); ?></a><br>
            <?php } ?>
        </div>
        <div class="box-topright">
            <h1>Midwest</h1>
            <hr class="title-line">
            <?php foreach ($midwestChains as $chain) { ?>
                <a style="font-size: 30px;" href="prices.php?restaurant=<?php echo urlencode($chain->getChainName()); ?>"><?php echo $chain->getChainName(); ?></a><br>
            <?php } ?>
        </div>
        <div class="box-bottomleft">
            <h1>South</h1>
            <hr class="title-line">
            <?php foreach ($southChains as $chain) { ?>
                <a style="font-size: 30px;" href="prices.php?restaurant=<?php echo urlencode($chain->getChainName()); ?>"><?php echo $chain->getChainName(); ?></a><br>
            <?php } ?>
        </div>
        <div class="box-bottomright">
            <h1>West</h1>
            <hr class="title-line">
            <?php foreach ($westChains as $chain) { ?>
                <a style="font-size: 30px;" href="prices.php?restaurant=<?php echo urlencode($chain->getChainName()); ?>"><?php echo $chain->getChainName(); ?></a><br>
            <?php } ?>
        </div>
    </div>
</body>

</html>