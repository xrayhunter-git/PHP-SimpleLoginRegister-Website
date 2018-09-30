<?php
    require_once 'core/init.php';
    $user = null;
    if (!$username = InputValidation::get('user'))
        Redirect::to('index.php');
    else
    {
        $user = new User(Config::get('mysql'), $username);
        if (!$user->exists())
        {
            Redirect::to(404);
        }
    }

    include_once 'inc/placeholders/languageSetup.php';
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
        include_once __DIR__.'/inc/placeholders/home_navbar.php';
    ?>
    
    <!-- Where to place content [START] -->
    <div class='container justify-content-center'>
            <div class="card ">
                <img class="card-img-top" src="<?php echo Config::get('website'); ?>res/imgs/default_profile.png" alt="">
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $user->getData()->username; ?></h6>
                <div class="card-body">
                    <p class="card-text">
                        <h3>Bio:</h3><hr/>
                        <?php echo $user->getData()->bio; ?>
                    </p>
                </div>
            </div>
    </div>

    <!-- Where to place content [END] -->

    <?php 
        include_once __DIR__.'/inc/placeholders/home_footer.php';
    ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>