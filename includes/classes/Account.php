<?php 
  class Account{
       
      private  $conn;
      private $errorArray = array();

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
          if(strlen($fn) > 25 || strlen($fn) < 2){
              array_push($this->errorArray,Constants::$firstNameCharacter);        
          }
      }

      //Display error message to the user
      public function getError($error){
        if(in_array($error,$this->errorArray)){
          return "<span class = 'errorMessage'>$error</span>";
        }
      }
    }
?>