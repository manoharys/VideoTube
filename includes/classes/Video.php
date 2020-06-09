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
        return $this->sqlData["uploadDate"];
    }

    
    public function getVideoViews(){
        return $this->sqlData["views"];
    }

    
    public function getVideoDuration(){
        return $this->sqlData["duration"];
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
         return "You liked OR disLiked the video";
     }
}
?>