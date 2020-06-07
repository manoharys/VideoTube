<?php 
  class Account{
       
      private  $conn;
      private $errorArray = array();

      //constructor
      public function __construct($conn){
          $this->conn = $conn;
      }
       
      //User signIn login validation part
      public function login($un, $pw){
        $pw = hash("sha512",$pw);

        $query = $this->conn->prepare("SELECT * from users WHERE username = :un AND password = :pw");
        $query->bindParam(":un", $un);
        $query->bindParam(":pw", $pw);

        $query->execute();

        if($query->rowCount() == 1){
          return true;
        }
        else{
          array_push($this->errorArray,Constants::$UserLoginFailed);
          return false;
        }
      }
     /*------------------------------------------------------*/

      public function register($fn, $ln, $un, $em, $em2, $pw, $pw2){
          $this->validateFirstName($fn);
          $this->validatelastName($ln);
          $this->validateusername($un);
          $this->validateEmail($em, $em2);
          $this->validatePassword($pw, $pw2);
           

      //checking whether errorArray is empty or not. If it is empty then no errors return true.
          if(empty($this->errorArray)){
            return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
          }
          else{
            return false;
          }
      }
      
      public function insertUserDetails($fn, $ln, $un, $em, $pw){
         
        //hashing password
        $pw = hash("sha512",$pw);
        $profilePic = "assets/images/profilePictures/default.png";

        $query = $this->conn->prepare("INSERT INTO users (firstname, lastname, username, email, password, profile)
                                      VALUES (:fn, :ln, :un, :em, :pw, :profilePic)");
        $query->bindParam(":fn",$fn);
        $query->bindParam(":ln",$ln);
        $query->bindParam(":un",$un);
        $query->bindParam(":em",$em);
        $query->bindParam(":pw",$pw);
        $query->bindParam(":profilePic",$profilePic);
         
       $query->execute();
       
       return true;
      }



      /* -------------------------validation functions ---------------------- */

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

      /*validating emails:-
        1) Check whether both email matches
        2) Check whether email is already in use.
      */
      private function validateEmail($em,$em2){

        if($em != $em2){
          array_push($this->errorArray,Constants::$emailDoNotMatch);
          return;
        }

        $query = $this->conn->prepare("SELECT email FROM users WHERE email = :em");
        $query->bindParam(":em",$em);
        $query->execute();

        if($query->rowCount() != 0 ){
          array_push($this->errorArray,Constants::$emailTaken);
        }
      }

      /*
        1) Check whether both password matches
        2) Make sure password contains only alphnumeric characters
        3) Check whether passwords are in certain ranges(using between 7 - 25)
      */
      private function validatePassword($pw, $pw2){

        if($pw != $pw2){
          array_push($this->errorArray, Constants::$passwordDoNotMatch);
          return;
        }

        if(preg_match("/[^A-Za-z0-9]/", $pw)){
          array_push($this->errorArray, Constants::$passwordNotAlphaNumeric);
          return;
        }

        if(strlen($pw)>25 || strlen($pw)<7){
          array_push($this->errorArray, Constants::$passwordLength);
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