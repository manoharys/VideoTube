<?php require_once('includes/header.php');
      require_once('includes/classes/VideoUploadData.php');
      require_once('includes/classes/videoProcessor.php');

            if(!isset($_POST['uploadButton'])){
            echo "File not found or uploaded";
            }
        
        //1) creating file upload data
            $videoUploadData = new VideoUploadData($__POST['fileInput'],$__POST['titleInput'],$__POST['descriptionInput'],$__POST['CategoryInput'],$__POST['PrivacyInput'],"Replace This");

        //2) Processin the upladed data
            $videoProcessor = new VideoProcessor($conn);
            $wasSuccessfull = $videoProcessor->upload($videoUploadData);   
?>