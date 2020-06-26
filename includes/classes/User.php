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

    public static function isLoggedIn() {
        return isset($_SESSION["userLoggedIn"]);
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
    
    public function getSignUpDate() {
        return $this->sqlData["signUpDate"];
    }

    //subscribers methods

    public function isSubscribedTo($userTo){
        $query = $this->conn->prepare("SELECT * FROM subscribers WHERE userTo = :userTo AND userFrom = :userFrom");
        $query->bindParam(":userTo", $userTO);
        $query->bindParam(":userFrom", $username);

        $username = $this->getUsername();

        $query->execute();

        return $query->rowCount() > 0;
    }

    //subscribers count

    public function getSubscriberCount(){
        
        $query = $this->conn->prepare("SELECT * FROM subscribers WHERE userTo = :userTo");
        $query->bindParam(":userTo", $username);

        $username = $this->getUsername();

        $query->execute();

        return $query->rowCount();
    
    }


    public function getSubscriptions() {
        $query = $this->conn->prepare("SELECT userTo FROM subscribers WHERE userFrom=:userFrom");
        $username = $this->getUsername();
        $query->bindParam(":userFrom", $username);
        $query->execute();
        
        $subs = array();
        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($this->conn, $row["userTo"]);
            array_push($subs, $user);
        }
        return $subs;
    }
}
?>