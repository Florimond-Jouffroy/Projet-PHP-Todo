<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\TwigFunction;
use Twig\Loader\FilesystemLoader;

abstract class Controller
{
  private $twig;

  public function __construct()
  {
    // Initialise le chargeur de templates Twig avec le chemin vers le dossier des vues
    $loader = new FilesystemLoader(ROOT . '/views');

    // Initialise l'environnement Twig avec le chargeur et des options
    $this->twig = new Environment($loader, [
      'cache' => false, // Désactive le cache en développement (activer en production)
    ]);

    // Ajoute une nouvelle fonction Twig personnalisée pour générer des URLs
    $this->twig->addFunction(new TwigFunction('url', function ($url, $args = null) {
      return $this->url($url, $args);
    }));
  }



  /**
   * Rend le template Twig avec les paramètres fournis
   * @param string $twigFile Nom du template Twig à rendre
   * @param array|null $parameters Tableau de données à transmettre au template
   * @return bool Indique si le rendu s'est déroulé avec succès
   */
  protected function render(string $twigFile, array $parameters = null)
  {
    try {
      if ($parameters !== null) {
        echo $this->twig->render($twigFile, $parameters);
      } else {
        echo $this->twig->render($twigFile);
      }
    } catch (\Exception $e) {
      var_dump($e); // Affiche l'erreur en cas d'échec du rendu (peut être modifié en conséquence)
      return false; // Indique que le rendu a échoué
    }
    return true; // Indique que le rendu s'est déroulé avec succès
  }



  /**
   * Génère une URL complète en fonction d'un chemin et d'arguments
   * @param string $url Chemin de l'URL
   * @param array|null $args Arguments à ajouter à l'URL
   * @return string L'URL complète générée
   * @throws \InvalidArgumentException Si $args n'est pas un tableau
   */
  protected function url($url, $args = null)
  {
    $path = getenv('ENV_URL') . '/' . $url;

    if ($args !== null) {
      if (is_array($args)) {
        if (substr($url, -1) != '/') {
          $path .= '/';
        }
        foreach ($args as $arg) {
          $path .= $arg . '/';
        }
      } else {
        throw new \InvalidArgumentException("args is not an array");
      }
    }

    return $path; // Retourne l'URL complète générée
  }
}
