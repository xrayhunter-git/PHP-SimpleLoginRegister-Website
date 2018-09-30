<?php
    class Hash
    {
        public static function make(string $str, string $salt = '', string $hashMethod = 'sha256')
        {
            $newStr = '';

            for($i = 0; $i < strlen($str); $i++)
            {
                if ($i % 3 == 0)
                    $newStr .= $salt . $str[$i];
                else
                    $newStr .= $str[$i];
            }

            return hash($hashMethod, $salt . $newStr . $salt);
        }

        public static function salt(int $length)
        {
            return bin2hex(random_bytes($length));
        }

        public static function unique()
        {
            return self::make(uniqid());
        }
    }
?>