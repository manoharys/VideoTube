<?php 
   class User{
       private $conn,$sqlData;

       public function __construct($conn, $sqlData){
           $this->conn = $conn;
       }
   }

?>