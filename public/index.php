<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Error reporting
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use Core\Router;

$router = new Router();

require_once dirname(__DIR__) . '/config/routes.php';

$router->getRouters();

try {
    $router->dispatch($_SERVER['REQUEST_URI']);
} catch (Exception $e){
    echo '<pre>Message:'.$e->getMessage().'</pre>';
    echo '<pre>File: '.$e->getFile().'</pre>';
    echo '<pre>Line: '.$e->getLine().'</pre>';
}
