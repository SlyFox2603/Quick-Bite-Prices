<?php

class Users {
    private $userId;
    private $eMail;
    private $username;
    private $hashedPassword;
    private $level;

    public function __construct($eMail, $username, $hashedPassword, $level, $userId = null)
    {
        $this->eMail = $eMail;
        $this->username = $username;
        $this->hashedPassword = $hashedPassword;
        $this->level = $level;
        $this->userId = $userId;
    }

    public function getUserId() {
        return $this->userId;
    }
    public function setUserId($value) {
        $this->userId = $value;
    }

    public function getEMail() {
        return $this->eMail;
    }
    public function setEMail($value) {
        $this->eMail = $value;
    }

    public function getUsername() {
        return $this->username;
    }
    public function setUsername($value) {
        $this->username = $value;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }
    public function setHashedPassword($value) {
        $this->hashedPassword = $value;
    }

    public function getPassword() {
        return $this->hashedPassword;
    }
    public function setPassword($value) {
        $this->hashedPassword = password_hash($value, PASSWORD_DEFAULT);
    }

    public function getLevel() {
        return $this->level;
    }
    public function setLevel($value) {
        $this->level = $value;
    }
}

?>