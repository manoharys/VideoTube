<?php require_once('includes/header.php');?>

 <?php 
    if(isset($_SESSION["userLoggedIn"])){
        echo "user is logged in as "." ". $userNameLogggedInObj->getUsername();
    }
 ?>

<?php require_once('includes/footer.php') ?>
 