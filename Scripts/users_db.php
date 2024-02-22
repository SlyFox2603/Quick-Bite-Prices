<?php

require_once("database.php");

// class for users table queries
class UsersDB {
    // function to get a user by their e-mail
    public static function getUserByEMail($email) {
        // get the DB connection
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            // create the query string
            $query = "SELECT * FROM users
                    WHERE users.EMail = '$email'";

            // execute the query - returns false if
            // no such email found
            $result = $dbConn->query($query);
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public static function deleteUserByUsername($username) {
        $db = new Database();
        $conn = $db->getDbConn();

        if(!$conn) {
            return false;
        }

        // Perform the deletion query
        $query = "DELETE FROM users WHERE Username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);

        if($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>