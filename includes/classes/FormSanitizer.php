<?php
  
  class FormSanitizer{
    public static function sanitizingFormString($inputString){
        $inputString  = strip_tags($inputString);
        $inputString =  str_replace(" " , "", $inputString);
        $inputString = strtolower($inputString);
        $inputString= ucfirst($inputString);
  
        return $inputString;
    }

    public static function sanitizingFormUser($inputString){
      $inputString  = strip_tags($inputString);
      $inputString =  str_replace(" " , "", $inputString);

      return $inputString;
  }

  public static function sanitizingFormEmail($inputString){
    $inputString  = strip_tags($inputString);
    $inputString =  str_replace(" " , "", $inputString);
    
    return $inputString;
}

    public static function sanitizingFormPassword($inputString){
      $inputString  = strip_tags($inputString);

      return $inputString;
    }



  } 
?>
