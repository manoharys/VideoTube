<?php 
  class ButtonProvider{

    public static function createButton($text, $imageSrc, $action, $class){
        $image = ($imageSrc == null) ? "" : $imageSrc;
        return "
            <button class = $class >
            $image
            <span class='text'>$text</span> 
            </button>
            "
            ;

    }
  }

?>