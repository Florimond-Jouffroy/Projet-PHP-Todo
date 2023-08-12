<?php

namespace App\Entities;

class Task extends Entity
{
  private $id;
  private $title;
  private $content;

  public function __construct($data = array())
  {
    $this->id = $data['id'] ?? null;
    $this->title = $data['title'] ?? null;
    $this->content = $data['content'] ?? null;
  }

  public function getId()
  {
    return $this->id;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getContent()
  {
    return $this->content;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function setContent($content)
  {
    $this->content = $content;
  }
}
