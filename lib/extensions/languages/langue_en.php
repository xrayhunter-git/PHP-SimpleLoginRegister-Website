<?php
    class Langue_EN extends Language
    {
        public function __construct()
        {
            $l = 'en';
            self::addDialog($l, "flag", "us");
            self::addDialog($l, "company", "Company");
            self::addDialog($l, "login", "Login");
            self::addDialog($l, "register", "Register");
            self::addDialog($l, "remember_me", "Remember me?");
            self::addDialog($l, "login_help", "Can't remember your account information?");
            self::addDialog($l, "login_dialog", "Don't have an Account? Goto the registration tab above!");
            self::addDialog($l, "register_dialog", "Already have an Account? Goto the login tab above!");
            self::addDialog($l, "login_username", "Username");
            self::addDialog($l, "login_currentpassword", "Current Password");
            self::addDialog($l, "login_password", "Password");
            self::addDialog($l, "login_cpassword", "Confirm Password");
            self::addDialog($l, "login_email", "E-Mail");
            self::addDialog($l, "login_cemail", "Confirm E-Mail");
            self::addDialog($l, "login_privacy_policies", "Privacy Policies");
            self::addDialog($l, "login_help_link", "Click here for some assistance!");
            self::addDialog($l, "register_username", "Username or Nickname");
            self::addDialog($l, "register_btn", "Register an Account"); 
            self::addDialog($l, "home", "Home"); 
            self::addDialog($l, "store", "Store"); 
            self::addDialog($l, "contact_us", "Contact us"); 
            self::addDialog($l, "account_profile", "Profile"); 
            self::addDialog($l, "account_settings", "Settings"); 
            self::addDialog($l, "account_logout", "Logout"); 
            self::addDialog($l, "update", "Update");
            self::addDialog($l, "login_success", '
            <div class="alert alert-success" role="alert">
                Welcome [name], you were successfully logged in!
            </div>'); 
            self::addDialog($l, "login_logout", '
            <div class="alert alert-secondary" role="alert">
                You were successfully logged out!
            </div>'); 
            self::addDialog($l, "login_password_change", '
            <div class="alert alert-success" role="alert">
                Your password was successfully changed.
            </div>'); 
            self::addDialog($l, "login_failed_badlogin", '
                Sorry, we couldn\'t either find you account or your credentials do not match with this account. Please try again or <br/>
                <a href="#">Click here for some assistance</a>!
            '); 
            self::addDialog($l, "login_failed_noauth", '
                Sorry, this computer doesn\'t have access to this account. We\'ve sent a authorization certificate to your E-Mail to verify yourself.<br/>
                <a href="#">Resend authorization certification to my E-Mail</a>
            '); 
            self::addDialog($l, "login_failed_notverified", '
                Sorry, you need to verify your e-mail before logging in! <br/>
                <a href="#">Resend Verification to my E-Mail</a>
            '); 
            self::addDialog($l, "auto_logout", '
                <div class="alert alert-secondary" role="alert">
                    We logged you out of our account to prevent any type of attacks towards you account, while you\'re idle.<br/>
                </div>
            '); 
        }
    }
?>