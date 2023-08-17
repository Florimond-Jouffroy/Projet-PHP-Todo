<?php

namespace App\Managers;

use PDO;
use App\Entities\Task;


class TaskManager extends BddManager
{

  public function getTaskId($id)
  {
    $stmt = $this->pdo->prepare("SELECT * FROM task WHERE id = ?"); // Prépare la requête SQL
    $stmt->execute([$id]); // Exécute la requête en remplaçant le paramètre par la valeur réelle
    $taskData = $stmt->fetch(PDO::FETCH_ASSOC); // Récupère la première ligne de résultat
    return new Task($taskData);
  }

  public function getAllTasks()
  {
    $stmt = $this->pdo->query("SELECT * FROM task"); // Exécute une requête SELECT pour récupérer toutes les tâches
    $taskDataList = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupère toutes les lignes de résultat
    $tasks = array();

    foreach ($taskDataList as $taskData) {
      $tasks[] = new Task($taskData); // Crée une instance de l'entité Task pour chaque ligne de résultat
    }

    return $tasks; // Retourne la liste des tâches
  }

  public function updateTask(Task $task)
  {
    $stmt = $this->pdo->prepare("UPDATE task SET title = ?, content = ? WHERE id = ?");

    $title = $task->getTitle();
    $content = $task->getContent();

    $id = $task->getId();

    $stmt->execute([$title, $content, $id]);
  }

  public function postTask(Task $task)
  {
    $stmt = $this->pdo->prepare("INSERT INTO task (title, content, create_time) VALUES (?, ?, NOW())");
    $stmt->execute([$task->getTitle(), $task->getContent()]);
    $taskId = $this->pdo->lastInsertId();

    return $this->getTaskId($taskId);
  }

  public function deleteTask($id)
  {
    $stmt = $this->pdo->prepare("DELETE FROM task WHERE id = ?");
    $stmt->execute([$id]);
  }
}
