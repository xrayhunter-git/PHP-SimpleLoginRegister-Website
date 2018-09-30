<?php
    class UsersDB extends DB_Installer_Packager
    {
        public function __construct()
        {
            parent::addPackageTable("users", array(
                "id" => "INT(11) NOT NULL AUTO_INCREMENT",
                "username" => "VARCHAR(50) NOT NULL",
                "password" => "TEXT NOT NULL",
                "salt" => "VARCHAR(32) NOT NULL",
                "email" => "TEXT NOT NULL",
                "legalName" => "TEXT NOT NULL",
                "authorizationCode" => "TEXT NOT NULL",
                "authorized" => "TINYINT(1) NOT NULL",
                "authIPAddresses" => "TEXT NOT NULL",
                "registrationDate" => "DATETIME NOT NULL"
            ));
            parent::addPackageTable("users_sessions", array(
                "id" => "INT(11) NOT NULL AUTO_INCREMENT",
                "user_id" => "INT(11) NOT NULL",
                "hash" => "TEXT NOT NULL",
                "createdDate" => "DATETIME NOT NULL"
            ));

            parent::setPackageTablePrimaryKey("users", "id");
            parent::setPackageTablePrimaryKey("users_sessions", "id");
        }
    }
?>