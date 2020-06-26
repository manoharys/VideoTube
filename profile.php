<?php
require_once("includes/header.php");
require_once("includes/classes/ProfileGenerator.php");
require_once("includes/classes/ProfileData.php");
if(isset($_GET["username"])) {
    $profileUsername = $_GET["username"];
}
else {
    echo "Channel not found";
    exit();
}
$profileGenerator = new ProfileGenerator($conn, $userLoggedInObj, $profileUsername);
echo $profileGenerator->create();
?>