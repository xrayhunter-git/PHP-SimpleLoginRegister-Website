<?php
    function escape(string $str)
    {
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }
?>