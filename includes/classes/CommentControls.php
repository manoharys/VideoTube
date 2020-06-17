<?php 
  require_once("ButtonProvider.php");
  class CommentControls{
      
     
    private $conn, $comment, $userLoggedInObj;

    public function __construct($conn, $comment, $userLoggedInObj){
        $this->conn = $conn;
        $this->comment = $comment;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create(){
        $replyButton = $this->createReplyButton();
        $replyCount = $this->createLikesCount();
        $videoLikeButton = $this->createLikeButton();
        $videoDisLikeButton = $this->createDisLikeButton();
        $replySection = $this->createReplySection();
        return "
           <div class = 'controls'>
              $videoLikeButton
              $videoDisLikeButton
           </div>
        ";
    }
   
    private function createReplyButton() {
        $text = "REPLY";
        $action = "toggleReply(this)";

        return ButtonProvider::createButton($text, null, $action, null);
    } 

    private function createLikesCount() {
         $text = $this->comment->getLikes();

         if($text == 0) $text = "";
         return "<span class = 'likesCount'>$text</span>";
    }

    private function createReplySection() {
        return "";
    }


    private function createLikeButton(){

        $commentId = $this->comment->getId();
        $videoId = $this->comment->getVideoId();
        $action = "likeVideo($commentId, this, $videoId)";
        $class = "likeButton";
        $imageSrc = "assets/images/icons/thumb-up.png";

        if($this->comment->wasLiked()){
        $imageSrc = "assets/images/icons/thumb-up-active.png";
        }
        return ButtonProvider::createButton("", $imageSrc, $action, $class);
    }
    
    private function createDisLikeButton(){
        $commentId = $this->comment->getId();
        $videoId = $this->comment->getVideoId();
        $action = "disLikeVideo($commentId, this, $videoId)";
        $class = "disLikeButton";
        $imageSrc = "assets/images/icons/thumb-down.png";
        if($this->comment->wasDisLiked()){
          $imageSrc = "assets/images/icons/thumb-down-active.png";
          }
        return ButtonProvider::createButton("", $imageSrc, $action, $class);
    }
  }

?>