<?php


namespace App\Services;

class Request
{
  // Méthode pour récupérer une variable de la requête GET
  public function get($name, $default = null)
  {
    return isset($_GET[$name]) ? $_GET[$name] : $default;
  }

  // Méthode pour récupérer une variable de la requête POST
  public function post($name, $default = null)
  {
    return isset($_POST[$name]) ? $_POST[$name] : $default;
  }

  // Méthode pour récupérer toutes les données de la requête GET ou POST
  public function all()
  {
    return array_merge($_GET, $_POST);
  }

  // Méthode pour effectuer une redirection
  public function redirect($page)
  {
    header('Location: ' . $page);
    exit; // Arrête l'exécution du script après la redirection
  }

  public function isPost()
  {
    return ($_SERVER['REQUEST_METHOD'] === 'POST');
  }
}
