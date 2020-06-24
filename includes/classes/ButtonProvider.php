<?php 
  class ButtonProvider{

    public static function createButton($text, $imageSrc, $action, $class){
        $image = ($imageSrc == null) ? "" : "<img src=$imageSrc>";
        
        // Change action if needed.
        return "
            <button class = '$class' onclick = '$action' >
               $image
            <span class='text'>$text</span> 
            </button>
            "
            ;

    }

    
    public static function createHyperlinkButton($text, $imageSrc, $href, $class){
      $image = ($imageSrc == null) ? "" : "<img src=$imageSrc>";
      
      // Change action if needed.
      return "
      <a href='$href'>
          <button class = '$class'  >
             $image
            <span class='text'>$text</span> 
          </button>
      </a>    
          "
          ;

  }

    public static function createProfileButton($conn, $uploadedBy){
      $userObj = new User($conn, $uploadedBy);
      $profilePic = $userObj->getUserProfilePic();
      $link = "profile.php?username=$uploadedBy";

      return "
              <a href = '$link'>
                <img src = '$profilePic' class='profilePicture' >
              </a>
            ";
    }

     public static function createEditButton($videoId){
       $href = "editVideo.php?videoId=$videoId";

       $button = ButtonProvider::createHyperlinkButton("EDIT VIDEO", null, $href, "edit button");

       return "<div class='editVideoButtonContainer'>
                 $button
               </div>";
     }

     public static function createSubscriberButton($conn, $userToObj, $userLoggedInObj){
           $userTo = $userToObj->getUsername();
           $userLoggedIn = $userLoggedInObj->getUsername();

           $isSubscribedTo = $userLoggedInObj->isSubscribedTo($userTo);
           $buttonText = $isSubscribedTo ? "SUBSCRIBED" : "SUBSCRIBE";
           $buttonText .=" ". $userToObj->getSubscriberCount(); 
           
           $buttonClass = $isSubscribedTo ? "unsubscribe button" : "subscribe button";
           $action = "subscribe(\"$userTo\", \"$userLoggedIn\", this)";

           $button = ButtonProvider::createButton($buttonText, null, $action, $buttonClass);

           return "<div class = subscribeButtonContainer>
                     $button
                   </div>";
     }

         
    public static function createUserProfileNavigationButton($conn, $username) {
      if(User::isLoggedIn()) {
          return ButtonProvider::createProfileButton($conn, $username);
      }
      else {
          return "<a href='signIn.php'>
                      <span class='signInLink'>SIGN IN</span>
                  </a>";
      }
  }

  }

?>