<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/SettingsFormProvider.php");
require_once("includes/classes/Constants.php");

if(!User::isLoggedIn()) {
    header("Location: signIn.php");
}

$formProvider = new SettingsFormProvider();

if(isset($_POST["saveDetailsButton"])) {
    $accoiunt = new Account($con);

    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $email = FormSanitizer::sanitizeFormString($_POST["email"]);
}

if(isset($_POST["savePasswordButton"])) {
    
}
?>
<div class="settingsContainer column">

    <div class="formSection">
        <?php
            echo $formProvider->createUserDetailsForm(
                isset($_POST["firstName"]) ? $_POST["firstName"] : $userLoggedInObj->getUserFirstName(),
                isset($_POST["lastName"]) ? $_POST["lastName"] : $userLoggedInObj->getUserLastName(),
                isset($_POST["email"]) ? $_POST["email"] : $userLoggedInObj->getUserEmail()
            );
        ?>
    </div>

    <div class="formSection">
        <?php
            echo $formProvider->createPasswordForm();
        ?>
    </div>

</div>