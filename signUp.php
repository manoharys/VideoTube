<?php 
  require_once("includes/config.php");
  require_once("includes/classes/Account.php");
  require_once("includes/classes/Constants.php");
  require_once("includes/classes/FormSanitizer.php");
 

  $account = new Account($conn);

  if(isset($_POST["submitButton"])){
      
      
      //firstName & lastName
      $firstName = FormSanitizer::sanitizingFormString($_POST["firstName"]);
      $lastName = FormSanitizer::sanitizingFormString($_POST["lastName"]);
  
      //Username
      $username = FormSanitizer::sanitizingFormUser($_POST["username"]);

      //emails
      $email = FormSanitizer::sanitizingFormEmail($_POST["email"]);
      $email2 = FormSanitizer::sanitizingFormEmail($_POST["email2"]);

      //password
      $password = FormSanitizer::sanitizingFormPassword($_POST["password"]);
      $password2 = FormSanitizer::sanitizingFormPassword($_POST["password2"]);
     
     $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
      
     if($wasSuccessful){
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
     }
     else{
       echo "login failed";
     }
  }

     function getInputValues($name){
       if(isset($_POST[$name])){
           echo $_POST[$name];
       }
     }
  
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoTube</title>
    <!-- favicon -->
    <link href="assets/images/icons/favicon2.jpg" rel="icon">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./assets/CSS/style.css">

    <!-- Jquery CDN-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net</br>pm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <img src="./assets/images/icons/VideoTubeLogo.png" title="VideoTube home" alt="site-logo">
                <h3>Sign Up</h3>
                <span>to continue to VideoTube</span>
            </div>
            <div class="loginForm">
                <form action="signUp.php" method="POST">
                   <!-- displaying error message if any -->
                   <?php 
                     echo $account->getError(Constants::$firstNameCharacter);
                   ?>
                   <input type="text" name="firstName" placeholder="first name" autocomplete='off' value="<?php getInputValues('firstName') ?>" required>

                   
                   <!-- displaying error message if any -->
                   <?php 
                     echo $account->getError(Constants::$lastNameCharacter);
                   ?>
                   <input type="text" name="lastName" placeholder="last name" autocomplete='off' value="<?php getInputValues('lastName') ?>" required>

                   <!-- displaying error message if any -->
                   <?php 
                     echo $account->getError(Constants::$usernameCharacter);
                     echo $account->getError(Constants::$usernameTaken); 
                   ?>
                   <input type="text" name="username" placeholder="User name" autocomplete='off' value="<?php getInputValues('username') ?>" required>

                   <!-- displaying error message if any -->
                   <?php 
                     echo $account->getError(Constants::$emailDoNotMatch);
                     echo $account->getError(Constants::$emailTaken); 
                   ?>
                   <input type="email" name="email" placeholder="email" autocomplete='off' value="<?php getInputValues('email') ?>" required>
                   <input type="email" name="email2" placeholder="confirm email" autocomplete='off' value="<?php getInputValues('email2') ?>" required>

                    <!-- displaying error message if any -->
                    <?php 
                     echo $account->getError(Constants::$passwordDoNotMatch);
                     echo $account->getError(Constants::$passwordNotAlphaNumeric); 
                     echo $account->getError(Constants::$passwordLength); 
                   ?>
                   <input type="password" name="password" placeholder="password" autocomplete='off' required>
                   <input type="password" name="password2" placeholder="password" autocomplete='off' required>
                   
                   <input type="submit" class="btn btn-primary" name="submitButton" value="SUBMIT">

                </form>
            </div>
            <a href="signIn.php" class="loginMessage">Already have an account? Sign in here!</a>
        </div>
    </div>
</body>

</html>