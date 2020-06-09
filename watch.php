<?php 
   require_once('includes/header.php');
   require_once("includes/classes/Video.php");
   require_once("includes/classes/VideoPlayer.php");
?>

 <?php 
    if(!isset($_GET["id"])){
        echo "no url passed on to the page";
    }

    $video = new Video($conn, $_GET["id"], $userLoggedInObj);
    $video->increamentViews();
        
 ?>

   <div class="watchLeftColumn">
       <?php 
            $videoPlayer = new VideoPlayer($video);
            echo $videoPlayer->create(true);
       ?>
   </div>

   <div class="suggestion">
   </div>


<?php require_once('includes/footer.php') ?>
 