<?php
class VideoProcessor {

    private $conn;
    private $sizeLimit = 50000000;
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

        echo $tempFilePath;
    }

    private function processData($data,$filePath){
        $videoData = pathinfo($filePath,PATHINFO_EXTENSION);

        if(!$this->isValidSize($data)){
          echo "File is too large. Can't be more than ".$this->sizeLimit."bytes";
        }       
    }
    private function isValidSize($data){
        return $data['size'] <=$this->sizeLimit;
    }
}
?>