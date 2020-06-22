<?php
class SearchResultProvider {

    private $conn, $userLoggedInObj;

    public function __construct($conn, $userLoggedInObj) {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos($term, $orderBy) {
        $query = $this->conn->prepare("SELECT * FROM videos WHERE title LIKE CONCAT('%', :term, '%')
                                        OR uploadedBy LIKE CONCAT('%', :term, '%') ORDER BY $orderBy DESC");
        $query->bindParam(":term", $term);
        $query->execute();

        $videos = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->conn, $row, $this->userLoggedInObj);
            array_push($videos, $video);
        }

        return $videos;

    }

}
?>