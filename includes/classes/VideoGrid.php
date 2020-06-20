<?php 
   class VideoGrid{
    
    private $conn, $userLoggedInObj;
    private $largeMode = false;
    private $gridClass = "videoGrid";

    public function __construct($conn, $userLoggedInObj) {
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create($videos, $title, $showFilter) {
         
        if($videos == null) {
            $gridItem = $this->generateItems();
        }
        else{
            $gridItem = $this->generateItemsFromVideos($videos);
        }
        
        $header = "";

        if($title != null){
            $header = $this->createGirdHeader($title, $showFilter);
        }

        return "$header
                <div class = '$this->gridClass'>
                     $gridItem
                </div>";
    }

      public function generateItems() {
        $query = $this->conn->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 15");
        $query->execute();

        $elementHtml = "";
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $video = new Video($this->conn, $row, $this->userLoggedInObj);
            $item = new VideoGridItem($video, $this->largeMode);
            $elementHtml .= $item->create();
        }

        return $elementHtml;
      }

      public function generateItemsFromVideos($videos) {
        return "";
      }
      
      public function createGirdHeader($title, $showFilter) {
        return "";
      }


   }
?>