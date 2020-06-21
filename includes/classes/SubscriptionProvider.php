<?php
class SubscriptionsProvider {

    private $conn, $userLoggedInObj;

    public function __connstruct($conn, $userLoggedInObj) {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos() {
        $videos = array();
        $subscriptions = $this->userLoggedInObj->getSubscriptions();

        if(sizeof($subscriptions) > 0) {
            
        }

        return $videos;

    }
    
}
?>