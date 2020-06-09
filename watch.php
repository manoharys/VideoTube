<?php 
   require_once('includes/header.php');
   require_once("includes/classes/Video.php");
?>

 <?php 
    if(!isset($_GET["id"])){
        echo "no url passed on to the page";
    }

    $video = new Video($conn, $_GET["id"], $userLoggedInObj);
    $video->increamentViews();
    
    
 ?>

<?php require_once('includes/footer.php') ?>
 