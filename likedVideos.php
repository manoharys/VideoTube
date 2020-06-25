<?php
require_once("includes/header.php");
require_once("includes/classes/LikedVideosProvider.php");

if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

$likedVideosProvider = new LikedVideosProvider($conn, $userLoggedInObj);
$videos = $likedVideosProvider->getVideos();

$videoGrid = new VideoGrid($conn, $userLoggedInObj);
?>
<div class="largeVideoGridContainer">
    <?php
    if(sizeof($videos) > 0) {
        echo $videoGrid->createLarge($videos, "Videos that you have liked", false);
    }
    else {
        echo "No videos to show";
    }
    ?>
</div>