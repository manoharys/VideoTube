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
            
            // user1, user2, user3
            // SELECT * FROM videos WHERE uploadedBy = ? OR uploadedBy = ? OR uploadedBy = ? 
            // $query->bindParam(1, "user1");
            // $query->bindParam(2, "user2");
            // $query->bindParam(3, "user3");

            $condition = "";
            $i = 0;

            while($i < sizeof($subscriptions)) {
                
                if($i == 0) {
                    $condition .= "WHERE uploadedBy=?";
                }
                else {
                    $condition .= " OR uploadedBy=?";
                }
                $i++;
            }

            $videoSql = "SELECT * FROM videos $condition ORDER BY uploadDate DESC";
            $videoQuery = $this->con->prepare($videoSql);

            $i = 1;

            foreach($subscriptions as $sub) {
                $videoQuery->bindParam($i, $subUsername);
                $subUsername = $sub->getUsername();
                $i++;
            }

            $videoQuery->execute();
            while($row = $videoQuery->fetch(PDO::FETCH_ASSOC)) {
                $video = new Video($this->con, $row, $this->userLoggedInObj);
                array_push($videos, $video);
            }

        }

        return $videos;

    }
    
}
?>