<?php 
require_once '../../core/init.php';
$check = null;
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
                'regex' => '/[^A-Za-z0-9]/',
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
                if(!$user->create(array(
                    'username' => InputValidation::get('username'),
                    'password' => Hash::make(InputValidation::get('password'), $salt),
                    'salt' => $salt,
                    'email' => InputValidation::get('email'),
                    'legalName' => '',
                    'AuthIPAddresses' => json_encode($authIPAddresses),
                    'authorizationCode' => Hash::unique(),
                    'registrationDate' => date('Y-m-d H:i:s')
                )))
                {
                    $check->addError("Sorry, the username that you were going to use already exists!");
                }
            }
            catch(Exception $e)
            {
                $check->addError("Sorry, we failed on creating your account there was an internal error.");
                if (isset($_GET['debug']))
                    echo ($e->getMessage());
            }
        }
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Multi-Langue Login/Registration with account page</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.css">
  </head>
  <body>
    <?php 
        include_once __DIR__.'/../../inc/placeholders/home_navbar.php';
    ?>
    
    <!-- Where to place content [START] -->
    <div class="row justify-content-center" style="margin: 10% 0px;">
        <div class="col col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title text-center"><?php echo $langue->getDialog($lang, "register"); ?></h5>
                </div>
                <div class="card-body">
                    <?php
                        // Display errors.
                        if ($check)
                        {
                            foreach($check->getErrors() as $error)
                            {
                                ?>
                                    <div class="alert alert-danger text-center" role="alert">
                                    <?php echo $error; ?>
                                    </div>
                                <?php
                            }
                        }
                    ?>
                    <?php echo $langue->getDialog($lang, "register_dialog"); ?><br/>
                    <hr/>
                    <form action="register.php" method="post">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="<?php echo $langue->getDialog($lang, "register_username"); ?>" />
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="<?php echo $langue->getDialog($lang, "login_password"); ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="cpassword" class="form-control" placeholder="<?php echo $langue->getDialog($lang, "login_cpassword"); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control" placeholder="<?php echo $langue->getDialog($lang, "login_email"); ?>" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                                    </div>
                                    <input type="email" name="cemail" class="form-control" placeholder="<?php echo $langue->getDialog($lang, "login_cemail"); ?>" />
                                </div>
                            </div>
                        </div>
                        <?php echo Token::generate('register'); ?>
                        <button type="submit" name="submit" class="btn btn-primary mb-2"><?php echo $langue->getDialog($lang, "register_btn"); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Where to place content [END] -->

    <?php 
        include_once __DIR__.'/../placeholders/home_footer.php';
    ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>