<?php

require_once("database.php");
require_once("regions.php");

class RegionsDB {
    public static function getAllRegions() {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "SELECT * FROM regions";
            $result = $dbConn->query($query);
            $regions = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $region = new Region($row['Region_ID'], $row['Region']);
                    $regions[] = $region;
                }
            }
            return $regions;
        } else {
            return false;
        }
    }
}

?>