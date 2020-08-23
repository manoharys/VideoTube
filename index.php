<?php require_once('includes/header.php');
 
 if(!isset($_SESSION["userLoggedIn"])){
     header("Location: signIn.php");
 }

?>

<div class="videoSection">
    <?php
    $subscriptionsProvider = new SubscriptionsProvider($conn, $userLoggedInObj);
    $subscriptionVideos = $subscriptionsProvider->getVideos();

    $videoGrid = new VideoGrid($conn, $userLoggedInObj->getUsername());

    if(User::isLoggedIn() && sizeof($subscriptionVideos) > 0) {
        echo $videoGrid->create($subscriptionVideos, "Subscriptions", false);
    }

    echo $videoGrid->create(null, "Recommended", false);


    ?>
</div>
<?php require_once('includes/footer.php');     ?>
 