<?php
class TrendingProvider {

    private $conn, $userLoggedInObj;

    public function __construct($conn, $userLoggedInObj) {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos() {
        $videos = array();

        $query = $this->conn->prepare("SELECT * FROM videos WHERE uploadDate >= now() - INTERVAL 7 DAY 
                                        ORDER BY views DESC LIMIT 15");
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->conn, $row, $this->userLoggedInObj);
            array_push($videos, $video);
        }

        return $videos;
    }
}
?>