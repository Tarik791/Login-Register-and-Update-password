<?php 
//ovo će biti uključeno za svaku stranicu koju kreiramo
session_start();

//Globals arrays
$GLOBALS['config'] = array(

    'mysql' => array(
        
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'application',


    ),
    'remember' => array(

        'cookie_name' => 'hash',
        'cookie_expiry' => 604800

    ),
    'session' => array(

        'session_name' => 'user',
        'token_name' => 'token'

    )

);


//include all from folder classes
spl_autoload_register(function($class) {

    require_once 'classes/' . $class . '.php';

});

require_once 'functions/sanitize.php';


if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists((Config::get('session/session_name')))){

    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));

    if($hashCheck->count()){
        echo $hashCheck->first()->user_id;
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }

}



