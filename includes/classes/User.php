<?php 
   class User {
       private $conn,$sqlData;

       public function __construct($conn, $username){
           $this->conn = $conn;

           $query = $this->conn->prepare("SELECT * FROM users WHERE username = :un");
           $query->bindParam(":un", $username);
           $query->execute();

           $this->$sqlData = $query->fetch(PDO::FETCH_ASSOC);
           
       }

       public function getUsername(){
           return $this->sqlData["username"];
       }  
   }

?>