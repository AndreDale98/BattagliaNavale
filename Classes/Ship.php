<?php

class Ship {
    
    public $type;
    public $direction;
    public $position = array();
    
    public $ship5 = 1;
    public $ship4 = 2;
    public $ship3 = 2;
    public $ship2 = 3;
    
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
    
    function scaleShip5() {
    	$this->ship5--;
    }
    
    function scaleShip4() {
    	$this->ship4--;
    }
    
    function scaleShip3() {
    	$this->ship3--;
    }
    
    function scaleShip2() {
    	$this->ship2--;
    }
    
    function getShip5() {
    	return $this->ship5;
    }
    
    function getShip4() {
    	return $this->ship4;
    }
    
    function getShip3() {
    	return $this->ship3;
    }
    
    function getShip3() {
    	return $this->ship3;
    }
    
}
