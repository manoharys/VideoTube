<?php 
    require_once("includes/classes/VideoInfoControls.php");
  
   class VideoInfo{

     
    private $conn, $video, $userLoggedInObj;

    public function __construct($conn, $video, $userLoggedInObj){
        $this->video = $video;
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create(){
        return $this->getVideoPrimaryInfo(). $this->getVideoSecondaryInfo();        
   
     }

   private function getVideoPrimaryInfo(){
       $title = $this->video->getVideoTitle();
       $views = $this->video->getVideoViews();
       $videoInfoControls = new VideoInfoControls($this->video, $this->userLoggedInObj);
       $controls = $videoInfoControls->create();       
       return "<div class='videoInfo'>
                 <h1> $title</h1>

                 <div class='bottomSection'> 
                   <span class='viewCount'>$views views</span>
                   $controls
                 </div>
               </div>            
       ";
   }

   private function getVideoSecondaryInfo (){
       $description = $this->video->getVideoDescription();
       $uploadDate = $this->video->getVideoUploadDate();
       $uploadedBy = $this->video->getVideoUploadedBy();
       $profileButton = ButtonProvider::createProfileButton($this->conn, $uploadedBy);

       return "<div class='secondaryInfo'>
                 <div class='topRow'>
                   $description
                   $uploadedBy
                   $uploadDate
                   $profileButton
                 </div>
              </div>";
   }

}
?>