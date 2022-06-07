<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Document</title>
</head>
<body>
    

<?php

require_once 'core/init.php';

if(Session::exists('home')){


    echo '<p>' . Session::flash('home') . '</p>';
}


$user = new User();//current user
if($user->isLoggedIn()){

?>


<p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username);   ?>"><?php echo escape($user->data()->username); ?></a>!</p>

<ul>
    <li><a href="logout.php">Log out</a></li>
    <li><a href="update.php">Update details</a></li>
    <li><a href="changepassword.php">Change password</a></li>

</ul>

<?php

//if user is admin on this page
if($user->hasPermission('admin')){

    echo '<p>You are an administrator!</p>';

}
}else{

    echo '<div class="content">';
    echo '<p>You need to <a href="login.php"> log in </a> or <a href="register.php"> register </a></p>';
    echo '</div>';
}

?>

</body>
</html>



<?php
//userInsert = DB::getInstance()->update('users', 5 ,array(
    
   // 'password' => 'newpassword',
    //'name' => 'Tarik Terzo'


//));




/*
$userInsert = DB::getInstance()->insert('users', array(
    
    'username' => 'dale',
    'password' => 'password',
    'salt' => 'salt',
    'name' => 'tarik',
    'joined' => '2022-02-22-15:19:3',
    'group' => '1'


));




$user = DB::getInstance()->get('users', array('username', '=', 'alex'));

if(!$user->count()){


    echo "No user";

}else{

    echo $user->first()->username;


}

*/




















?>