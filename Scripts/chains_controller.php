<?php

require_once("chains_db.php");
require_once("chains.php");

class ChainsController {
    // Helper function to convert a db row into a Chains object
    private static function rowToChain($row) {
        $chain = new Chains($row['Chain_Name'],
            $row['Region_ID'],
            isset($row['Chain_ID']) ? $row['Chain_ID'] : null);
        return $chain;
    }

    // Function to add a new chain to the database
    public static function createChain($chain) {
        $chainName = $chain->getChainName();
        $regionID = $chain->getRegionId();
    
        $db = new Database();
        $dbConn = $db->getDbConn();
    
        if ($dbConn) {
            $query = "INSERT INTO chains (Chain_Name, Region_ID) VALUES ('$chainName', '$regionID')";
            if ($dbConn->query($query)) {
                return true;
            } else {
                // Error handling
                echo "Error: " . $query . "<br>" . $dbConn->error;
                return false;
            }
        } else {
            // Database connection failed
            echo "Error: Database connection failed.";
            return false;
        }
    }

    // Function to get chains by region ID from the database
    public static function getChainsByRegion($regionID) {
        $chain = ChainsDB::getChainsByRegion($regionID);
        return $chain;
    }
}

?>