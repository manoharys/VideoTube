<?php
require_once("../includes/config.php"); 
require_once("../includes/classes/Comment.php"); 
require_once("../includes/classes/User.php"); 

$username = $_SESSION["userLoggedIn"];
$videoId = $_POST["videoId"];
$commentId = $_POST["commentId"];

$userLoggedInObj = new User($conn, $username);
$comment = new Comment($conn, $commentId, $userLoggedInObj, $videoId);

echo $comment->getReplies();
?>