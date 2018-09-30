<?php
    class Cookie
    {
        public static function exists($name)
        {
            return (isset($_COOKIE[$name]));
        }

        public static function get($name)
        {
            if(self::exists($name))
                return $_COOKIE[$name];

            return '';
        }

        public static function put($name, $value, $expire)
        {
            if(setcookie($name, $value, (int)(time() + $expire), '/'))
                return true;

            return false;
        }

        public static function delete($name)
        {
            self::put($name, '', time() - 1);
        }
    }