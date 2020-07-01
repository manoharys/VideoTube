<?php
require_once("includes/header.php");
require_once("includes/classes/VideoPlayer.php");
require_once("includes/classes/VideoDetailsFormProvider.php");
require_once("includes/classes/VideoUploadData.php");
require_once("includes/classes/SelectThumbnail.php");

if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

if(!isset($_GET["videoId"])) {
    echo "No video selected";
    exit();
}

$video = new Video($conn, $_GET["videoId"], $userLoggedInObj);
if($video->getVideoUploadedBy() != $userLoggedInObj->getUsername()) {
    echo "Not your video";
    exit();
}
?>
<div class="editVideoContainer column">

    <div class="topSection">
        <?php
        $videoPlayer = new VideoPlayer($video);
        echo $videoPlayer->create(false);

        $selectThumbnail = new SelectThumbnail($conn, $video);
        echo $selectThumbnail->create();
        ?>
    </div>

    <div class="bottomSection">

    </div>

</div>