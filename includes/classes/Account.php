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
          $this->validatelastName($ln);
          $this->validateusername($un);
      }

      /*The only validation to do on firstName & lastName is just to make sure 
        it as certain lenght.
        just for now character length ranges between 2 and 25
      */
      private function validateFirstName($fn){
          if(strlen($fn) > 25 || strlen($fn) < 2){
              array_push($this->errorArray,Constants::$firstNameCharacter);        
          }
      }
      private function validatelastName($ln){
        if(strlen($ln) > 25 || strlen($ln) < 1){
            array_push($this->errorArray,Constants::$lastNameCharacter);        
        }
     }

      /*validating username:-
         1) username length ranges
         2) Checking whether the username already exits or not
      */
      private function validateusername($un){
        if(strlen($un) > 25 || strlen($un) < 5){
            array_push($this->errorArray,Constants::$usernameCharacter);        
        }

        $query = $this->conn->prepare("SELECT username FROM users WHERE username = :un");
        $query->bindParam(":un",$un);
        $query->execute();

        if($query->rowCount() != 0){
          array_push($this->errorArray,Constants::$usernameTaken);      
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