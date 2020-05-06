<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/config/function.php';
require_once dirname(__DIR__) . '/config/constants.php';

/**
 * Error reporting
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$router = new Core\Router();

require_once dirname(__DIR__) . '/config/routes.php';

//echo '<pre>';
//print_r($router->getRouters());
//echo '</pre>';
if (!preg_match('/assets/i', $_SERVER['REQUEST_URI'])){
    try {
        $router->dispatch($_SERVER['REQUEST_URI']);
    } catch (Exception $e){
        echo '<pre>Message:'.$e->getMessage().'</pre>';
        echo '<pre>File: '.$e->getFile().'</pre>';
        echo '<pre>Line: '.$e->getLine().'</pre>';
    }
}

use Core\AbsModel;

$absModel = new AbsModel();