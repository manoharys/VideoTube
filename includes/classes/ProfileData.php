<?php
class ProfileData {
    
    private $conn, $profileUserObj;

    public function __construct($conn, $profileUsername) {
        $this->conn = $conn;
        $this->profileUserObj = new User($conn, $profileUsername);
    }

    public function getProfileUsername() {
        return $this->profileUserObj->getUsername();
    }
}