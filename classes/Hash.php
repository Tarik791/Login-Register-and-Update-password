<?php 

class Hash{

    //make hash
    public static function make($string, $salt = ''){

        return hash('sha256', $string . $salt);

    }

    //make salt(add salt and check if hash same like password tekst)
    public static function salt($length)
    {
     return bin2hex(random_bytes($length));
     
    }

    //unique hash
    public static function unique(){

        return self::make(uniqid());


    }


}