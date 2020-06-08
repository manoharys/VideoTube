<?php 


class User {
    private $conn, $sqlData, $userLoggedInObj;

    public function __construct($conn, $input, $userLoggedInObj){
        $this->userLoggedInObj = $userLoggedInObj;
        $this->conn = $conn;
        
        if(in_array($input)){
            $this->sqlData = $input;
        }
        else{
            $query = $this->conn->prepare("SELECT * FROM videos WHERE id = :id");
            $query->bindParam(":id", $input);
            $query->execute();
            $this->sqlData = $query->fetch(PDO::FETCH_ASSOC);
        }
                
    }

}
?>