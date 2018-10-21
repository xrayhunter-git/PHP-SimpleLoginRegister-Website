<?php
    $initialLoadTime = time();
    session_start();
	
    // Generates a configuration.
    $GLOBALS['config'] = array(
        'mysql' => array(
            'type' => 'pdo', // Optional [Defaults: PDO]
            'sql_ip' => '127.0.0.1', // Required
            'sql_port' => 3306, // Required
            'sql_user' => 'root', // Required
            'sql_pass' => '', // Required
            'sql_db' => 'easySQLLib' // Optional
        ),
        'website' => 'http://localhost/github/PHP-SimpleLoginRegister-Website/'
    );
	
    // Load normal Libraries:
    $GLOBALS['extensions'] = array();

    // Auto load all Extensions and Classic Library essentials.
    spl_autoload_register(function($class) 
    {
        if (file_exists(__DIR__ . '/../lib/' . $class . '.php'))
            require_once __DIR__ . "/../lib/" . $class . ".php";
        else
        {
            foreach ($GLOBALS['extensions'] as $extension)
                if (file_exists(__DIR__ . '/../lib/extensions/' . (isset($extension) ? $extension . '/' : '') . $class . '.php'))
                    require_once __DIR__ . '/../lib/extensions/' . (isset($extension) ? $extension . '/' : '') . $class . '.php';
        }

    });

    $files = scandir(__DIR__ . '/../funcs', 1);
    foreach($files as $file)
    {
        if($file[0] != '.')
        {
            include_once __DIR__ . '/../funcs/' . $file;
        }
    }
?>