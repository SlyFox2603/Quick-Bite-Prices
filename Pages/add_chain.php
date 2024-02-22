<?php
session_start();
require_once('../Scripts/chains.php');
require_once('../Scripts/chains_controller.php');
require_once('../Scripts/security.php');

Security::checkHTTPS();

// confirm user is authorized for the page
Security::checkAuthority('admin');

$error = "";

if(isset($_POST['add_chain'])) {
    // Retrieve user input
    $chainName = $_POST['chain_name'];
    $regionID = $_POST['region_id'];

    // Validate Region_ID
    $validRegionIDs = getValidRegionIDs();
    if (!in_array($regionID, $validRegionIDs)) {
        $error = "Invalid Region ID.";
    } else {
        // Create a new Chains object
        $newChain = new Chains($chainName, $regionID); 
        
        // Insert the new chain into the database
        if(ChainsController::createChain($newChain)) {
            header('Location: admin_panel.php');
            exit();
        } else {
            $error = "Failed to add chain.";
        }
    }
}

// Function to fetch valid Region IDs from the database
function getValidRegionIDs() {
    $db = new Database();
    $dbConn = $db->getDbConn();

    if ($dbConn) {
        $query = "SELECT Region_ID FROM regions";
        $result = $dbConn->query($query);

        $validRegionIDs = array();
        while ($row = $result->fetch_assoc()) {
            $validRegionIDs[] = $row['Region_ID'];
        }

        return $validRegionIDs;
    } else {
        return array(); // Return an empty array if database connection fails
    }
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Restaurant</title>
    <link rel="icon" type="image/png" href="../Images/favicon.png">
    <link href="../CSS/base.css" rel="stylesheet">
    <link href="../CSS/user.css" rel="stylesheet">
    <link href="../CSS/create_user.css" rel="stylesheet">
</head>

<body>
    <header>
        <div id="logo">
            <img src="../Images/Quick_Bite_Prices_logo.png" alt="Logo">
        </div>
        <div class="title-container">
            <div id="title">Quick Bite Prices</div>
            <hr class="title-line">
        </div>
    </header>

    <div class="login-container">
        <form method='POST'>
            <h3><input type="text" name="chain_name" placeholder="Chain Name"></h3>
            <h3>
                <select style="width: 100%;padding: 10px;font-size: 32px;margin-bottom: 10px;border: 1px solid #ccc;" name="region_id">
                    <option value="">Select Region</option>
                    <?php
                    require_once('../Scripts/regions_db.php');
                    $regions = RegionsDB::getAllRegions();
                    if ($regions) {
                        foreach ($regions as $region) {
                            echo "<option value='" . $region->getRegionId() . "'>" . $region->getRegionName() . "</option>";
                        }
                    }
                    ?>
                </select>
            </h3>
            <input type="submit" value="Add Chain" name="add_chain">
            <a href="admin_panel.php">Back</a>
            <?php if(!empty($error)) { ?>
            <h2><?php echo $error; ?></h2>
            <?php } ?>
        </form>
    </div>
</body>

</html>