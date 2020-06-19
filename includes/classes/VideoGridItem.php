<?php
    class VideoGridItem {
        private $video, $largeMode;

        public function __construct($video, $largeMode) {
            $this->video = $video;
            $this->largeMode = $largeMode;
        }

        public function create() {
            return ""; 
        }
    }
?>