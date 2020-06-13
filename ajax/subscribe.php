<?php 
   
   include("../includes/config.php");

   if(isset($_POST["userTo"]) && isset($_POST["userFrom"])){
     echo "parameters passed sucessfully";
   }
   else{
       echo "one or more parameter is not passed to subscribe.php";
   }

?>