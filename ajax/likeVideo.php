<?php 
    require_once("../includes/config.php");
    require_once("../includes/classes/User.php");
    require_once("../includes/classes/Video.php");

    
        $videoId = $_POST["videoId"]; 
        $username = $_SESSION["userLoggedIn"];

        $userLoggedInObj = new User($conn, $username);

        $video = new Video($conn, $videoId, $userLoggedInObj);
        echo $video->like();
?>