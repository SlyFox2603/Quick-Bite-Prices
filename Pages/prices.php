<?php
session_start();
require_once('../Scripts/security.php');
require_once('../Scripts/foods_db.php');

Security::checkHTTPS();

// confirm user is authorized for the page
Security::checkAuthority('user');

// user clicked the logout button
if (isset($_POST['logout'])) {
    Security::logout();
}

$restaurant = isset($_GET['restaurant']) ? $_GET['restaurant'] : '';
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $restaurant; ?> Prices</title>
    <link rel="icon" type="image/png" href="../Images/favicon.png">
    <link href="../CSS/base.css" rel="stylesheet">
    <link href="../CSS/prices.css" rel="stylesheet">
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

    <div class="price-container">
        <h1>Prices for <?php echo $restaurant; ?></h1>
        <hr class="title-line">
        
        <!-- Display prices for items from the selected restaurant -->
        <div class="item-prices">
            <?php
            if (!empty($restaurant)) {
                $foods = FoodsDB::getFoodsByRestaurant($restaurant);
                if ($foods !== false) {
                    echo "<ul class='item-list'>";
                    foreach ($foods as $food) {
                        echo "<li class='item'>";
                        echo "<span class='item-name'>" . $food['Item_Name'] . "</span>";
                        echo "<span class='item-price'>$" . $food['Item_Price'] . "</span>";
                        echo "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "No items found for this restaurant.";
                }
            } else {
                echo "Please select a restaurant to view prices.";
            }
            ?>
        </div>
    </div>
</body>

</html>