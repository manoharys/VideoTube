<?php 
   
  
   class commentSection{

     
    private $conn, $video, $userLoggedInObj, $actionButton;

    public function __construct($conn, $video, $userLoggedInObj){
        $this->video = $video;
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create(){
       return $this->createCommentSection();
     }

     private function createCommentSection(){
       $numOfComments = $this->video->getNumOfComments();
       $postedBy = $this->userLoggedInObj->getUsername();
       $videoId = $this->video->getVideoId();
       
       $profileButton = ButtonProvider::createProfileButton($this->conn, $postedBy);
       $commentAction = "";

       $commentButton = ButtonProvider::createButton("COMMENT", null, $commentAction, "postComment");
   
     }

  

}
?>