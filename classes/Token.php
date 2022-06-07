<?php
//uniqid generiše jedinsteni id na osnovu mikrovremena(treutnog vremena u mikrosekundama)

class Token{

    //Generate token
    public static function generate(){

        //hash token
        return Session::put(Config::get('session/token_name'), md5(uniqid()));


    }

    //cdoes this token exist in session
    public static function check($token){

        $tokenName = Config::get('session/token_name');

        if(Session::exists($tokenName) && $token === Session::get($tokenName)){

            Session::delete($tokenName);
            return true;
        }

        

        return false;

    }

}