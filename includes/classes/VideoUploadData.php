<?php
   
    class VideoUploadData {
        private $videoDataArray,$title,$description,$categories,$privacy,$uploadedBy;
        //constructor
        function __construct($videoDataArray,$title,$description,$categories,$privacy,$uploadedBy){
            $this->videoDataArray = $videoDataArray;
            $this->title = $title;
            $this->description = $description;
            $this->categories = $categories;
            $this->privacy = $privacy;
            $this->uploadedBy = $uploadedBy;
        }
    }

?>