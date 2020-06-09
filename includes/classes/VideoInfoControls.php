<?php 
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
        return "<button>LIKE</button>";
    }
    
    private function videoDisLikeButton(){
        return "<button>DISLIKE</button>";
    }
  }

?>