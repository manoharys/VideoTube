<?php 
   require_once("ButtonProvider.php");
   require_once("CommentControls.php");
   
   class Comment{
       private $conn, $sqlData, $userLoggedInObj, $videoId;

       public function __construct($conn, $input, $userLoggedInObj, $videoId){

          if(!is_array($input)){
              $query = $conn->prepare("SELECT * FROM comments where id = :id");
              $query->bindParam(":id",$input);
              $query->execute();

              $input = $query->fetch(PDO::FETCH_ASSOC);
          }

          $this->sqlData = $input;
          $this->conn = $conn;
          $this->userLoggedInObj = $userLoggedInObj;
          $this->videoId = $videoId;
       }

       public function create(){
           $body = $this->sqlData["body"];
           $postedBy = $this->sqlData["postedBy"];
           $profileButton = ButtonProvider::createProfileButton($this->conn, $postedBy);
           $timespan = $this->time_elapsed_string($this->sqlData["datePosted"]);
           $commentControlsObj = new CommentControls($this->conn, $this, $this->userLoggedInObj);
           $commentControls = $commentControlsObj->create();
           return "
                 <div class = 'itemContainer'>
                    <div class = 'comment'>
                      $profileButton
                        <div class = 'mainContainer'>
                            <div class='commentHeader'>
                               <a href='profile.php?username=$postedBy'>
                                    <span class = 'username'>$postedBy</span>
                               </a>
                               <span class = 'timestamp'>$timespan</span>
                            </div>

                            <div class = 'body'>
                              $body
                            </div>
                        </div>
                    </div>
                    $commentControls
                 </div>
              
              ";
       }

       public function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

       public function getId(){
           return $this->sqlData["id"];
       }

       public function getVideoId(){
           return $this->videoId;
       }
       
       public function wasLiked(){
        $id = $this->getId();
        $username = $this->userLoggedInObj->getUsername();
        
        $query = $this->conn->prepare("SELECT * FROM likes WHERE username=:username AND commentId  =:commentId");
        $query->bindParam(':username', $username);
        $query->bindParam(':commentId', $id);
    
        $query->execute();
        
        return $query->rowCount() > 0;
     }

        public function wasDisLiked() {
            $id = $this->getVideoId();
            $username = $this->userLoggedInObj->getUsername();
            
            $query = $this->conn->prepare("SELECT * FROM dislikes WHERE username=:username AND commentId=:commentId");
            $query->bindParam(':username', $username);
            $query->bindParam(':commentId', $id);

            $query->execute();
            
            return $query->rowCount() > 0;
        }

       public function getLikes(){
           $query = $this->conn->prepare("SELECT count(*) as 'count' FROM likes WHERE commentId = :commentId");
           $query->bindParam(":commentId", $commentId);
           $commentId = $this->getId();
           $query->execute();

           $data = $query->fetch(PDO::FETCH_ASSOC);
           $numLikes = $data["count"];

           $query = $this->conn->prepare("SELECT count(*) as 'count' FROM disLikes WHERE commentId = :commentId");
           $query->bindParam(":commentId", $commentId);
           $query->execute();

           $data = $query->fetch(PDO::FETCH_ASSOC);
           $numDisLikes = $data["count"];

           return $numLikes - $numDisLikes;
           
       }
   }

?>