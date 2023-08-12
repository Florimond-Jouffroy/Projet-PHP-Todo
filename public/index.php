<?php

use App\Services\Router;


define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';

$router = new Router();


$router->get('/', 'HomeController', 'index');




$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$router->handleRequest($requestMethod, $requestUri);
