<?php

require_once 'Classes/Ship.php';

class Table {

	private $table = array();
	
	private $ships = array();
	
	private $message = "";
	private $counters = array(2 => 3, 3 => 2, 4 => 2, 5 => 1);

	public function __construct(){
		
	}
	
	public function setShip($ship) {
		$this->ship = new Ship();
	}
	
	public function getShip() {
		return $this->ship;
	}
	
	public function getTable($x, $y) {
		return $this->table[$x][$y];
	}
	
	public function setTable($x, $y) {
		$this->table[$x][$y] = 1;
	}
	
	public function initializeTable() {
		for ($i=0; $i<10; $i++) {
			for ($ii=0; $ii<10; $ii++) {
				$this->table[$i][$ii] = "";
			}
		}
		return $this->table;
	}
	
	public function getTableShips() {
		return $this->table;
	}
	
	public function moveShip($direction, $case, $x, $y) {
		for ($i=0; $i<$case; $i++) {
			if ($direction == 'up') {
				$this->table[$x][$y] = "X";
				$y--;
			} else if($direction == 'left') {
				$this->table[$x][$y] = "X";
				$x--;
			} else if($direction == 'right') {
				$this->table[$x][$y] = "X";
				$x++;
			} else {
				$this->table[$x][$y] = "X";
				$y++;
			}
		}
	}
	
	public function putShip($type, $direction, $position) {
		$x = $position[0];
		$y = $position[1];
			
		switch ($type) {
			case 2:
				if($this->counters[2] >= 0) {
// 					$this->ships = new Ship($type, $direction, $position);
					$this->moveShip($direction, 2, $x, $y);
				} else {
					$this->message = "Non hai più navi da 2 disponibili!";
				}
				$this->counters[2]--;
				break;
			case 3:
				if($this->counters[3] >= 0) {
// 					$this->ships = new Ship($type, $direction, $position);
					$this->moveShip($direction, 3, $x, $y);
				} else {
					$this->message = "Non hai più navi da 3 disponibili!";
				}
				$this->counters[3]--;
				break;
			case 4:
				if($this->counters[3] >= 0) {
// 					$this->ships = new Ship($type, $direction, $position);
					$this->moveShip($direction, 4, $x, $y);
				} else {
					$this->message = "Non hai più navi da 4 disponibili!";
				}
				$this->counters[4]--;
				break;
			case 5:
				if($this->counters[3] >= 0) {
// 					$this->ships = new Ship($type, $direction, $position);
					$this->moveShip($direction, 5, $x, $y);
				} else {
					$this->message = "Non hai più navi da 5 disponibili!";
				}
				$this->counters[5]--;
				break;
		}
		return $this->message;
	}
}
