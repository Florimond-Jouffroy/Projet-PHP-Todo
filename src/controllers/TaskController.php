<?php

namespace App\Controllers;

use App\Managers\TaskManager;

class TaskController extends Controller
{

  public function showAll()
  {
    $taskManager = new TaskManager();
    $tasks = $taskManager->getAllTasks();

    return $this->render('tasks/tasks.html.twig', ['tasks' => $tasks]);
  }
}
