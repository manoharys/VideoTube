<?php 


class Video {
    private $conn, $sqlData, $userLoggedInObj;

    public function __construct($conn, $input, $userLoggedInObj){
        $this->userLoggedInObj = $userLoggedInObj;
        $this->conn = $conn;
        
        if(is_array($input)){
            $this->sqlData = $input;
        }
        else{
            $query = $this->conn->prepare("SELECT * FROM videos WHERE id = :id");
            $query->bindParam(":id", $input);
            $query->execute();
            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }           
    }

    public function getVideoId(){
        return $this->sqlData["id"];
    }
    
    
    public function getVideoUploadedBy(){
        return $this->sqlData["uploadedBy"];
    }

    
    public function getVideoTitle(){
        return $this->sqlData["title"];
    }

    
    public function getVideoDescription(){
        return $this->sqlData["description"];
    }
    
    public function getVideoCategory(){
        return $this->sqlData["category"];
    }

    
    public function getVideoPrivacy(){
        return $this->sqlData["privacy"];
    }

    
    public function getVideoFilePath(){
        return $this->sqlData["filePath"];
    }

    
    public function getVideoUploadDate(){
        $date = $this->sqlData["uploadDate"];
        return date("M j, Y", strtotime($date));
    }

    public function getVideoTimeStamp(){
        $date = $this->sqlData["uploadDate"];
        return date("M jS,  Y", strtotime($date));
    }

    
    public function getVideoViews(){
        return $this->sqlData["views"];
    }

    
    public function getVideoDuration(){
        return $this->sqlData["duration"];
    }

    public function getVideoThumbnail() {
          $query = $this->conn->prepare("SELECT filePath FROM thumbnails WHERE videoId = :videoId AND selected=1");
          $query->bindParam(":videoId", $videoId);
          $videoId = $this->getVideoId();
          $query->execute();

          return $query->fetchColumn();
    }

    public function increamentViews(){
         $videoId = $this->getVideoId();

         $query = $this->conn->prepare("UPDATE videos set views = views + 1 WHERE id = :id");
         $query->bindParam(":id",$videoId);

         $query->execute();

         $this->sqlData["views"] = $this->sqlData["views"] + 1;

    }

    public function getVideoLikes(){
       $query = $this->conn->prepare("SELECT COUNT(*) AS 'count' from likes WHERE videoId = :videoId");
       $query->bindParam(":videoId",$videoId);

       $videoId = $this->getVideoId();

       $query->execute();

       $getData = $query->fetch(PDO::FETCH_ASSOC);

       return $getData["count"];
    }

    public function getVideoDisLikes(){ 
        $query = $this->conn->prepare("SELECT COUNT(*) AS 'count' from DisLikes WHERE videoId = :videoId");
        $query->bindParam(":videoId",$videoId);
 
        $videoId = $this->getVideoId();
 
        $query->execute();
 
        $getData = $query->fetch(PDO::FETCH_ASSOC);
 
        return $getData["count"];
     }

     public function like(){
        $videoId = $this->getVideoId();
        $username = $this->userLoggedInObj->getUsername();
        if($this->wasLiked()){
            $query = $this->conn->prepare("DELETE FROM likes WHERE username = :username AND videoId = :videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);

            $query->execute();
            
            $result = array(
                "likes" => -1,
                "disLikes" => 0
            );
            return json_encode($result);
        }
        else{
            $query = $this->conn->prepare("DELETE FROM DisLikes WHERE username = :username AND videoId = :videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);

            $query->execute();
            $count = $query->rowCount();

            $query = $this->conn->prepare("INSERT INTO likes(username,videoId) VALUES(:username, :videoId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);
            
            $query->execute();

            $result = array(
                "likes" => 1,
                "disLikes" => 0 - $count
            );
            return json_encode($result);
        }
     }

     public function disLike(){
        $videoId = $this->getVideoId();
        $username = $this->userLoggedInObj->getUsername();
        if($this->wasDisLiked()){
            $query = $this->conn->prepare("DELETE FROM dislikes WHERE username = :username AND videoId = :videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);

            $query->execute();
            
            $result = array(
                "likes" => 0,
                "disLikes" => 1
            );
            return json_encode($result);
        }
        else{
            $query = $this->conn->prepare("DELETE FROM likes WHERE username = :username AND videoId = :videoId");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);

            $query->execute();
            $count = $query->rowCount();

            $query = $this->conn->prepare("INSERT INTO dislikes(username,videoId) VALUES(:username, :videoId)");
            $query->bindParam(":username", $username);
            $query->bindParam(":videoId", $videoId);
            
            $query->execute();

            $result = array(
                "likes" => 0 - $count,
                "disLikes" => 1
            );
            return json_encode($result);
        }
     }

     public function wasLiked(){
        $videoId = $this->getVideoId();
        $username = $this->userLoggedInObj->getUsername();
        
        $query = $this->conn->prepare("SELECT * FROM likes WHERE username=:username AND videoId=:videoId");
        $query->bindParam(':username', $username);
        $query->bindParam(':videoId', $videoId);
    
        $query->execute();
        
        return $query->rowCount() > 0;
     }

  public function wasDisLiked(){
    $videoId = $this->getVideoId();
    $username = $this->userLoggedInObj->getUsername();
    
    $query = $this->conn->prepare("SELECT * FROM dislikes WHERE username=:username AND videoId=:videoId");
    $query->bindParam(':username', $username);
    $query->bindParam(':videoId', $videoId);

    $query->execute();
    
    return $query->rowCount() > 0;
   }

   public function getNumOfComments(){
        $videoId = $this->getVideoId();
        
        $query = $this->conn->prepare("SELECT * FROM comments WHERE videoId = :videoId");
        $query->bindParam(':videoId', $videoId);   
        
        $query->execute();
        
        return $query->rowCount();
   }
   
   public function getComments() {
    $id= $this->getVideoId();
        
    $query = $this->conn->prepare("SELECT * FROM comments WHERE videoId = :videoId  ORDER BY datePosted DESC");
    $query->bindParam(':videoId', $id);   
    
    $query->execute();

    $comments = array();

    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $comment = new Comment($this->conn, $row, $this->userLoggedInObj, $id);
        array_push($comments,$comment);
    }

    return $comments;
   }
 }
?>