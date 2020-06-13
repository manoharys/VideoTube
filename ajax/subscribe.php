<?php 
   
   include("../includes/config.php");

   if(isset($_POST["userTo"]) && isset($_POST["userFrom"])){
       $userTo = $_POST["userTo"];
       $userFrom = $_POST["userFrom"];

       /* 1) check wheather user is already subscribed
          2) If not subscribed insert into database
          3) else delete from the database / unsubscribe
          4) return number of subscriber 
       */
       $query = $conn->prepare("SELECT * FROM subscribers WHERE userTo = :userTo AND userFrom = :userFrom");
       $query->bindParam(":userTo", $userTo);
       $query->bindParam(":userFrom", $userFrom);
       $query->execute();

       if($query->rowCount() == 0){
           //insert
           $query = $conn->prepare("INSERT INTO subscribers(userTo, userFrom)
                                  VALUES(:userTo, :userFrom)"); 
           $query->bindParam(":userTo", $userTo);
           $query->bindParam(":userFrom", $userFrom);
           $query->execute();         
        }
       else {
           //DELETE
            $query = $conn->prepare("DELETE  FROM subscribers WHERE userTo = :userTo AND userFrom = :userFrom");
            $query->bindParam(":userTo", $userTo);
            $query->bindParam(":userFrom", $userFrom);
            $query->execute();
       }
       //RETURN NO. OF SUBS
       $query = $conn->prepare("SELECT * FROM subscribers WHERE userTo = :userTo ");
       $query->bindParam(":userTo", $userTo);
       $query->execute();

       echo $query->rowCount();

   }
   else{
       echo "one or more parameter is not passed to subscribe.php";
   }

?>