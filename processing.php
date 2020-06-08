<?php 
        require_once("includes/header.php");
        require_once("includes/classes/VideoUploadData.php");
        require_once("includes/classes/VideoProcessor.php");


        if(!isset($_POST["uploadButton"])) {
            echo "No file sent to page.";
            exit();
        }

        // 1) create file upload data
        $videoUpoadData = new VideoUploadData(
                                    $_FILES["fileInput"], 
                                    $_POST["titleInput"],
                                    $_POST["descriptionInput"],
                                    $_POST["privacyInput"],
                                    $_POST["categoryInput"],
                                    $userLoggedInObj->getUsername()  
                                );

        // 2) Process video data (upload)
        $videoProcessor = new VideoProcessor($conn);
        $wasSuccessful = $videoProcessor->upload($videoUpoadData);

        // 3) Checking wheather uploaded or not
        if($wasSuccessful){
            echo "file uploaded successfully";
        }


?>