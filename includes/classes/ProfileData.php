<?php
class ProfileData {
    
    private $conn, $profileUserObj, $profileData;

    public function __construct($conn, $profileUsername) {
        $this->conn = $conn;
        $this->profileUserObj = new User($conn, $profileUsername);
    }
  
    public function getProfileUserObj() {
        return $this->profileUserObj;
    }

    public function getProfileUsername() {
        return $this->profileUserObj->getUsername();
    }

    public function userExists() {
        $query = $this->conn->prepare("SELECT * FROM users WHERE username = :username");
        $query->bindParam(":username", $profileUsername);
        $profileUsername = $this->getProfileUsername();
        $query->execute();

        return $query->rowCount() != 0;
    }

    public function getCoverPhoto() {
        return "assets/images/coverPhotos/default-cover-photo.jpg";
    }


    public function getProfileUserFullName() {
        return $this->profileUserObj->getName();
    }


    public function getProfilePic() {
        return $this->profileUserObj->getUserProfilePic();
    }

    public function getSubscriberCount() {
        return $this->profileUserObj->getSubscriberCount();
    }
}