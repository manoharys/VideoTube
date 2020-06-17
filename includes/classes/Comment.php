<?php 
   require_once("ButtonProvider.php");
   class Comment{
       private $conn, $sqlData, $userLoggedInObj, $videoId;

       public function __construct($conn, $input, $userLoggedInObj, $videoId){

          if(!is_array($input)){
              $query = $conn->prepare("SELECT * FROM comments where id = :id");
              $query->bindParam(":id",$input);
              $query->execute();

              $input = $query->fetch(PDO::FETCH_ASSOC);
          }

          $this->sqlData = $input;
          $this->conn = $conn;
          $this->userLoggedInObj = $userLoggedInObj;
          $this->videoId = $videoId;
       }

       public function create(){
           $body = $this->sqlData["body"];
           $postedBy = $this->sqlData["postedBy"];
           $profileButton = ButtonProvider::createProfileButton($this->conn, $postedBy);
           $timespan = ""; //TODO : get timespan

           return "
                 <div class = 'itemContainer'>
                    <div class = 'comment'>
                      $profileButton
                        <div class = 'mainContainer'>
                            <div class='commentHeader'>
                               <a href='profile.php?username=$postedBy'>
                                    <span class = 'username'>$postedBy</span>
                               </a>
                               <span class = 'timestamp'>$timespan</span>
                            </div>

                            <div class = 'body'>
                              $body
                            </div>
                        </div>
                    </div>
                 </div>
              
              ";
       }
   }

?>