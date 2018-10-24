<?php
    require_once 'core/init.php';
    $profile = null;
    if (!$username = InputValidation::get('user'))
        Redirect::to('index.php');
    else
    {
        $profile = new User(Config::get('mysql'), $username);
        if (!$profile || !$profile->exists())
            Redirect::to(404);
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
    <link rel="stylesheet" href="<?php echo Config::get('website');?>res/css/userprofile.css">
  </head>
  <body>
    <?php 
        include_once __DIR__.'/inc/placeholders/home_navbar.php';
    ?>
    
    <!-- Where to place content [START] -->
    <div class='container justify-content-center'>
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <img class="user" src="<?php echo Config::get('website'); ?>res/imgs/default_profile.png" alt="">
                        </div>
                        <div class="col-md">
                            <h4 class="mb-2"><?php echo str_upperfirst($profile->getData()->username); ?></h4>
                            <h6 class="mb-2 text-muted"><?php echo str_upperfirst($profile->getUserGroup($profile->getData()->username)->name); ?></h6>
                            <hr/>
                            <span class="expandableText"><?php echo $profile->getData()->bio; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body" style="min-height: 50vh;">
                
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
    <script src="<?php echo Config::get('website');?>res/js/jQuery_readmore.js"></script>
  </body>
</html>