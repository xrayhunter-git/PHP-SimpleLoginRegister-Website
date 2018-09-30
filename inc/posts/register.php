<?php 
require_once '../../core/init.php';

if(InputValidation::exists())
{
    if(Token::check('register'))
    {
        $validate = new InputValidation(Config::get('mysql'));
        $check = $validate->check($_POST, array(
            'username' => array(
                'required' => true,
                'min' => 2,
                'max' => 32,
                'unique' => array(
                    'table' => 'users',
                    'where' => array(
                        'username', '=', '?'
                    )
                )
            ),
            'password' => array(
                'required' => true,
                'min' => 2,
            ),
            'cpassword' => array(
                'required' => true,
                'matches' => 'password'
            ),
            'email' => array(
                'required' => true,
                'min' => 2,
                'unique' => array(
                    'table' => 'users',
                    'where' => array(
                        'email', '=', '?'
                    )
                )
            ),
            'cemail' => array(
                'required' => true,
                'matches' => 'email'
            ),
        ));

        if($check->hasPassed())
        {
            $user = new User(Config::get('mysql'));

            $salt = Hash::salt(32);
            $authIPAddresses = array();
            array_push($authIPAddresses, grabClientIPAddress());

            try
            {
                $user->create(array(
                    'username' => InputValidation::get('username'),
                    'password' => Hash::make(InputValidation::get('password'), $salt),
                    'salt' => $salt,
                    'email' => InputValidation::get('email'),
                    'legalName' => '',
                    'AuthIPAddresses' => json_encode($authIPAddresses),
                    'authorizationCode' => Hash::unique(),
                    'registrationDate' => date('Y-m-d H:i:s')
                ));
            }
            catch(Exception $e)
            {
                die($e->getMessage());
            }
        }
        else
        {
            print_r($check->getErrors());
        }
    }
    else
    {
        
        echo 'Attempted CSRF Attack <br/>';
        echo Session::get('Token_register') . " | " . InputValidation::get('Token_register');
    }
}
else
{
    echo 'Critical Error or attack';
}