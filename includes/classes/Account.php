<?php 
  class Account{
       
      private  $conn;
      public $errorArray = array();

      //constructor
      public function __construct($conn){
          $this->conn = $conn;

      }
       
      public function register($fn, $ln, $un, $em, $em2, $pw, $pw2){
          $this->validateFirstName($fn);
      }

      /*The only validation to do on firstName is just to make sure 
        it as certain lenght.
        just for now character length ranges between 2 and 25
      */
      private function validateFirstName($fn){
          if($fn>25 || $fn<2){
              array_push($this->errorArray,Constants::$firstNameCharacter);        
          }
      }
    }
?>