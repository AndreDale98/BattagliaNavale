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
    
    function moveShip($direction, $case, $x, $y) {
    	for ($i=0; $i<$case; $i++) {
       		if ($direzione == 'up') {
       			$y--;
        	} else if($direction == 'left') {
        		$x--;
        	} else if($direction == 'right') {
        		$x++;
        	} else {
        		$y++;
        	}
  		}
    }
    
    function putShip($type, $direction, $position) {
        $x = $position[0];
        $y = $position[1];
        
        switch ($type) {
            case 2:
                moveShip($direction, 2, $x, $y);
                break;
            case 3:
                moveShip($direction, 3, $x, $y);
                break;
            case 4:
                moveShip($direction, 4, $x, $y);
                break;
            case 5:
                moveShip($direction, 5, $x, $y);
                break;
        }
    }
}
