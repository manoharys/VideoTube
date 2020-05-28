<?php
   class VideoProcessor{
       private $conn;
       //constructor
       function __construct($conn){
           $this->conn = $conn;
       }
       //Stroing the uploaded data...
       function upload(){
           echo "file uploaded";
       }

   }
?>