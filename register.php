
<?php

require_once 'core/init.php';



if(Input::exists()){

    if(Token::check(Input::get('token'))){



    $validate = new Validate();
    $validation = $validate->check($_POST, array(

        'username' => array(

            'required' => true,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'

        ),
        'password' => array(
            'required' => true,
            'min' => 6


        ),
        'password_again' => array(
            
            'required' => true,
            'matches' => 'password'
 
        ),
        'name' => array(

            'required' => true,
            'min' => 2,
            'max' => 50

        ),


    ));

    //if is successful registration
    if($validate->passed()){
        $user = new User();


       $salt = Hash::salt(32);
        
        try{

            $user->create(array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password'), $salt),
                //u prazno polje bi trebao dodati $salt, ali izbacuje grešku
                'salt' => $salt,
                'name' => Input::get('name'),
                'joined' => date('Y-m-d H:i:s'),
                'group' => 1

            ));

            //first we write when we can see message
            Session::flash('home', 'You have been registered and can now log in!');
            Redirect::to('index.php');


        }catch(Exception $e){
            die($e->getMessage());
        
        }
        
    }else{

        //errors
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Document</title>
</head>
<style>

    
    
</style>
<body>



<div class="wrapper">





<form action="" method="post">


    <div class="form">

    <div class="title">
        <h2>Registration Form!</h2>
    </div>
        <div class="field">
            <label for="username">Username</label>
            <br>
            <input class="input" type="text" name="username" id="username" value="<?php echo escape(Input::get('username')); ?>"  autofocus>
        </div>


        <br>
        <div class="field">
            <label for="password">Choose a password</label>
            <br>
            <input class="input" type="password" name="password" id="password">
        </div>
        <br>
        <div class="field">
            <label for="password_again">Enter your password again</label>
            <br>
            <input class="input" type="password" name="password_again" id="password_again">
        </div>
        <br>

        <div class="field">
            <label for="name">Your name</label>
            <br>
            <input class="input" type="text" name="name" value="<?php echo escape(Input::get('name')); ?>" id="name">
        </div>
        <br>

        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <div class="field">

        <input class="btnn" type="submit" value="Register">

        </div>
        <br>
        <a style="text-decoration:none;" href="login.php">Click to Login! If you have account!</a>
    </div>
</form>

</div>

</body>
</html>