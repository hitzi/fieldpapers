<?php

    ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.'../lib');
    ini_set('include_path', ini_get('include_path').PATH_SEPARATOR.'/usr/home/migurski/pear/lib');
    require_once 'init.php';
    require_once 'data.php';
    
    /*
    header('Content-Type: text/plain');
    print_r($_POST);
    print_r($_SERVER);
    die();
    */
    
    list($user_id, $language) = read_userdata($_COOKIE['visitor'], $_SERVER['HTTP_ACCEPT_LANGUAGE']);

    // change to some other language
    $language = in_array($_POST['language'], array('en', 'de', 'nl'))
        ? $_POST['language']
        : $language;

    // redirect to some other page
    $location = $_POST['referer']
        ? $_POST['referer']
        : $_SERVER['HTTP_REFERER'];
    
    setcookie('visitor', write_userdata($user_id, $language), time() + 86400 * 31);
    header("Location: {$location}");
    die("Fine, {$language}\n");

?>