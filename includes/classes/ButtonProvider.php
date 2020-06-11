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

    public static function createProfileButton($conn, $uploadedBy){
      $userObj = new User($conn, $uploadedBy);
      $profilePic = $userObj->getUserProfilePic();
      $link = "profile.php?username=$uploadedBy";

      return "
              <a href = '$link'>
                <img src = '$profilePic'>
              </a>
            ";
    }
  }

?>