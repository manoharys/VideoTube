<?php 
   
   class VideoPlayer{

     private $video;

     public function __construct($video){
         $this->video = $video;
     }

     public function create($autoPlay){
         if($autoPlay){
             $autoPlay = "autoPlay";
         }
         else{
             $autoPlay = "";
         }

         $filePath = $this->video->getVideoFilePath();

         return "<video class ='videoPlayer' controls $autoPlay>
                    <source src = '$filePath' type = 'video/mp4'>
                    Your browser does not support video tag.
                 </video>";
     }

   }
 
?>