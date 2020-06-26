<?php
require_once("includes/classes/ProfileData.php");
class ProfileGenerator {

    private $conn, $userLoggedInObj, $profileData;

    public function __construct($conn, $userLoggedInObj, $profileUsername) {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
        $this->profileData = new ProfileData($conn, $profileUsername);
    }

    public function create() {
        $profileUsername = $this->profileData->getProfileUsername();
        if(!$this->profileData->userExists()) {
            echo "User does not exist";
        }
        $coverPhotoSection = $this->createCoverPhotoSection();
        $headerSection = $this->createHeaderSection();
        $tabsSection = $this->createTabsSection();
        $contentSection = $this->createContentSection();
        return "<div class='profileContainer'>
                    $coverPhotoSection
                    $headerSection
                    $tabsSection
                    $contentSection
                </div>";
    }

    public function createCoverPhotoSection() {
        $coverPhotoSrc = $this->profileData->getCoverPhoto();
        echo $coverPhotoSrc;
    }

    public function createHeaderSection() {
        
    }

    public function createTabsSection() {
        
    }

    public function createContentSection() {
        
    }
}
?>