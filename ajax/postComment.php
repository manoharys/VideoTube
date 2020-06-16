<?php 
   
   include("../includes/config.php");

   if(isset($_POST["commentText"]) && isset($_POST["postedBy"]) && isset($_POST["videoId"])){
      echo "done";
   }
   else{
       echo "one or more parameter is not passed to subscribe.php";
   }

?>