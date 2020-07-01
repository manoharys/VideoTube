<?php
class SelectThumbnail {

    private $conn, $video;

    public function __construct($conn, $video) {
        $this->conn = $conn;
        $this->video = $video;
    }

    public function create() {
        $thumbnailData = $this->getThumbnailData();
    }

    private function getThumbnailData() {
        $data = array();

        $query = $this->conn->prepare("SELECT * FROM thumbnails WHERE videoId=:videoId");
        $query->bindParam(":videoId", $videoId);
        $videoId = $this->video->getVideoId();
        $query->execute();

        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }
}
?>