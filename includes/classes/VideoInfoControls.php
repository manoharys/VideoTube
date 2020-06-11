<?php 
  require_once("includes/classes/ButtonProvider.php");
  class VideoInfoControls{
      
     
    private $video, $userLoggedInObj;

    public function __construct($video, $userLoggedInObj){
        $this->video = $video;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create(){
        $videoLikeButton = $this->videoLikeButton();
        $videoDisLikeButton = $this->videoDisLikeButton();
        return "
           <div class = 'controls'>
              $videoLikeButton
              $videoDisLikeButton
           </div>
        ";
    }
   
    private function videoLikeButton(){

        $text = $this->video->getVideoLikes();
        $videoId = $this->video->getVideoId();
        $action = "likeVideo(this, $videoId)";
        $class = "likeButton";
        $imageSrc = "assets/images/icons/thumb-up.png";

        if($this->video->wasLiked()){
        $imageSrc = "assets/images/icons/thumb-up-active.png";
        }
        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }
    
    private function videoDisLikeButton(){
        $text = $this->video->getVideoDisLikes();
        $videoId = $this->video->getVideoId();
        $action = "disLikeVideo(this, $videoId)";
        $class = "disLikeButton";
        $imageSrc = "assets/images/icons/thumb-down.png";
        if($this->video->wasDisLiked()){
          $imageSrc = "assets/images/icons/thumb-down-active.png";
          }
        return ButtonProvider::createButton($text, $imageSrc, $action, $class);
    }
  }

?>