<?php

namespace App\Collections;

class Collection implements \Countable, \IteratorAggregate
{
  protected $items = [];

  public function __construct(array $items = [])
  {
    $this->items = $items;
  }

  public function count()
  {
    return count($this->items);
  }

  public function getIterator()
  {
    return new \ArrayIterator($this->items);
  }
}
