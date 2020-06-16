<?php 
   
   include("../includes/config.php");

   if(isset($_POST["commentText"]) && isset($_POST["postedBy"]) && isset($_POST["videoId"])){
       //inserting into database
       $query = $conn->prepare("INSERT INTO comments(postedBy, videoId, responseTo, body)
                                        VALUES(:postedBy, :videoId, :responseTo, :body)");
       $query->bindParam(":postedBy", $postedBy);
       $query->bindParam(":videoId", $videoId);
       $query->bindParam(":body", $commentText);
       $query->bindparam(":responseTo", $responseTo);
       
       $postedBy = $_POST["postedBy"];
       $videoId = $_POST["videoId"];
       $reponseTo = $_POST["responseTo"];
       $commentText = $_POST["commentText"];

       $query->execute();
    }
   else{
       echo "one or more parameter is not passed to subscribe.php";
   }

?>