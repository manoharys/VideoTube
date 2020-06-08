<?php 


class User {
    private $conn, $sqlData;

    public function __construct($conn, $username){
        $this->conn = $conn;

        $query = $this->conn->prepare("SELECT * FROM users WHERE username = :un");
        $query->bindParam(":un", $username);
        $query->execute();
   
        $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
      
    }

    public function getUsername(){
        return $this->sqlData["username"];
    }  

    public function getName(){
        return $this->sqlData["firstName"] . " " . $this->sqlData["lastName"];
    }

    public function getUserFirstName(){
        return $this->sqlData["firstName"];
    }  

    public function getUserLastName(){
        return $this->sqlData["lastName"];
    }  

    public function getUserProfilePic(){
        return $this->sqlData["profilePic"];
    }  

    public function getUserEmail(){
        return $this->sqlData["email"];
    }  
}
?>