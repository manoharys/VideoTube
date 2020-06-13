<?php 
    require_once("includes/classes/VideoInfoControls.php");
  
   class VideoInfo{

     
    private $conn, $video, $userLoggedInObj, $actionButton;

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
    
       if($uploadedBy == $this->userLoggedInObj->getUsername()){
            $this->actionButton = ButtonProvider::createEditButton($this->video->getVideoId());
       } 
       else{
           $userTo = new User($this->conn, $uploadedBy);
           $this->actionButton= ButtonProvider::createSubscriberButton($this->conn, $userTo, $this->userLoggedInObj);
       }

       return "<div class='secondaryInfo'>
                 <div class='topRow'>
                   $profileButton
                   <div class='uploadInfo'>
                    <span class = 'owner'>
                       <a href='profile.php?username = $uploadedBy'>
                           $uploadedBy
                       </a>
                    </span>
                    <span class = 'date'>
                       published on $uploadDate
                    </span>
                   </div> 
                   $this->actionButton
                </div>
              <div class='descriptionContainer'>
                $description
              </div>
              </div>";
   }

}
?>