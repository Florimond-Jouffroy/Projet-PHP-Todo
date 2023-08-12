<?php

namespace App\Services;

use App\Services\Route;

class Router
{
  private $routes = array();

  public function addRoute($method, $path, $controller, $action)
  {
    $this->routes[] = new Route($method, $path, $controller, $action);
  }

  public function handleRequest($method, $uri)
  {
    foreach ($this->routes as $route) {
      if ($route->matches($method, $uri)) {
        $route->execute($uri);
        return;
      }
    }

    $this->notFound();
  }

  private function notFound()
  {
    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
  }

  public function get($path, $controller, $action)
  {
    $this->addRoute('GET', $path, $controller, $action);
  }

  public function post($path, $controller, $action)
  {
    $this->addRoute('POST', $path, $controller, $action);
  }
}
