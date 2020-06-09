<?php 
   class VideoInfo{

     
    private $conn, $video, $userLoggedInObj;

    public function __construct($conn, $video, $userLoggedInObj){
        $this->video = $video;
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create(){
        return $this->getVideoPrimaryInfo() . $this->getVideoSecondaryInfo();        
   }

   private function getVideoPrimaryInfo(){
       $title = $this->video->getVideoTitle();
       $views = $this->video->getVideoViews();

       return "<div>
                 <h3> $title</h3>
                 <div> $views </div>
               </div>           
       ";
   }

   private function getVideoSecondaryInfo (){
       return "";
   }

}
?>