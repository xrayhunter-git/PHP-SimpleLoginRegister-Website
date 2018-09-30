<?php
    class Token
    {
        public static function generate(string $name = 'form')
        {
            $name = 'Token_' . $name;
            return "<input type='hidden' name='{$name}' value = '". Session::put($name, md5(uniqid())) ."'>";
        }

        public static function check(string $name = 'form')
        {
            $name = 'Token_' . $name;
            if(Session::exists($name) && InputValidation::get($name) == Session::get($name))
            {
                Session::delete($name);
                return true;
            }

            return false;
        }
    }
?>