<?php
    class Session
    {
        public static function put(string $name, string $value)
        {
            return $_SESSION[$name] = $value;
        }

        public static function get(string $name)
        {
            if(self::exists($name))
                return $_SESSION[$name];
            
            return '';
        }

        public static function exists(string $name)
        {
            return isset($_SESSION[$name]);
        }

        public static function delete(string $name)
        {
            if (self::exists($name))
                unset($_SESSION[$name]);
        }

        public static function flash(string $name, string $content = '')
        {
            $name = 'Flash_' . $name;
            if(self::exists($name) && $content == '')
            {
                $c = self::get($name);
                self::delete($name);
                return $c;
            }

            self::put($name, $content);
            
            echo $content;
        }
    }
?>