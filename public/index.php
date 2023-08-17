<?php


use App\Services\Router;


define('ROOT', dirname(__DIR__));

require_once ROOT . '/vendor/autoload.php';



$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->load();

$router = new Router();


$router->get('/', 'HomeController', 'index');
$router->get('/tasks', 'TaskController', 'showAll');
$router->post('/tasks/addTask', 'TaskController', 'addTask');
$router->get('/tasks/addTask', 'TaskController', 'addTask');
$router->get('/tasks/{id}', 'TaskController', 'showTask');
$router->post('/tasks/{id}/delete', 'TaskController', 'deleteTask');
$router->get('/tasks/{id}/edit', 'TaskController', 'editTask');
$router->post('/tasks/{id}/edit', 'TaskController', 'editTask');



$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$router->handleRequest($requestMethod, $requestUri);
