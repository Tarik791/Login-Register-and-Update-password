<?php 

require_once 'core/init.php';


$user = new User();

//if is not user logged in(Redirect)
if(!$user->isLoggedIn()){
    
    Redirect::to('index.php');
}


//if input exists
if(Input::exists()){

    //if token exists
    if(Token::check(Input::get('token'))){

        //valdiation for input field
        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            
            'password_current' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new' => array(
                'required' => true,
                'min' => 6
            ),
            'password_new_again' => array(
                'required' => true,
                'min' => 6,
                'matches' => 'password_new'
            )

        ));

        //$errorrs = '';

        //successfull validation, or not
        if($validation->passed()){
            //change of password

            if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password){

                //$errorrs = 'Your current password is wrong';
                echo 'Your current password is wrong';

            }else{


                $salt = Hash::salt(32);
                $user->update(array(
                    'password' => Hash::make(Input::get('password_new'), $salt), 
                    'salt' => $salt
                ));

                Session::flash('home', 'Your password has been changed!');
                Redirect::to('index.php');

            }

        }else{

            foreach ($validation->errors() as $error) {
                # code...
                echo $error, '<br>';
            }

        }

    }

}

?>



<form action="" method="post">


    <div class="field">
        <label for="password_current">Current Password</label>
        <input type="password" name="password_current" id="password_current">
    </div>

    <div class="field">
        <label for="password_new">New Password</label>
        <input type="password" name="password_new" id="password_new">
    </div>

    <div class="field">
        <label for="password_new_again">New Password Again</label>
        <input type="password" name="password_new_again" id="password_new_again">
    </div>

    <input type="hidden" name="token" id="token" value="<?php echo escape(Token::generate()); ?>">
    <input type="submit" value="Change Password">
</form>