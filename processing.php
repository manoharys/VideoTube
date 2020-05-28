<?php require_once('includes/header.php');
    
    if(!isset($_POST['uploadButton'])){
       echo "File not found or uploaded";
    }
 
  //1) creating file upload data
    $videoUploadData = new VideoUploadData($__POST['fileInput'],$__POST['titleInput'],$__POST['descriptionInput'],$__POST['CategoryInput'],$__POST['PrivacyInput'],"Replace This");

?>