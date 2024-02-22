<?php

require_once("users_db.php");
require_once("users.php");

class UserController {
    // helper function to convert a db row into a User object
    private static function rowToUser($row) {
        $user = new Users($row['EMail'],
            $row['Username'],
            $row['Password'],
            $row['Level'],
            isset($row['UserId']) ? $row['UserId'] : null);
        return $user;
    }

    // function to check login credentials - return true
    // if user is valid, false otherwise
    public static function validUser($email, $password) {
        $queryRes = UsersDB::getUserByEMail($email);

        if ($queryRes) {
            // process the user row
            $user = self::rowToUser($queryRes);
            if ($user->getPassword() === $password) {
                return $user->getLevel();
            } else {
                return false;
            }
        } else {
            // either no such user or db connect failed -
            // either way, can't validate the user
            return false;
        }
    }

    public static function createUser($user) {
        $email = $user->getEMail();
        $username = $user->getUsername();
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $level = $user->getLevel();
    
        $db = new Database();
        $dbConn = $db->getDbConn();
    
        if ($dbConn) {
            $query = "INSERT INTO users (EMail, Username, Password, Level) VALUES ('$email', '$username', '$password', '$level')";
            if ($dbConn->query($query)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public static function updatePassword($email, $newPassword) {
        $db = new Database();
        $dbConn = $db->getDbConn();

        if ($dbConn) {
            $query = "UPDATE users SET Password = '$newPassword' WHERE EMail = '$email'";
            if ($dbConn->query($query)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function deleteAccount($username) {
        // Check if the username is provided
        if(empty($username)) {
            return false;
        }
    
        // Attempt to delete the user from the database
        $deleted = UsersDB::deleteUserByUsername($username);
    
        if($deleted) {
            return true;
        } else {
            return false;
        }
    }

    public static function getUserByEmailAndPassword($email, $password) {
        $queryRes = UsersDB::getUserByEMail($email);
    
        if ($queryRes) {
            $user = self::rowToUser($queryRes);
            return $user;
        }
        return false;
    }
}

?>