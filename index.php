<?php require_once('includes/header.php');?>

 <?php 
            if(isset($_SESSION["userLoggedIn"])) {
                $img = $userLoggedInObj->getUserProfilePic();
                echo "user is logged in as " . $userLoggedInObj->getName(). " and your email " .$userLoggedInObj->getUserEmail();
                echo "<img src = $img >";

            }
            else {
                echo "not logged in";
            }
 ?>

<?php require_once('includes/footer.php') ?>
 