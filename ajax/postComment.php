<?php 
   
   include("../includes/config.php");
   include("../includes/classes/Comment.php");
   include("../includes/classes/User.php");

   if(isset($_POST["commentText"]) && isset($_POST["postedBy"]) && isset($_POST["videoId"])){
       $userLoggedInObj = new User($conn, $_SESSION["userLoggedIn"]);
       
       //inserting into database
       $query = $conn->prepare("INSERT INTO comments(postedBy, videoId, responseTo, body)
                                        VALUES(:postedBy, :videoId, :responseTo, :body)");
       $query->bindParam(":postedBy", $postedBy);
       $query->bindParam(":videoId", $videoId);
       $query->bindParam(":body", $commentText);
       $query->bindparam(":responseTo", $responseTo);
       
       $postedBy = $_POST["postedBy"];
       $videoId = $_POST["videoId"];
       $responseTo = isset($_POST['responseTo']) ? $_POST['responseTo'] : 0;
       
       $commentText = $_POST["commentText"];

       $query->execute();

       $newComment = new Comment($conn, $conn->lastInsertId(), $userLoggedInObj, $videoId);
       echo $newComment->create();
    }
   else{
       echo "one or more parameter is not passed to subscribe.php";
   }

?>