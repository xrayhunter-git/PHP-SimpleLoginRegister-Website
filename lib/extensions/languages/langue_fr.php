<?php
    class Langue_FR extends Language
    {
        public function __construct()
        {
            $l = 'fr';
            self::addDialog($l, 'flag', 'fr');
            self::addDialog($l, 'company', 'Company');
            self::addDialog($l, 'login', 'S\'identifier');
            self::addDialog($l, 'register', 'Registre');
            self::addDialog($l, 'remember_me', 'Souviens-moi?');
            self::addDialog($l, 'login_help', 'Vous ne pouvez pas vous souvenir de vos informations de compte?');
            self::addDialog($l, 'login_dialog', 'Vous n\'avez pas de compte? Aller à l\'onglet d\'enregistrement ci-dessus!');
            self::addDialog($l, 'register_dialog', 'Vous avez déjà un compte? Aller à l\'onglet de connexion ci-dessus!');
            self::addDialog($l, 'login_username', 'Nom d\'utilisateur');
            self::addDialog($l, 'login_currentpassword', 'Mot de passe actuel');
            self::addDialog($l, 'login_password', 'Mot de passe');
            self::addDialog($l, 'login_cpassword', 'Confirmez le mot de passe');
            self::addDialog($l, 'login_email', 'E-Mail');
            self::addDialog($l, 'login_cemail', 'Confirmez votre e-mail');
            self::addDialog($l, 'login_privacy_policies', 'Les politiques de confidentialité');
            self::addDialog($l, 'login_help_link', 'Cliquez ici pour obtenir de l\'aide!');
            self::addDialog($l, 'register_username', 'Nom d\'utilisateur ou pseudo');
            self::addDialog($l, 'register_btn', 'Enregistrer un compte');
            self::addDialog($l, 'home', 'Maison'); 
            self::addDialog($l, 'store', 'Magasin'); 
            self::addDialog($l, 'contact_us', 'Contactez nous'); 
            self::addDialog($l, 'account_profile', 'Profil'); 
            self::addDialog($l, 'account_settings', 'Paramètres'); 
            self::addDialog($l, 'account_logout', 'Connectez - Out'); 
            self::addDialog($l, 'update', 'Mettre à jour');
            self::addDialog($l, 'login_success', '
            <div class="alert alert-success" role="alert">
                Bienenvue [name], vous avez été connecté avec succès!
            </div>'); 
            self::addDialog($l, 'login_logout', '
            <div class="alert alert-secondary" role="alert">
                Vous avez été déconnecté avec succès!
            </div>'); 
            self::addDialog($l, 'login_password_change', '
            <div class="alert alert-success" role="alert">
                Votre mot de passe a été changé avec succès.
            </div>');
            self::addDialog($l, 'login_failed_badlogin', '
                Désolé, nous n\'avons pas pu trouver votre compte ou vos informations d\'identification ne correspondent pas à ce compte. Veuillez réessayer ou <br/>
                <a href="#">cliquez ici pour obtenir de l\'aide</a>!
            '); 
            self::addDialog($l, 'login_failed_noauth', '
                Désolé, cet ordinateur n\'a pas accès à ce compte. Nous avons envoyé un certificat d\'autorisation à votre courrier électronique pour vous vérifier.<br/>
                <a href="#">Renvoyer la certification d\'autorisation à mon courrier électronique</a>
            '); 
            self::addDialog($l, 'login_failed_notverified', '
                Désolé, vous devez vérifier votre email avant de vous connecter!<br/>
                <a href="#">Renvoyer la vérification à mon courrier électronique</a>
            '); 
            self::addDialog($l, 'auto_logout', '
                <div class="alert alert-secondary" role="alert">
                    Nous vous avons déconnecté de notre compte pour empêcher tout type d’attaque contre votre compte pendant que vous êtes inactif.<br/>
                </div>
            '); 
        }
    }
?>