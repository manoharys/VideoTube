<?php 
   require_once('includes/header.php');
   require_once("includes/classes/Video.php");
   require_once("includes/classes/VideoPlayer.php");
   require_once("includes/classes/VideoInfo.php");


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
       ?>
   </div>

   <div class="suggestion">
      suggestions
   </div>


<?php require_once('includes/footer.php') ?>
 