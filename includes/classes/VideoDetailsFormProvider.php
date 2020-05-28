<?php
    
   class VideoDetailsFormProvider{
      
        public function createUploadForm(){
           $fileInput = $this->createFileInput();
           $titleInput = $this->createTitleInput();
           $descriptionInput = $this->createDescriptionInput();
           return "<form action ='processing.php' method='POST'>
                $fileInput
                $titleInput
                $descriptionInput
           </form>";
       }

        private function createFileInput() {
            return "<div class='form-group'>
              <label for='exampleFormControlFile1'>Your file</label>
              <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
            </div>";
        }   

        private function createTitleInput(){
            return "<div class='form-group'>
            <input class='form-control' type='text' placeholder='Title' name='titleInput' required>
            </div>";
        }
        private function createDescriptionInput(){
            return "<div class='form-group'>
            <textarea class='form-control' type='text' placeholder='Description' name='descriptionInput' rows='4' required></textarea>
            </div>";
        }
   }

?>