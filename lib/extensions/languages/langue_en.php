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
        }
    }
?>