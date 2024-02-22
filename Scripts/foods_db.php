<?php

require_once("database.php");
require_once("foods.php");

class FoodsDB {
    public static function getAllFoods() {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "SELECT * FROM foods";
            $result = $dbConn->query($query);
            $foods = array();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $food = new Foods($row['Food_ID'], $row['Item_Name'], $row['Item_Price'], $row['Chain_ID']);
                    $foods[] = $food;
                }
            }
            return $foods;
        } else {
            return false;
        }
    }

    public static function getFoodsByRestaurant($restaurant) {
        $db = new Database();
        $dbConn = $db->getDbConn();
    
        if ($dbConn) {
            $restaurant = $dbConn->real_escape_string($restaurant); // Sanitize input
            $query = "SELECT Food_ID, Item_Name, Item_Price FROM foods WHERE Chain_ID = (SELECT Chain_ID FROM chains WHERE Chain_Name = '$restaurant')";
            $result = $dbConn->query($query);
            $foods = array();
    
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Format the price as a decimal number with two decimal places
                    $price = number_format($row['Item_Price'], 2);
                    $food = array(
                        'Food_ID' => $row['Food_ID'],
                        'Item_Name' => $row['Item_Name'],
                        'Item_Price' => $price
                    );
                    $foods[] = $food;
                }
            }
            return $foods;
        } else {
            return false;
        }
    }
}

?>