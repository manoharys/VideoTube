<?php
    
   class VideoDetailsFormProvider{
      private $conn;
        //Constructor
        public function __construct($conn){
           $this->conn  =  $conn;
        }

        public function createUploadForm(){
           $fileInput = $this->createFileInput();
           $titleInput = $this->createTitleInput();
           $descriptionInput = $this->createDescriptionInput();
           $privacyInput = $this->createPrivacyInput();
           $categoriesInput = $this->createCategoriesInput();
           $uploadButton = $this->createUploadButton();
           return "<form action='processing.php' method='POST' enctype='multipart/form-data'>
                $fileInput
                $titleInput
                $descriptionInput
                $categoriesInput
                $privacyInput
                $uploadButton
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

        private function createPrivacyInput(){
            return "
             <div class='form-group'>
                <select class='form-control' name=privacyInput>
                    <option value=0> private</option>
                    <option value=1> public</option>
                </select>
            </div>";
        }
        private function createCategoriesInput(){
                
            $html = "<div class='form-group'>
            <select class='form-control' name=categoryInput>"; 
                $query = $this->conn->prepare("SELECT * FROM categories");
                $query->execute();
                   while($row = $query->fetch(PDO::FETCH_ASSOC)){
                        $id = $row["id"];
                        $name = $row["name"];
                        $html.= "<option value='$id'> $name</option>";  //retriving the list from database.
                    }
                $html.= "</select>
                    </div>"; 
                return $html;
        } 

       private function createUploadButton(){
       
        return "<button type='submit' class='btn btn-primary' name='uploadButton'>Upload</button>";
       }
   }

?>