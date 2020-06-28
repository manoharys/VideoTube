<?php
class SettingsFormProvider {

    public function createUserDetailsForm() {
        $firstNameInput = $this->createFirstNameInput(null);
        $lastNameInput = $this->createLastNameInput(null);
        $emailInput = $this->createEmailInput(null);
        $saveButton = $this->createSaveUserDetailsButton();

        return "<form action='processing.php' method='POST' enctype='multipart/form-data'>
                    $firstNameInput
                    $lastNameInput
                    $emailInput
                    $saveButton
                </form>";
    }

    private function createFirstNameInput($value) {
        if($value == null) $value = "";
        return "<div class='form-group'>
                    <input class='form-control' type='text' placeholder='First name' name='firstName' value='$value' required>
                </div>";
    }

    private function createLastNameInput($value) {
        if($value == null) $value = "";
        return "<div class='form-group'>
                    <input class='form-control' type='text' placeholder='Last name' name='lastName' value='$value' required>
                </div>";
    }

    private function createEmailInput($value) {
        if($value == null) $value = "";
        return "<div class='form-group'>
                    <input class='form-control' type='email' placeholder='Email' name='email' value='$value' required>
                </div>";
    }

    private function createSaveUserDetailsButton() {
        return "<button type='submit' class='btn btn-primary' name='saveDetailsButton'>Save</button>";
    }
}
?>