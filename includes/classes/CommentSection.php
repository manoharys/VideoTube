<?php 
   
  
   class commentSection{

     
    private $conn, $video, $userLoggedInObj, $actionButton;

    public function __construct($conn, $video, $userLoggedInObj){
        $this->video = $video;
        $this->conn = $conn;
        $this->userLoggedInObj = $userLoggedInObj;
    }

    public function create(){
        
     }

  

}
?>