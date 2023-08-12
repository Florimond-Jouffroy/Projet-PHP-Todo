<?php

namespace App\Managers;

use PDO;
use PDOException;

abstract class BddManager
{

  protected $pdo; // Instance de PDO pour la connexion à la base de données

  public function __construct()
  {

    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $username = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];

    // Crée une instance de PDO pour la connexion à la base de données
    $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
}
