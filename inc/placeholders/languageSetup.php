<?php
    require_once __DIR__.'/../../core/init.php';

    // Language Module
    $langue = Language::create('en');
    $langue->addLanguage(new Langue_EN());
    $langue->addLanguage(new Langue_FR());

    if (isset($_GET['lang']))
        $_SESSION['lang'] = $_GET['lang'];

    $lang = (isset($_SESSION['lang']) ? $_SESSION['lang'] : $langue->getBrowserLanguage());