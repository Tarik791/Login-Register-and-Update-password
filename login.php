<?php

require_once 'core/init.php';


if(Input::exists()){

    if(Token::check(Input::get('token'))){

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'username' => array('required' => true),
            'password' => array('required' => true)

        ));

        if($validation->passed()){
            //Log user in

            $user = new User();

            //if user click remember me, and true is
            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('username'), Input::get('password'), $remember);

            if($login){

                Redirect::to('index.php');
            }else{

                echo "<p style='text-align:center; color:red;'>Sorry, logging in failed.</p>";
            }

        }else{
            

            foreach($validation->errors() as $error){

                echo "<p style='text-align:center; color:red;'>" . $error . "</p>";

            }

        }

    }

}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="CSS/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="wrapper">


<form action="" method="post">


<div class="form">

<div class="title">
        <h2>Login Form!</h2>
    </div>

<div class="field">
    <label for="username">
        Username
    </label>
    <input class="input" type="text" name="username" id="username">

</div>

<div class="field">
    <label for="password">
        Password
    </label>
    <input  class="input" type="password" name="password" id="password">

</div>
<div class="field">
    <label for="remember">
        <input type="checkbox" name="remember" id="remember">Remember Me!
    </label>

</div>
<div class="field">

<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
<input class="btnn" type="submit" value="Log in">

</div>
</div>

</form>

</div>
</body>
</html>