<?php

namespace App\Services;

use App\Services\Route;

class Router
{
  private $routes = array(); // Tableau pour stocker les objets Route

  // Ajoute une nouvelle route à la liste des routes
  public function addRoute($method, $path, $controller, $action)
  {
    $this->routes[] = new Route($method, $path, $controller, $action); // Crée et ajoute un nouvel objet Route à la liste
  }

  // Gère la demande en fonction de la méthode HTTP et de l'URI
  public function handleRequest($method, $uri)
  {
    foreach ($this->routes as $route) {
      if ($route->matches($method, $uri)) { // Vérifie si la route correspond à la méthode et à l'URI
        $route->execute($uri); // Exécute l'action du contrôleur associé à la route
        return; // Sort de la boucle dès qu'une correspondance est trouvée
      }
    }

    $this->notFound(); // Appelle la méthode notFound si aucune correspondance n'est trouvée
  }

  // Affiche une erreur 404 et un message approprié
  private function notFound()
  {
    header("HTTP/1.0 404 Not Found"); // Envoie l'en-tête HTTP 404 Not Found
    echo "404 Not Found"; // Affiche un message d'erreur
  }

  // Méthode pour ajouter une route de type GET
  public function get($path, $controller, $action)
  {
    $this->addRoute('GET', $path, $controller, $action); // Appelle la méthode addRoute avec la méthode GET
  }

  // Méthode pour ajouter une route de type POST
  public function post($path, $controller, $action)
  {
    $this->addRoute('POST', $path, $controller, $action); // Appelle la méthode addRoute avec la méthode POST
  }

  public function delete($path, $controller, $action)
  {
    $this->addRoute('DELETE', $path, $controller, $action);
  }
}
