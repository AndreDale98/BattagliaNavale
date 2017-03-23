<?php

require_once 'Classes/Ship.php';

class Table {

	private $tableUser = array();
	private $tableCPU = array();
	private $ships = array();

	private $message = "";
	private $counters = array(2 => 3, 3 => 2, 4 => 2, 5 => 1);
	private $direction = array(0 => "up", 1 => "down", 2 => "right", 3 => "left");
	private $computerShips = array(0 => 2, 1 => 2, 2 => 2, 3 => 3, 4 => 3, 5 => 4, 6 => 4, 7 => 5);
	private $gameState = "preparation";

	public function __construct(){
		$this->initializeTable();
		$this->randComputerTable();
	}

	public function setShip($ship) {
		$this->ship = new Ship();
	}

	public function getShip() {
		return $this->ship;
	}

	public function getTable($x, $y) {
		return $this->tableUser[$x][$y];
	}

	public function getTableCPU($x, $y) {
		return $this->tableCPU[$x][$y];
	}

	public function getGameState() {
		return $this->gameState;
	}

	public function initializeTable() {
		for ($i=0; $i<10; $i++) {
			for ($ii=0; $ii<10; $ii++) {
				$this->tableUser[$i][$ii] = "";
			}
		}
		for ($i=0; $i<10; $i++) {
			for ($ii=0; $ii<10; $ii++) {
				$this->tableCPU[$i][$ii] = "";
			}
		}
	}

	public function randComputerTable() {
		for($i = 0; $i < count($this->computerShips); $i++) {
			for (;;) {
				mt_srand(mktime());
				$randDirection = $this->direction[rand(0, 3)];
				$randX = rand(0, 9);
				$randY = rand(0, 9);

				// echo $randX.'-'.$randY.'-'.$randDirection.'-'.$this->computerShips[$i].' => ';
				if ($this->putShip($this->computerShips[$i],$randDirection, array($randX, $randY), "CPU") == 0) {
					// echo 'OK<br>';
					break;
				} else {
					// echo 'NO<br>';
					//$i--;
				}
			}
		}
	}

	public function moveShip($direction, $case, $x, $y, $player) {
		for ($i=0; $i<$case; $i++) {
			if ($direction == 'up') {
				if ($player == 'CPU') $this->tableCPU[$x][$y] = "O";
				else $this->tableUser[$x][$y] = "blue";
				$y--;
			} else if($direction == 'left') {
				if ($player == 'CPU') $this->tableCPU[$x][$y] = "O";
				else $this->tableUser[$x][$y] = "blue";
				$x--;
			} else if($direction == 'right') {
				if ($player == 'CPU') $this->tableCPU[$x][$y] = "O";
				else $this->tableUser[$x][$y] = "blue";
				$x++;
			} else {
				if ($player == 'CPU') $this->tableCPU[$x][$y] = "O";
				else $this->tableUser[$x][$y] = "blue";
				$y++;
			}
		}
		if(count($this->ships) == 8) {
			$this->gameState = "startGame";
		}
	}

	public function checkTable($x, $y, $type, $direction, $player) {
		for($i = 0; $i <= $type; $i++){
			if($direction == "up"){
				if ($player == "User") {
					if($this->tableUser[$x][$y] == "X") return false;
				} else {
					if($this->tableCPU[$x][$y] == "X") return false;
				}
				$y--;
			} else if($direction == "down"){
				if ($player == "User") {
					if($this->tableUser[$x][$y] == "X") return false;
				} else {
					if($this->tableCPU[$x][$y] == "X") return false;
				}
				$y++;
			} else if($direction == "right"){
				if ($player == "User") {
					if($this->tableUser[$x][$y] == "X") return false;
				} else {
					if($this->tableCPU[$x][$y] == "X") return false;
				}
				$x++;
			} else if($direction == "left"){
				if ($player == "User") {
					if($this->tableUser[$x][$y] == "X") return false;
				} else {
					if($this->tableCPU[$x][$y] == "X") return false;
				}
				$x--;
			}
			return true;
		}

	}

	public function checkIfHit($x, $y) {
		if($this->tableCPU[$x][$y] == "O"){
			return $this->tableCPU[$x][$y];
		}
		else {
			// echo "not hit";
		}
	}

	public function putShip($type, $direction, $position, $player = "User") {
		// 		echo '<pre>'; print_r($this->tableCPU); print_r($this->counters); print_r($this->computerShips); echo '</pre>';

		$x = $position[0];
		$y = $position[1];
		$this->message = "";

		if($direction == 'up'){
			if(($y - $type) >= 0) {
				if($this->counters[$type] > 0) {
					if($this->checkTable($x, $y, $type, $direction, $player)){
						if ($player == "User") {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[$type]--;
						}
						$this->moveShip($direction, $type, $x, $y, $player);
						return 0;
					}
					else {
						return 1;
					}
				}
				else {
					// 							$this->message = "Non hai più navi da 2 disponibili!";
					return 2;
				}
			}
			else {
				// 						$this->message = "In questa posizione la nave non ci sta!";
				return 3;
			}
		}
		else if($direction == 'down'){
			if(($y + $type) <= 9) {
				if($this->counters[$type] > 0) {
					if($this->checkTable($x, $y, $type, $direction, $player)){
						if ($player == "User") {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[$type]--;
						}
						$this->moveShip($direction, $type, $x, $y, $player);
						return 0;
					}
					else {
						return 1;
					}
				}
				else {
					// 							$this->message = "Non hai più navi da 2 disponibili!";
					return 2;
				}
			}
			else {
				// 						$this->message = "In questa posizione la nave non ci sta!";
				return 3;
			}
		}
		else if($direction == 'left') {
			if(($x - $type) >= 0) {
				if($this->counters[$type] > 0) {
					if($this->checkTable($x, $y, $type, $direction, $player)){
						if ($player == "User") {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[$type]--;
						}
						$this->moveShip($direction, $type, $x, $y, $player);
						return 0;
					}
					else {
						return 1;
					}
				}
				else {
					// 							$this->message = "Non hai più navi da 2 disponibili!";
					return 2;
				}
			}
			else {
				// 						$this->message = "In questa posizione la nave non ci sta!";
				return 3;
			}
		}
		else if($direction == 'right') {
			if(($x + $type) <= 9) {
				if($this->counters[$type] > 0) {
					if($this->checkTable($x, $y, $type, $direction, $player)){
						if ($player == "User") {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[$type]--;
						}
						$this->moveShip($direction, $type, $x, $y, $player);
						return 0;
					}
					else {
						return 1;
					}
				}
				else {
					// 							$this->message = "Non hai più navi da 2 disponibili!";
					return 2;
				}
			}
			else {
				// 						$this->message = "In questa posizione la nave non ci sta!";
				return 3;
			}
		}
		//		return $this->message;
		echo "Non è possibile";
	}
}
