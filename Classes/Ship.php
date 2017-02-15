<?php

class Ship {
    
    public $type;
    public $direction;
    public $position = array();
    
   public function __construct($type, $direction, $position) {
       $this->type = $type;
       $this->direction = $direction;
       $this->position = $position;
   }
            
    function setType($type) {
        $this->type = $type;
    }
 
    function setDirection($direction) {
        $this->direction = $direction;
    }
    
    function setPosition($position) {
        $this->position = $position;
    }
    
    function setWhatCell($whatCell) {
        $this->whatCell = $whatCell;
    }
    
    function getType() {
        return $this->type;
    }
    
    function getDirection() {
        return $this->direction;
    }
    
    function getPosition() {
        return $this->position;
    }
    
}
