<?php

namespace App\Services;

class Route
{
  private $method;        // Méthode HTTP associée à la route (GET, POST, etc.)
  private $path;          // Chemin de l'URL associé à la route (par exemple, '/tasks/show/{id}')
  private $controller;    // Nom du contrôleur à appeler lors de la correspondance de la route
  private $action;        // Action du contrôleur à appeler lors de la correspondance de la route
  private $pattern;       // Modèle d'expression régulière généré à partir du chemin

  public function __construct($method, $path, $controller, $action)
  {
    $this->method = $method;
    $this->path = $path;
    $this->controller = $controller;
    $this->action = $action;
    $this->pattern = $this->getPattern(); // Calcul du modèle d'expression régulière au moment de la création de la route
  }

  // Vérifie si la route correspond à la méthode et à l'URI donnés
  public function matches($method, $uri)
  {
    return $this->method === $method && preg_match($this->pattern, $uri);
  }

  // Exécute l'action du contrôleur correspondant avec les paramètres capturés dans l'URI
  public function execute($uri)
  {
    $matches = $this->getMatches($uri);
    $controllerName = 'App\\Controllers\\' . $this->controller;
    $actionName = $this->action;
    $controller = new $controllerName();
    $controller->$actionName(...$matches); // Appel de l'action du contrôleur avec les paramètres capturés
  }

  // Génère un modèle d'expression régulière à partir du chemin de la route avec des paramètres
  private function getPattern()
  {
    return '~^' . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_]+)', $this->path) . '$~';
  }

  // Récupère les paramètres capturés par l'expression régulière dans l'URI
  private function getMatches($uri)
  {
    preg_match($this->pattern, $uri, $matches);
    array_shift($matches); // Supprime le premier élément, qui contient la correspondance complète
    return $matches; // Retourne un tableau des paramètres capturés
  }
}
