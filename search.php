<?php
require_once("includes/header.php");

if(!isset($_GET["term"]) || $_GET["term"] == "") {
    echo "You must enter a search term";
    exit();
}

$term = $_GET["term"];

if(!isset($_GET["orderBy"]) || $_GET["orderBy"] == "views") {
    $orderBy = "views";
}
else {
    $orderBy = "uploadDate";
}
?>


<?php
require_once("includes/footer.php");
?>