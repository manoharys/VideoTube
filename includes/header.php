<?php 
  require_once("includes/config.php");
  require_once("includes/classes/ButtonProvider.php"); 
  require_once("includes/classes/NavigationMenuProvider.php");
  require_once("includes/classes/User.php");
  require_once("includes/classes/VideoGrid.php");
  require_once("includes/classes/VideoGridItem.php");
  require_once("includes/classes/Video.php");
  require_once("includes/classes/SubscriptionProvider.php");

  
  $usernameLoggedIn = isset($_SESSION["userLoggedIn"]) ? $_SESSION["userLoggedIn"] : "";
  $userLoggedInObj = new User($conn, $usernameLoggedIn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoTube</title>
    <!-- favicon -->
    <link href="assets/images/icons/favicon2.jpg" rel="icon">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/CSS/style.css">

    <!-- Jquery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>

    <!-- Custom JS files -->
      <script src="./assets/JS/commonAction.js"></script>
      <script src = "./assets/JS/videoPlayerAction.js"></script>
      <script src = "./assets/JS/userAction.js"></script>
      <script src = "./assets/JS/commentAction.js"></script>



</head>

<body>
    <div id="pageContainer">
        <!-- main header -->
        <div id="mastHeadContainer">
            <!-- menu bar btn -->
            <button class="navShowHide">
                <img src="./assets/images/icons/menu.png" alt="menu">
            </button>
            <!-- app logo  -->
            <a class='logoContainer' href="index.php">
                <img src="./assets/images/icons/VideoTubeLogo.png" title="VideoTube home" alt="site-logo">
            </a>
            <!--Search bar  -->
            <div class="searchBarContainer">
                <form action="search.php" method="get">
                    <input type="text" class="searchBar" name="term" placeholder="Search" autofocus>
                    <button class="searchButton">
                        <img src="./assets/images/icons/search.png" alt="menu">
                    </button>
                </form>
            </div>
            <!-- right icons -->
            <div class="rightIcons">
                <a href="upload.php">
                <img src="./assets/images/icons/upload.png" alt="upload">
                </a>
                <!-- <a href="#">
                <img src="./assets/images/profilePictures/default.png" alt="user">
                </a> -->
                
                 <?php echo ButtonProvider::createUserProfileNavigationButton($conn, $userLoggedInObj->getUsername()); ?> 
            </div>
        </div>


        <!-- side navigation bar -->
        <div id="sideNavContainer" style="display:none;">
        <?php        
           $navigationProvider = new NavigationMenuProvider($conn, $userLoggedInObj);
           echo  $navigationProvider->create();              
        ?>
        </div>


        <!--main section area  -->
        <div id="mainSectionContainer">
            <div id="mainContentContainer">