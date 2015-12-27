<?php


/* 
 * This file is used to initialize all classes and functions, start sessions and set config options
 */
//Allow user to set sessions
if (session_status() == PHP_SESSION_NONE) 
    {
        session_start();

    }
//Autoloading classes instead of using require once every time. Only load classes used.
//Pass a function that runs everytime a class is accessed
spl_autoload_register(function($class){
    require_once $_SERVER['DOCUMENT_ROOT'].'/Github/SGA/classes/'. $class .'.php';
    //require_once $_SERVER['DOCUMENT_ROOT'].'/classes/'. $class .'.php';

});


$GLOBALS['path']= array();


//Setting global configuration settings to be used by the config class
$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'db' => 'igaDB'
    )
);

date_default_timezone_set('Europe/Berlin');
