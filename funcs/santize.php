<?php
    function escape(string $str)
    {
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }

    function str_shorten(string $input, string $enders, int $amountLetters) : string
    {
        $output = "";
        
        for($i = 0; $i < strlen($input); $i++)
        {
            if (strlen($output) < $amountLetters)
                $output .= $input[$i];
            else
                break;
        }

        if (strlen($output) >= $amountLetters)
            $output .= $enders;
        
        return $output;
    }

    function str_upperfirst(string $input) : string
    {
        return ucfirst($input);
    }

    function correctTime(int $input) : string
    {
        $output = "";
        $miliseconds = $input;
        $seconds = (int)($miliseconds / 1000);
        $minutes = $seconds / 60;
        $hours = (int)($minutes / 60);
        if ($hours > 0)
            $output = $hours . 'hrs';
        elseif ($minutes > 0)
            $output = $minutes . 'mins';
        elseif ($seconds > 0)
            $output = $seconds . 'secs';
        else
            $output = $miliseconds . 'ms';
        return $output;
    }

    function correctByteSize(int $input) : string
    {
        $output = "";
        $bytes = $input;
        $kb = (int)($bytes / 1024);
        $mb = (int)($kb / 1024);
        $gb = (int)($mb / 1024);
        if ($gb >= 1)
            $output = $gb . 'gb';
        elseif($mb >= 1)
            $output = $mb . 'mb';
        elseif ($kb >= 1)
            $output = $kb . 'kb';
        else
            $output = $bytes . 'bytes';

        return $output;
    }
?>