<?php
class VideoProcessor {

    private $conn;
    private $sizeLimit = 50000000;
    private $allowedTypes = array( "mp4", "flv", "webm", "mkv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function upload($videoUploadData) {

        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->videoDataArray;
        
        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
        //uploads/videos/5aa3e9343c9ffdogs_playing.flv

        $tempFilePath = str_replace(" ", "_", $tempFilePath);
        
        //checking the size of the video
        $isValidData = $this->processData($videoData,$tempFilePath);

        if(!$isValidData){
            return false;
        }

        if(move_uploaded_file($videoData["tmp_name"],$tempFilePath)){
            echo "file moved succefully";
        }
        //echo $tempFilePath;
    }

    private function processData($data,$filePath){
        $videoType = pathinfo($filePath,PATHINFO_EXTENSION);

        if(!$this->isValidSize($data)){
          echo "File is too large. Can't be more than ".$this->sizeLimit."bytes";
        }  
        else if(!$this->isValidType($videoType)) {
            echo "Invalid file type";
            return false;
        } 
        else if($this->hasError($data)){
            echo "Error code : ". $data["error"];
            return false;
        }    
        return true;
    }

    private function isValidSize($data){
        return $data['size'] <=$this->sizeLimit;
    }

    private function isValidType($type) {
        $lowercased = strtolower($type);
        return in_array($lowercased, $this->allowedTypes);
    }

    private function hasError($data){
        return $data["error"] != 0;
    }
}
?>