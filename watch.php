<?php 
   require_once('includes/header.php');
   require_once("includes/classes/Video.php");
   require_once("includes/classes/VideoPlayer.php");
   require_once("includes/classes/VideoInfo.php");
   require_once("includes/classes/Comment.php");
   require_once("includes/classes/CommentSection.php");



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

            $videoInfo = new VideoInfo($conn, $video, $userLoggedInObj);
            echo $videoInfo->create();
            
            $commentSection = new CommentSection($conn, $video, $userLoggedInObj);
            echo $commentSection->create();
      ?>
   </div>
 

   <div class="suggestions">
      <?php
        $videoGrid = new VideoGrid($conn, $userLoggedInObj);
        echo $videoGrid->create(null, null, false);
      ?>
   </div>


<?php require_once('includes/footer.php') ?>
 