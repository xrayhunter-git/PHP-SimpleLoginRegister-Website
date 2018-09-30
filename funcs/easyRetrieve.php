<?php
    function grabClientIPAddress()
    {
        if (isset($_SERVER['REMOTE_ADDR']))
            return $_SERVER['REMOTE_ADDR'];
        elseif (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        
        return 'UNKNOWN';
    }

    function isClientUsingProxy($portScan = false)
    {
        $proxy_headers = array(
            'HTTP_VIA',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED',
            'HTTP_CLIENT_IP',
            'HTTP_FORWARDED_FOR_IP',
            'VIA',
            'X_FORWARDED_FOR',
            'FORWARDED_FOR',
            'X_FORWARDED',
            'FORWARDED',
            'CLIENT_IP',
            'FORWARDED_FOR_IP',
            'HTTP_PROXY_CONNECTION'
        );
        foreach($proxy_headers as $x){
            if (isset($_SERVER[$x])) return true;
        }

        if($portScan)
        {
            $ports = array(8080,80,81,1080,6588,8000,3128,553,554,4480);
            foreach($ports as $port) {
                if (@fsockopen($_SERVER['REMOTE_ADDR'], $port, $errno, $errstr, 30)) {
                    return true;
                }
            }
        }
        return false;
    }
?>