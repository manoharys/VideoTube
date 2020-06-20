<?php
    class VideoGridItem {
        private $video, $largeMode;

        public function __construct($video, $largeMode) {
            $this->video = $video;
            $this->largeMode = $largeMode;
        }

        public function create() {
           $thumbnail = $this->createThumbnail();
           $details = $this->createDetails();
           $url = "watch.php?id=" . $this->video->getVideoId();

           return "<a href='$url'>
                       <div class = 'videoGridItem'>
                             $thumbnail
                             $details
                       </div>
                   </a>
           ";
        }

        private function createThumbnail() {
            $thumbnail = $this->video->getVideoThumbnail();
            $duration = $this->video->getVideoDuration();

            return "<div class='thumbnail'>
                        <img src='$thumbnail'>
                        <div class='duration'>
                           <span> $duration </span>
                        </div>
                    </div>
            ";
        }

        private function createDetails() {
           $title = $this->video->getVideoTitle();
           $username = $this->video->getVideoUploadedBy(); 
           $views = $this->video->getVideoViews(); 
           $description =  $this->createDescription();
           $timeStamp = $this->video->getVideoTimeStamp(); 

           return "
                  <div class='details'>
                     <h3 class='title'>$title</h3>
                     <span class='username'>$username</span>
                     <div class='stats'>
                        <span class = 'viewCount'>$views views- </span>
                        <span class = 'timeStamp'>$timeStamp</span>
                     </div>
                     $description
                  </div>
           
           ";
        }

        private function createDescription() {
            if(!$this->largeMode) {
                return "";
            }
            else {
                $description = $this->video->getVideoDescription();
                $description = (strlen($description) > 350) ? substr($description, 0, 347)."..." : $description;

                return "<span class='description'>$description</span>";
            }
        }
    }
?>