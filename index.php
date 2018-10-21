<?php
    require_once 'core/init.php';

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

    <?php
        echo $langue->getDialog($lang, Session::flash('login_message'), isset($user->getData()->username) ? array('[name]' => ucfirst($user->getData()->username)) : array());
    ?>

    <div class="row" style="padding-left: 20px; min-height: 100vh;">
        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">News</h3>
                    <p class="card-text">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <span class="expandableText">
                                    <h5><a href="">ChangeLog #1.0.4</a></h5>
                                    <p class='text-muted'>Updated on: 10/21/18</p>
                                    <hr/>
                                    Updated Session Helper class. <br/>
                                    <ul>
                                        <li>Added Session ID Regeneration.</li>
                                    </ul>
                                    Updated User Class. <br/>
                                    <ul>
                                        <li>Added resecuring & verification features while using the account.</li>
                                        <li>Tidied the code a bit more.</li>
                                    </ul>
                                    Added String converting help functions to the function files. <br/>
                                    <ul>
                                        <li>str_shorten - shortens the text by the set params.</li>
                                        <li>str_upperfirst - Capalizes the first letter in the string.</li>
                                        <li>correctTime - Converts the integer to a string with the ending time (Ex: 5hrs).</li>
                                        <li>correctByteSize - Converts the bytes into a string readable for developers (Ex: 23kb).</li>
                                    </ul>
                                    Added Initial load time to Init Core File. <br/>
                                    Updated Templates. <br/>
                                    <ul>
                                        <li>Footer -> Added Website's Status.</li>
                                        <li>Navbar -> Added more linkage.</li>
                                    </ul>
                                    Updated Input Validation Helper class. <br/>
                                    <ul>
                                        <li>Added Regex matching.</li>
                                    </ul>
                                    Updated Registation Page. <br/>
                                    <ul>
                                        <li>Added requirements for more complex passwords.</li>
                                    </ul>
                                    Updated Profile. <br/>
                                    <ul>
                                        <li>Reorgnaized the UI for the profile.</li>
                                        <li>Fixed non-logged in user's errors, while viewing another person's profile.</li>
                                    </ul>
                                    Updated Index <br/>
                                    <ul>
                                        <li>Replaced the Placeholder text to the Changelogs under the news.</li>
                                        <li>Added the new JS and CSS Library of Readmore.</li>
                                    </ul>
                                    Updated English Language Dialog. <br/>
                                    Updated French Language Dialog. <br/>
                                    Added Internal StyleSheet. <br/>
                                    Added JQuery ReadMore Script. <br/>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <span class="expandableText">
                                    <h5><a href="https://github.com/xrayhunter/PHP-SimpleLoginRegister-Website/commit/d838d999e84294e3721aaef5bdcf1dafe9f95f05">ChangeLog #1.0.3</a></h5>
                                    <p class='text-muted'>Updated on: 9/30/18</p>
                                    <hr/>
                                    Updated Templates. <br/>
                                    <ul>
                                        <li>Footer no longer has it fixed to the bottom.</li>
                                        <li>Navbar was linked up a bit better.</li>
                                    </ul>
                                    Updated Account Login Policies. <br/>
                                    <ul>
                                        <li>The client must have the same IP Address as the whitelisted IP Addresses for that account.</li>
                                        <li>The account must be activated.</li>
                                        <li>Fixed the problem with Token's doing false positives on forgery attack detections.</li>
                                    </ul>
                                    Updated Index page. <br/>
                                    <ul>
                                        <li>Added placeholder text to space out the page.</li>
                                    </ul>
                                    Updated Token - Fix described in Login update. <br/>
                                    Updated User. <br/>
                                    <ul>
                                        <li>Expanded the functionality of the Security System.</li>
                                        <li>Enhanced the Security System.</li>
                                    </ul>
                                    Updated UsersDB SQL Installer Package. <br/>
                                    <ul>
                                        <li>Added BIO to the user's Table.</li>
                                    </ul>
                                    Updated English Language Dialog. <br/>
                                    Updated Profile Page. <br/>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <span class="expandableText">
                                    <h5><a href="https://github.com/xrayhunter/PHP-SimpleLoginRegister-Website/commit/1d41bc265264e912eb0d3c682a30fd2f2d14e3ac">ChangeLog #1.0.2</a></h5>
                                    <p class='text-muted'>Updated on: 9/30/18</p>
                                    <hr/>
                                    Added Website Easy Link to Config. <br/>
                                    Added Templates. <br/>
                                    <ul>
                                        <li>Footer Template - HTML</li>
                                        <li>Navbar(header) Template - HTML</li>
                                        <li>Language Setup Template - Pure PHP</li>
                                    </ul>
                                    Added Change Password - Post Handler. <br/>
                                    Updated Login Page & Handler. <br/>
                                    Updated Registration Page & Handler. <br/>
                                    Updated Index. <br/>
                                    <ul>
                                        <li>Removed Language Code, and replaced it with Language Setup Template inclusion.</li>
                                        <li>Removed Header HTML, and replaced it with it's corresponding template.</li>
                                        <li>Removed Footer HTML, and replaced it with it's corresponding template.</li>
                                    </ul>
                                    Fixed & Updated Install Page's displaying information about the installation. <br/>
                                    Fixed Cookie float errors. <br/>
                                    Fixed Author's SQL Installer Library - The Installer wasn't doing every table included, it would do the first and only the first one. <br/>
                                    Updated Author's SQL Installer Library Package Template. <br/>
                                    Fixed Author's SQL Library - SQL would attempt to Fetch on non-fetchable query commands A.K.A "USE". <br/>
                                    Updated Input Validation - Standardized Error Reporting. <br/>
                                    Removed Debugging echo's in Token. <br/>
                                    Updated User. <br/>
                                    <ul>
                                        <li>Check, if user exists before inserting a new user.</li>
                                        <li>Removed Debugging.</li>
                                        <li>Added Cookie Authorization.</li>
                                        <li>Updated logout policies.</li>
                                        <li>Added User group lookup.</li>
                                        <li>Added Permission Lookup.</li>
                                    </ul>
                                    Updated UsersDB - SQL Installer Package. <br/>
                                    Updated English Language Dialog. <br/>
                                    Updated French Language Dialog. <br/>
                                    Added Profile Page. <br/>
                                    Updated preformance issues. <br/>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <span class="expandableText">
                                    <h5><a href="https://github.com/xrayhunter/PHP-SimpleLoginRegister-Website/commit/c116374d8aa18dc3c63ec6a157a2a888648796f8">ChangeLog #1.0.1</a></h5>
                                    <p class='text-muted'>Updated on: 9/30/18</p>
                                    <hr/>
                                    Configurated the Global SQL Settings. <br/>
                                    Updated Author's Extension Library. <br/>
                                    Added Functions to help retrieving client data. <br/>
                                    Added Funcitons to help secure database user inputs. <br/>
                                    Added 404 redirect Page. <br/>
                                    Added Login page. <br/>
                                    Added Logout page. <br/>
                                    Added Registration page. <br/>
                                    Updated the Index page. <br/>
                                    <ul>
                                        <li>Enabled Multi-Language support.</li>
                                        <li>Updated old placeholder code to new functions.</li>
                                        <li>Updated login & register model forms.</li>
                                        <li>Fixed login & register model forms not sending post data to the post handler pages.</li>
                                        <li>Globalized Language.</li>
                                        <li>Added flash notification to inform the user.</li>
                                    </ul>
                                    Added the SQL Install page. <br/>
                                    Added a Cookie Helper class. <br/>
                                    Updated Author's SQL Library. <br/>
                                    Updated Author's SQL Installer Library. <br/>
                                    Added a Encryption(Hash) Helper class. <br/>
                                    Updated a Input Validation Helper class. <br/>
                                    Updated Author's Language Library. <br/>
                                    Added a Redirect Helper class. <br/>
                                    Added a Session Helper class. <br/>
                                    Added a Token Helper class - Helps prevent CRFS attacks. <br/>
                                    Updated User class. <br/>
                                    Renamed old Test_Package to UsersDB - SQL Database Installer. <br/>
                                    Updated English Language Dialog. <br/>
                                    Updated French Language Dialog. <br/>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <span class="expandableText">
                                    <h5><a href="https://github.com/xrayhunter/PHP-SimpleLoginRegister-Website/commit/64b4102caa02c05fc1586bd4c0dff712bbe285e0">ChangeLog #1.0.0 (Initial Build)</a></h5>
                                    <p class='text-muted'>Updated on: 9/29/18</p>
                                    <hr/>
                                    Constructed Configuration.<br/>
                                    Installed Author's Extension Library <a href="https://github.com/xrayhunter/PHP-EasyExtensions-Library">Github</a>.<br/>
                                    Created a Template Index page.<br/>
                                    Installed Author's SQL Library <a href="https://github.com/xrayhunter/PHP-EasySQL-Library">Github</a>.<br/>
                                    Installed Author's SQL DB Installer Library <a href="https://github.com/xrayhunter/PHP-EasySQLInstaller-Library">Github</a>.<br/>
                                    Created a Construct of a Input Validation System.<br/>
                                    Installed Author's Language Library <a href="https://github.com/xrayhunter/PHP-EasyLangue-Library">Github</a>.<br/>
                                    Created a Construct of a User System.<br/>
                                    Added a DB Installation Package.<br/>
                                    Added English Language Dialog.<br/>
                                    Added French Language Dialog.<br/>
                                </span>
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Title</h3>
                    <p class="card-text">Text</p>
                </div>
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