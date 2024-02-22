<?php

// helper functions for dealing with security
class Security {
    public static function checkHTTPS() {
        if (!isset($_SERVER['HTTPS'])
            || $_SERVER['HTTPS'] != 'on')
        {
            // Get the current URL
            $url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            
            // Redirect to HTTPS
            header("Location: $url");
            exit();
        }
    }

    // perform any needed clean-up for logging out
    public static function logout() {
        unset($_SESSION); // clear the session info

        // clear any post info to prevent back button
        // from allowing user to breach security
        unset($_POST);

        // set a logout message and return to login page
        $_SESSION['logout_msg'] = 'Successfully logged out.';
        header('Location: ../index.php');
        exit();
    }

    public static function checkAuthority($auth) {
        // check to see if user is authorized - if not, set
        // a message and return to login page
        if (!isset($_SESSION[$auth]) || !$_SESSION[$auth]) {
            $_SESSION['logout_msg'] =
                'Current login unauthorized for this page.';
            header("Location: ../index.php");
            exit();
        }
    }
}

?>