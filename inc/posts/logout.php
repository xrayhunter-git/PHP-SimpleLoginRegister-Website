<?php
    require_once '../../core/init.php';

    $user = new User(Config::get('mysql'));
    $user->logout();

    Session::flash('login_message', 'login_logout');
    Redirect::to('../../index.php');