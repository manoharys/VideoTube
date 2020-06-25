<?php
class LikedVideosProvider {

    private $conn, $userLoggedInObj;

    public function __construct($conn, $userLoggedInObj) {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function getVideos() {
        $videos = array();
        $username = $this->userLoggedInObj->getUsername();
        $query = $this->conn->prepare("SELECT videoId FROM likes WHERE username=:username AND commentId=0
                                        ORDER BY id DESC");
        $query->bindParam(":username", $username);
      
        $query->execute();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $videos[] = new Video($this->conn, $row["videoId"], $this->userLoggedInObj);
        }
       
        return $videos;
    }
}
?>