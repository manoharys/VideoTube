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
       $commentAction = "postComment(this, \"$postedBy\", $videoId,  null, \"comments\")";

       $commentButton = ButtonProvider::createButton("COMMENT", null, $commentAction, "postComment");

        $comments = $this->video->getComments();
        $commentItems = "";
        foreach($comments as $comment) {
            $commentItems .= $comment->create();
        } 
      
       return "
              <div class = 'commentSection'>
                  <div class = 'header'>
                      <span class='commentCount'>$numOfComments comments</span>
                      <div class = 'commentForm'>
                          $profileButton
                          <textarea class = 'commentBodyClass' placeholder = 'add a public comment'></textarea>
                          $commentButton
                      </div>
                  </div>

                  <div class = 'comments'>
                     $commentItems 
                  </div>

              </div>
            
            ";
     }

  

}
?>