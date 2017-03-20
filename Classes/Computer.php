<?php

class Computer {

public $position = array();

public __construct($position) {
  $this->position = $position;
}

public randPositionShip() {
  
}

public move() {
  $x = rand(0, 10);
  $y = rand(0, 10);
}
}
