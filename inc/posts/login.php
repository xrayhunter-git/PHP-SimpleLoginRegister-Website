<?php
require_once '../../core/init.php';

if(InputValidation::exists())
{
    if(Token::check('login'))
    {
        $validate = new InputValidation(Config::get('mysql'));
        $check = $validate->check($_POST, array(
            'username' => array(
                'required' => true
            ),
            'password' => array(
                'required' => true
            )
        ));

        if($check->hasPassed())
        {
            $user = new User(Config::get('mysql'));
            $remember = (InputValidation::get('remember') == 'Yes');
            $login = $user->login(InputValidation::get('username'), InputValidation::get('password'), $remember);

            if ($login)
            {
                Session::flash('login_message', 'login_success');
                Redirect::to("../../index.php");
            }
            else
            {
                echo 'Failed';
            }
        }
        else
        {
            foreach($check->getErrors() as $error)
            {
                echo $error . "<br/>";
            }
        }
    }
    else
    {
        echo 'Attempted CSRF Attack <br/>';
        echo Session::get('Token_login') . " | " . InputValidation::get('Token_login');
    }
}
else
{
    echo 'Failed Validation';
}