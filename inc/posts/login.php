<?php
require_once '../../core/init.php';
include_once '../placeholders/languageSetup.php';
$check = null;
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
            
            if ($user->loginCheck(InputValidation::get('username'), InputValidation::get('password')))
            {
                $verified = $user->isVerified(InputValidation::get('username'));
                if ($verified)
                {
                    $auth = $user->hasAuthorization(InputValidation::get('username'));
                    if ($auth)
                    {
                        $remember = (InputValidation::get('remember') == 'Yes');
                        $login = $user->login(InputValidation::get('username'), InputValidation::get('password'), $remember);

                        if ($login)
                        {
                            Session::flash('login_message', 'login_success');
                            Redirect::to("../../index.php");
                        }
                    }
                    else
                    {
                        $check->addError($langue->getDialog($lang, 'login_failed_noauth'));
                    }
                }
                else
                {
                    $check->addError($langue->getDialog($lang, 'login_failed_notverified'));
                }
            }
            else
            {
                $check->addError($langue->getDialog($lang, 'login_failed_badlogin'));
            }
        }
    }
    else
    {
        echo 'Forgry attack!';
        echo Session::get('Token_login') . " | " . InputValidation::get('Token_login');
    }
}
else
{
    echo 'No entries';
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
                    <h5 class="card-title text-center"><?php echo $langue->getDialog($lang, "login"); ?> </h5>
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
                    <?php echo $langue->getDialog($lang, "login_dialog"); ?> 
                    <hr/>
                    <form action='login.php' method='POST'>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name='username' placeholder="<?php echo $langue->getDialog($lang, "login_username"); ?>/<?php echo $langue->getDialog($lang, "login_email"); ?> " />
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" name='password' placeholder="<?php echo $langue->getDialog($lang, "login_password"); ?> " />
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name='remember' value="Yes" id="remember">
                            <label class="form-check-label" for="remember">
                                <?php echo $langue->getDialog($lang, "remember_me"); ?> <br/>
                            </label>
                        </div>
                        <?php echo Token::generate('login'); ?>
                        <button type="submit" class="btn btn-primary mb-2"><?php echo $langue->getDialog($lang, "login"); ?> </button>
                    </form>
                    <hr/>
                    <?php echo $langue->getDialog($lang, "login_help"); ?> <br/> 
                    <a href="#"><?php echo $langue->getDialog($lang, "login_help_link"); ?> </a> <br/>
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