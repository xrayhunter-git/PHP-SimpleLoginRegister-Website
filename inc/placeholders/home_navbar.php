<?php
    require_once __DIR__.'/../../core/init.php';
    include_once __DIR__.'/languageSetup.php';

    $user = new User(Config::get('mysql'));
?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo Config::get('website'); ?>index.php"><?php echo $langue->getDialog($lang, "company") ?></a>

        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="<?php echo Config::get('website'); ?>index.php"><?php echo $langue->getDialog($lang, "home") ?> <span class="sr-only">(current)</span></a>
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
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="country">
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
                if(!$user->isLoggedIn())
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
                                    <form action='<?php echo Config::get('website'); ?>inc/posts/login.php' method='POST'>
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

                                <!-- Registration Tab -->
                                <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="pills-register-tab">
                                    <?php echo $langue->getDialog($lang, "register_dialog"); ?><br/>
                                    <hr/>
                                    <form action="<?php echo Config::get('website'); ?>inc/posts/register.php" method="post">
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
                                    <?php echo str_upperfirst($user->getData()->username); ?>
                                </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDrop">
                            <a class="dropdown-item" href="<?php echo Config::get('website'); ?>profile.php?user=<?php echo $user->getData()->username; ?>"><?php echo $langue->getDialog($lang, "account_profile"); ?></a>
                            <a class="dropdown-item" href="<?php echo Config::get('website'); ?>profile_settings.php"><?php echo $langue->getDialog($lang, "account_settings");?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo Config::get('website'); ?>/inc/posts/logout.php"><?php echo $langue->getDialog($lang, "account_logout");?></a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </nav>