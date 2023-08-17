<?php

namespace App\Controllers;

use App\Entities\Task;
use App\Services\Request;
use App\Managers\TaskManager;

class TaskController extends Controller
{
  private $request;
  private $taskManager;

  public function __construct()
  {
    parent::__construct();
    $this->taskManager = new TaskManager();
    $this->request = new Request();
  }

  public function showAll()
  {
    $tasks = $this->taskManager->getAllTasks();
    return $this->render('tasks/tasks.html.twig', ['tasks' => $tasks]);
  }

  public function showTask($id = null)
  {
    if ($id === null) {
      // message d'erreur
    }

    if (null !== ($task = $this->taskManager->getTaskId($id))) {
      return $this->render('tasks/show.html.twig', ['task' => $task]);
    } else {
      // message d'erreur comme quoi la task demander n'existe pas
    }
  }

  public function addTask($id = null)
  {
    if ($this->request->isPost()) {

      if ($id !== null) {
        $task = $this->taskManager->getTaskId($id);
      } else {
        $task = new Task();
      }


      $task->setTitle($this->request->post('title'));
      $task->setContent($this->request->post('content'));


      if ($id !== null) {
        $this->taskManager->updateTask($task);
      } else {
        $this->taskManager->postTask($task);
      }

      $this->showTask($task->getId());
    } else {
      return $this->render('/tasks/add.html.twig');
    }
  }

  public function editTask($id)
  {
    if (null === $id) {
      // message d'erreur
      var_dump("Erreur");
    }

    $task = $this->taskManager->getTaskId($id);

    if (null === $task) {
      // message d'erreur
      var_dump("Erreur");
    }

    if ($this->request->isPost()) {
      return $this->addTask($id);
    }

    return $this->render('tasks/add.html.twig', ['task' => $task]);
  }

  public function deleteTask($id)
  {

    if (null === $id) {
      // message d'erreur
      var_dump("Erreur");
    }

    $task = $this->taskManager->getTaskId($id);

    if (null === $task) {
      // message d'erreur
      var_dump("Erreur");
    }

    $this->taskManager->deleteTask($task->getId());

    $this->request->redirect('/tasks');
  }
}
