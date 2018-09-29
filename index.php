<?php
    require_once 'core/init.php';
    $_SESSION['username'] = null;
    // Language Module
    $langue = Language::create('en');
    $langue->addLanguage(new Langue_EN());
    $langue->addLanguage(new Langue_FR());
    $lang = (isset($_GET['lang']) ? $_GET['lang'] : $langue->getBrowserLanguage());
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
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="#"><?php echo $langue->getDialog($lang, "company") ?></a>

        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#"><?php echo $langue->getDialog($lang, "home") ?> <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $langue->getDialog($lang, "store") ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><?php echo $langue->getDialog($lang, "contact_us") ?></a>
                </li>
            </ul>
            <!-- Button trigger modal -->
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle my-2 my-sm-0" type="button" id="country" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="flag-icon flag-icon-<?php echo $langue->getDialog($lang, "flag"); ?>"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="country">
                    <?php
                        $keys = array_keys($GLOBALS['languages']);
                        foreach($keys as $flag)
                        {
                            echo '<a class="dropdown-item" href="?lang='. $flag .'">
                                <span class="flag-icon flag-icon-'. $langue->getDialog($flag, "flag") .'"></span>
                            </a>';
                        }
                    ?>
                </div>
            </div>
            <?php
                if(!isset($_SESSION['username']))
                {
            ?>
            <button type="button" class="btn btn-inline btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#modelId">
                <?php echo $langue->getDialog($lang, "login") . '/' . $langue->getDialog($lang, "register"); ?> 
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modelTitleId"></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <ul class="nav nav-tabs nav-fill" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-login-tab" data-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-register-tab" data-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                
                                <!-- Login Tab -->
                                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                                    <?php echo $langue->getDialog($lang, "login_dialog"); ?> 
                                    <hr/>
                                    <form>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="<?php echo $langue->getDialog($lang, "login_username"); ?>/<?php echo $langue->getDialog($lang, "login_email"); ?> " />
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control" placeholder="<?php echo $langue->getDialog($lang, "login_password"); ?> " />
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="remembering">
                                            <label class="form-check-label" for="remembering">
                                                <?php echo $langue->getDialog($lang, "remember_me"); ?> <br/>
                                            </label>
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2"><?php echo $langue->getDialog($lang, "login"); ?> </button>
                                    </form>
                                    <hr/>
                                    <?php echo $langue->getDialog($lang, "login_help"); ?> <br/> 
                                    <a href="#"><?php echo $langue->getDialog($lang, "login_help_link"); ?> </a> <br/>
                                </div>
                                <!-- Registration Tab -->
                                <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
                                    <?php echo $langue->getDialog($lang, "register_dialog"); ?><br/>
                                    <hr/>
                                    <form action="" method="post">
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

                                        <button type="submit" name="submit" class="btn btn-primary mb-2"><?php echo $langue->getDialog($lang, "register_btn"); ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="#"><?php echo $langue->getDialog($lang, "login_privacy_policies"); ?></a>
                        </div>
                    </div>
                    <?php
                        }
                        else
                        {
                    ?>
                    <div class="dropdown">
                        <button class="btn btn-outline-success dropdown-toggle" type="button" id="accountDrop" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                    <?php echo $_SESSION['username']; ?>
                                </button>
                        <div class="dropdown-menu" aria-labelledby="accountDrop">
                            <a class="dropdown-item" href="profile.php?lang=<?php echo $lang; ?>"><?php echo $langue->getDialog($lang, "account_profile"); ?></a>
                            <a class="dropdown-item" href="profile_settings.php?lang=<?php echo $lang; ?>"><?php echo $langue->getDialog($lang, "account_settings");?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php?lang=<?php echo $lang; ?>"><?php echo $langue->getDialog($lang, "account_logout");?></a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Where to place content [START] -->

    <!-- Where to place content [END] -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>