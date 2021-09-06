<?php

namespace app\core\form;

class Select{
    public static function begin(){
        echo sprintf('<select name="category">');
        return new Select();
    }

    public static function end(){
        echo '</select>';
    }
}