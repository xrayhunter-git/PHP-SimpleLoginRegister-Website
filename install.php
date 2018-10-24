
<?php
    require_once 'core/init.php';
    if (file_exists(__DIR__.'/config.php') && !InputValidation::exists())
        Redirect::to("index.php");

    $check = null;
    $page = 0;
    if (InputValidation::exists())
    {
        if (InputValidation::submitted("InstallNow"))
        {
            $validate = new InputValidation(null);
            $check = $validate->check($_POST, array(
                'sqlhost' => array(
                    'required' => true,
                ),
                'sqlhostport' => array(
                    'required' => true,
                ),
                'sqlusername' => array(
                    'required' => true,
                ),
                'sqldatabase' => array(
                    'required' => true,
                ),
                'weburl' => array(
                    'required' => true,
                )
            ));

            if($check->hasPassed())
            {
                $page = 1;
                $file = fopen('config.php', 'w') or die('Critical Error occured, wasn\'t able to create the configuration php file. Check your file perms.');
                $data = '
                    <?php
                    $GLOBALS[\'config\'] = array(
                        \'mysql\' => array(
                            \'type\' => \''. InputValidation::get('sqlprotocol') .'\', // Optional [Defaults: PDO]
                            \'sql_ip\' => \''. InputValidation::get('sqlhost') .'\', // Required
                            \'sql_port\' => '. InputValidation::get('sqlhostport') .', // Required
                            \'sql_user\' => \''. InputValidation::get('sqlusername') .'\', // Required
                            \'sql_pass\' => \''. InputValidation::get('sqlpassword') .'\', // Required
                            \'sql_db\' => \''. InputValidation::get('sqldatabase') .'\' // Optional
                        ),
                        \'website\' => \''. InputValidation::get('weburl') .'\'
                    );
                ';
                fwrite($file, $data);
            }
        }
        elseif (InputValidation::submitted('retryDBInstall'))
            $page = 1;
        elseif (InputValidation::submitted("adminSetup"))
            $page = 2;
        elseif(InputValidation::submitted("Finished"))
        {
            $page = 2;
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
                )
            ));

            if($check->hasPassed())
            {
                $user = new User(Config::get('mysql'));

                $salt = Hash::salt(32);
                $authIPAddresses = array();
                array_push($authIPAddresses, grabClientIPAddress());

                try
                {
                    //echo Hash::make(InputValidation::get('password'), $salt), " ", InputValidation::get('password'), " ", $salt, "<br/>";
                    if(!$user->create(array(
                        'username' => InputValidation::get('username'),
                        'password' => Hash::make(InputValidation::get('password'), $salt),
                        'salt' => $salt,
                        'email' => InputValidation::get('email'),
                        'legalName' => '',
                        'AuthIPAddresses' => json_encode($authIPAddresses),
                        'authorizationCode' => Hash::unique(),
                        'authorized' => '1',
                        'registrationDate' => date('Y-m-d H:i:s')
                    )))
                    {
                        $check->addError("Sorry, the username that you were going to use already exists!");
                    }
                    else
                    {
                        //echo Hash::make(InputValidation::get('password'), $user->getData()->salt), ' ', $user->getData()->salt;
                        if($group = $user->getDB()->get('groups', array()))
                        {
                            if(!$q = $user->getDB()->insert('users_groups', array(
                                'user_id' => $user->getData()->id,
                                'group_id' => $group->getLast()->id,
                                'primary' => '1',
                                'createdDate' => date('Y-m-d H:i:s')
                            )))
                            {
                                $check->addError('Error occured trying to add Admin account to the Highest group in the database.');
                            }
                        }
                        else
                        {
                            $check->addError('Error occured on finding highest Ranking Group.');
                        }
                    }
                }
                catch(Exception $e)
                {
                    $check->addError("Sorry, we failed on creating your account there was an internal error.");
                    if (isset($_GET['debug']))
                        $check->addError($e->getMessage());
                }

               if($check->hasPassed())
                    Redirect::to('index.php');
            }
        }
    }

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.css">
  </head>
  <body style="background-color: #3A606E;">
    <nav class="navbar navbar-expand navbar-light" style="background-color: #101A1E;">
        <ul class="nav navbar-nav">
            <li class="nav-item active">
                <h1 style="color: white;">Website SQL Installation</h1>
            </li>
        </ul>
    </nav>
    <?php 
        // Display errors.
        if ($check)
        {
            foreach($check->getErrors() as $error)
            {
                ?>
                    <div class="alert alert-danger text-center " style="margin: 5px 75vh; min-width: 25vh;" role="alert">
                    <?php echo $error; ?>
                    </div>
                <?php
            }
        }

        if ($page == 0)
        {
    ?>
    <div class="card" style="margin: 0px 50vh; min-width: 50vh;">
        <div class="card-body">
            <form action="install.php" method="post">
                <h3>SQL Configurations:</h3>
                <hr/>
                <div class="form-group">
                    <label for="">SQL Server Address <span style="color: red;">*</span></label>
                    <input type="text" name="sqlhost" class="form-control" placeholder="127.0.0.1" aria-describedby="helpSQLHost">
                    <small id="helpSQLHost" class="text-muted">This is will tell the configuration of SQL, how to connect to the SQL Server.</small>
                    <br/>
                    <label for="">SQL Server Port Address <span style="color: red;">*</span></label>
                    <input type="text" name="sqlhostport" class="form-control" placeholder="3306" aria-describedby="helpSQLHostPort">
                    <small id="helpSQLHostPort" class="text-muted">This tells the SQL libraries, which port to talk to the SQL Server.</small>
                    <br/>
                    <label for="">SQL Username <span style="color: red;">*</span></label>
                    <input type="text" name="sqlusername" class="form-control" placeholder="root" aria-describedby="helpSQLUser">
                    <small id="helpSQLUser" class="text-muted">This will allow you to have access to the access point on the SQL server.</small>
                    <br/>
                    <label for="">SQL Password</label>
                    <input type="password" name="sqlpassword" class="form-control" placeholder="" aria-describedby="helpSQLPassword">
                    <small id="helpSQLPassword" class="text-muted">The password to your access point on the SQL Server.</small>
                    <br/>
                    <label for="">SQL Database Name <span style="color: red;">*</span></label>
                    <input type="text" name="sqldatabase" class="form-control" placeholder="" aria-describedby="helpSQLDatabase">
                    <small id="helpSQLDatabase" class="text-muted">The Database where the SQL server will store the data.</small>

                    <div class="form-group">
                        <label for="">SQL Library Protocol </label>
                        <select class="form-control" name="sqlprotocol" aria-describedby="helpSQLProtocol">
                            <option value="pdo">Use PDO</option>
                            <option value='mysqli'>Use MySQLi</option>
                        </select>
                        <small id="helpSQLProtocol" class="text-muted">The library protocol tells the SQL Library, how it will talk to the SQL server.</small>
                    </div>
                </div>
                
                <h3>Web Configurations:</h3>
                <hr/>
                <div class="form-group">
                    <label for="">Web URL - Home <span style="color: red;">*</span></label>
                    <input type="text" name="weburl" class="form-control" placeholder="https://www.example.com/" aria-describedby="helpWebURL">
                    <small id="helpWebURL" class="text-muted">This is where the main page is.</small>
                </div>

                <?php echo Token::generate('installNow'); ?>
                <button type="submit" name="InstallNow" class="btn btn-light">Continue</button>
            </form>
        </div>
    </div>
    <?php 
        }
        elseif($page == 1)
        {
            if (file_exists('config.php'))
                include_once('config.php');
            else
                die('Critical Error, couldn\'t access config.php!');
    ?>
    <div id="accordion">
        <?php
            $dbinstall = DBInstaller::create(Config::get('mysql'));

            $dbinstall->addPackage(new UsersDB());
            $execution = $dbinstall->execute();
            $x = 0;
            foreach($execution->getExecutions() as $instance)
            {
            ?>
                <div class="card border-<?php echo ($instance->hasErrors() ? 'danger' : 'success') ?>">
                    <div class="card-header" id="heading<?php echo $x; ?>">
                        <h5 class="">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse<?php echo $x; ?>" aria-expanded="true" aria-controls="collapse<?php echo $x; ?>">
                                Execution <?php echo ($instance->hasErrors() ? 'wasn\'t successful' : 'successful') ?>: <br/>
                            </button>
                        </h5>
                    </div>

                    <div id="collapse<?php echo $x; ?>" class="collapse" aria-labelledby="heading<?php echo $x; ?>" data-parent="#accordion">
                        <div class="card-body">
                            <?php echo $instance->getOpenSQL(); ?> <br/><hr/>
                            <?php
                                if($instance->hasErrors())
                                {
                                    foreach($instance->getErrors() as $error)
                                    {
                                        echo $error['message'] . "<br/>";
                                    }
                                }
                                else
                                {
                                    echo 'No Errors occured!<br/>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
                $x++;
            }
            if ($execution->hasErrors())
            {
                ?>
                <div class="card border-danger">
                    <div class="card-header" id="headingSummary">
                        <h5 class="">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSummary" aria-expanded="true" aria-controls="collapseSummary">
                                Execution Error Summary
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSummary" class="collapse" aria-labelledby="headingSummary" data-parent="#accordion">
                        <?php
                            foreach($execution->getErrors() as $error)
                            {
                                var_dump($error);
                            }
                        ?>
                    </div>
                </div>
                <?php
            }
        ?>
        <form action="install.php" method="post">
            <?php echo Token::generate('adminSetup'); ?>
            
            <?php
                if ($execution->hasErrors())
                {
                    ?><button type="submit" name="retryDBInstall" class="btn btn-light">Retry</button><?php
                }
                else
                {
                    ?><button type="submit" name="adminSetup" class="btn btn-light">Continue</button><?php
                }
            ?>
            
        </form>
    </div>
    <?php 
        }
        else
        {
            ?>
            <div class="card justify-content-center" style="margin: 0px 50vh">
                <div class="card-body">
                    <form action="install.php" method="post">
                        <h3>Admin Account:</h3>
                        <hr/>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Username" />
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" class="form-control" placeholder="Password" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password" />
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control" placeholder="E-Mail" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope-open"></i></span>
                                    </div>
                                    <input type="email" name="cemail" class="form-control" placeholder="Confirm E-Mail" />
                                </div>
                            </div>
                        </div>
                        <?php echo Token::generate('Finished'); ?>
                        <button type="submit" name="Finished" class="btn btn-light">Finish</button>
                    </form>
                </div>
            </div>
            
            <?php
        }
    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.1.1/js/all.js" integrity="sha384-BtvRZcyfv4r0x/phJt9Y9HhnN5ur1Z+kZbKVgzVBAlQZX4jvAuImlIz+bG7TS00a" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
  </body>
</html>