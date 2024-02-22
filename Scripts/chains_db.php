<?php

require_once("database.php");
require_once("chains.php");

class ChainsDB {
    public static function getChainsByRegion($regionID) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "SELECT * FROM chains WHERE Region_ID = ?";
            $stmt = $dbConn->prepare($query);
            $stmt->bind_param("i", $regionID);
            $stmt->execute();
            $result = $stmt->get_result();
            $chains = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $chain = new Chains($row['Chain_Name'], $row['Chain_ID'], $row['Region_ID']);
                    $chains[] = $chain;
                }
            }
            return $chains;
        } else {
            return false;
        }
    }
}

?>