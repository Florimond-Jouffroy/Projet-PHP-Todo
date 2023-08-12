<?php

namespace App\Services;


class Route
{
  private $method;
  private $path;
  private $controller;
  private $action;
  private $pattern;

  public function __construct($method, $path, $controller, $action)
  {
    $this->method = $method;
    $this->path = $path;
    $this->controller = $controller;
    $this->action = $action;
    $this->pattern = $this->getPattern();
  }

  public function matches($method, $uri)
  {
    return $this->method === $method && preg_match($this->pattern, $uri);
  }

  public function execute($uri)
  {
    $matches = $this->getMatches($uri);
    $controllerName = 'App\\Controllers\\' . $this->controller;
    $actionName = $this->action;
    $controller = new $controllerName();
    $controller->$actionName(...$matches);
  }

  private function getPattern()
  {
    return '~^' . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $this->path) . '$~';
  }

  private function getMatches($uri)
  {
    preg_match($this->pattern, $uri, $matches);
    array_shift($matches);
    return $matches;
  }
}
