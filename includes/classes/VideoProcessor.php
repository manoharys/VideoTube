<?php
class VideoProcessor {

    private $conn;
    private $sizeLimit = 50000000;
    private $allowedTypes = array( "mp4", "flv", "webm", "mkv", "vob", "ogv", "ogg", "avi", "wmv", "mov", "mpeg", "mpg");
    private $ffmpegPath;
    private $ffprobePath;
    public function __construct($conn) {
        $this->conn = $conn;
        $this->ffmpegPath=realpath("ffmpeg/windows/ffmpeg.exe");
        $this->ffprobePath= realpath("ffmpeg/windows/ffprobe.exe");
    }

    public function upload($videoUploadData) {

        $targetDir = "uploads/videos/";
        $videoData = $videoUploadData->videoDataArray;
        
        $tempFilePath = $targetDir . uniqid() . basename($videoData["name"]);
        //uploads/videos/5aa3e9343c9ffdogs_playing.flv

        $tempFilePath = str_replace(" ", "_", $tempFilePath);
        echo "$tempFilePath";
        //checking the size of the video
        $isValidData = $this->processData($videoData,$tempFilePath);

            if(!$isValidData){
                return false;
            }
       
            if(move_uploaded_file($videoData["tmp_name"],$tempFilePath)){
            // echo "file moved succefully";
            $finalFilePath = $targetDir . uniqid() . "mp4";
            

            if(!$this->insertVideoData($videoUploadData,$tempFilePath)){
                echo "Insert Query failed\n";
                return false;
            }
        //    if(!$this->convertVideoMp4($tempFilePath,$finalFilePath)){  
        //        echo "upload failed\n";
        //        return false;   
        //    }
        
             if(!$this->generateThumbnails($tempFilePath)){
                 echo "couldn't generate thumbnail";
                 return false;
             }
             return true;
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
        return $data['size'] <= $this->sizeLimit;
    }

    private function isValidType($type) {
        $lowercased = strtolower($type);
        return in_array($lowercased, $this->allowedTypes);
    }

    private function hasError($data){
        return $data["error"] != 0;
    }
     
    //Inserting the data to the database..
    private function insertVideoData($videoUploadData,$finalFilePath){
        $query = $this->conn->prepare("INSERT INTO videos(title,uploadedBy,description,category,privacy,filePath)
                                       VALUES(:title,:uploadedBy,:description,:category,:privacy,:filePath)");
        $query->bindParam(":title",$videoUploadData->title);
        $query->bindParam(":uploadedBy",$videoUploadData->uploadedBy);
        $query->bindParam(":description",$videoUploadData->description);
        $query->bindParam(":category",$videoUploadData->categories);
        $query->bindParam(":privacy",$videoUploadData->privacy);
        $query->bindParam(":filePath",$finalFilePath);

        return $query->execute();

    }

    // //Converting the videos to MP4 format
    // private function convertVideoMp4($tempFilePath,$finalFilePath){
    //     $cmd = "$this->ffmpegPath -i $tempFilePath $finalFilePath 2>&1";
         
    //      $outputLog = array();
    //      exec($cmd,$outputLog,$returnCode);

    //      if($returnCode !=0 ){
    //          //Command failed
    //          foreach($outputLog as $line){
    //              echo $line . "<br>";
    //          }
    //          return false;
    //      }
        
    //      return true;
    // }

    //Generating thumbnails
    public function generateThumbnails($filePath) {

        $thumbnailSize = "210x118";
        $numThumbnails = 3;
        $pathToThumbnail = "uploads/videos/thumbnails";
        
        $duration = $this->getVideoDuration($filePath);
        //echo "duration of the video $duration";
        $videoId = $this->conn->lastInsertId();
        $this->upadateDuration($duration,$videoId); 

        for($num = 1; $num <= $numThumbnails; $num++) {
            $imageName = uniqid() . ".jpg";
            $interval = ($duration * 0.8) / $numThumbnails * $num;
            $fullThumbnailPath = "$pathToThumbnail/$videoId-$imageName";

            $cmd = "$this->ffmpegPath -i $filePath -ss $interval -s $thumbnailSize -vframes 1 $fullThumbnailPath 2>&1";

            $outputLog = array();
            exec($cmd, $outputLog, $returnCode);
            
            if($returnCode != 0) {
                //Command failed
                foreach($outputLog as $line) {
                    echo $line . "<br>";
                }
            }

            $query = $this->conn->prepare("INSERT INTO thumbnails(videoId, filePath, selected)
                                        VALUES(:videoId, :filePath, :selected)");
          
            $query->bindParam(":videoId", $videoId);
            $query->bindParam(":filePath", $fullThumbnailPath);
            $query->bindParam(":selected", $selected);

            $selected = $num == 1 ? 1 : 0;

            $success = $query->execute();

            if(!$success) {
                echo "Error inserting thumbail\n";
                return false;
            }
        }

        return true;

    }

    private function getVideoDuration($filePath) {
        return (int)shell_exec("$this->ffprobePath -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 $filePath");
    }

    private function upadateDuration($duration, $videoId){
        $duration = $duration;
        $hours = floor($duration / 3600);
        $mins = floor(($duration - ($hours*3600)) / 60);
        $secs = floor($duration % 60);

        echo " Generating the video duration  $hours.$mins.$secs";
        
        
        $hours = ($hours < 1) ? "" : $hours . ":";
        $mins = ($mins < 10) ? "0" . $mins . ":" : $mins . ":";
        $secs = ($secs < 10) ? "0" . $secs : $secs;
        
        $duration = $hours.$mins.$secs;

        $query = $this->conn->prepare("UPDATE videos SET duration=:duration WHERE id=:videoId");
        $query->bindParam(":duration", $duration);
        $query->bindParam(":videoId", $videoId);
        $query->execute();
    }
}
?>