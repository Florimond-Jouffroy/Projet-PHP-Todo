<?php

namespace App\Controllers;

class TaskController extends Controller
{

  public function showAll()
  {
    return $this->render('tasks.html.twig');
  }
}
