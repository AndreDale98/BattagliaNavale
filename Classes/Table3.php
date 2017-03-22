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
				mt_srand();
				$randDirection = $this->direction[rand(0, 3)];
				$randX = rand(0, 9);
				$randY = rand(0, 9);
			
				echo $randX.'-'.$randY.'-'.$randDirection.'-'.$this->computerShips[$i].' => ';
				
				if ($this->putShip($this->computerShips[$i],$randDirection, array($randX, $randY), "CPU") == 0) {
					echo 'OK<br>';
					break;
				} else {
					echo 'NO<br>';
				}
			}
		}
	}

	public function moveShip($direction, $case, $x, $y, $player) {
		for ($i=0; $i<$case; $i++) {
			if ($direction == 'up') {
				if ($player == 'CPU') $this->tableCPU[$x][$y] = "X";
				else $this->tableUser[$x][$y] = "X";
				$y--;
			} else if($direction == 'left') {
				if ($player == 'CPU') $this->tableCPU[$x][$y] = "X";
				else $this->tableUser[$x][$y] = "X";
				$x--;
			} else if($direction == 'right') {
				if ($player == 'CPU') $this->tableCPU[$x][$y] = "X";
				else $this->tableUser[$x][$y] = "X";
				$x++;
			} else {
				if ($player == 'CPU') $this->tableCPU[$x][$y] = "X";
				else $this->tableUser[$x][$y] = "X";
				$y++;
			}
		}
	}
	
	public function checkTable($x, $y, $type, $direction, $player) {
		if($direction == "up"){
			for($i = $y; $i <= $type; $i--){
				echo $x.'-'.$y.'-'.$type.'-'.$direction.'<br>';
				if ($player == "User") {
					if($this->tableUser[$x][$y] == "X") return false;
				} else {
					if($this->tableCPU[$x][$y] == "X") return false;
				}
			}
		} else if($direction == "down"){
			for($i = $y; $i <= $type; $i++){
				if ($player == "User") {
					if($this->tableUser[$x][$y] == "X") return false;
				} else {
					if($this->tableCPU[$x][$y] == "X") return false;
				}
			}
		} else if($direction == "right"){
			for($i = $x; $i <= $type; $i++){
				if ($player == "User") {
					if($this->tableUser[$x][$y] == "X") return false;
				} else {
					if($this->tableCPU[$x][$y] == "X") return false;
				}			}
		} else if($direction == "left"){
			for($i = $x; $i <= $type; $i--){
				if ($player == "User") {
					if($this->tableUser[$x][$y] == "X") return false;
				} else {
					if($this->tableCPU[$x][$y] == "X") return false;
				}			
			}
		}
		return true;
	}

	public function putShip($type, $direction, $position, $player = "User") {
// 		echo '<pre>'; print_r($this->tableCPU); print_r($this->counters); print_r($this->computerShips); echo '</pre>';
		
		$x = $position[0];
		$y = $position[1];
		$this->message = "";
		
		switch ($type) {
			case 2:
				if($direction == 'up'){
					if(($y - $type) >= -1) {
						if($this->counters[2] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[2]--;
								$this->moveShip($direction, 2, $x, $y, $player);
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
					break;
				}
				else if($direction == 'down'){
					if(($y + $type) <= 10) {
						if($this->counters[2] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[2]--;
								$this->moveShip($direction, 2, $x, $y, $player);
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
					break;
				}
				else if($direction == 'left') {
					if(($x - $type) >= -1) {
						if($this->counters[2] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[2]--;
								$this->moveShip($direction, 2, $x, $y, $player);
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
					break;
				}
				else if($direction == 'right') {
					if(($x + $type) <= 10) {
						if($this->counters[2] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[2]--;
								$this->moveShip($direction, 2, $x, $y, $player);
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
					break;
				}
			case 3:
				if($direction == 'up') {
					if(($y - $type) >= -1) {
						if($this->counters[3] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[3]--;
								$this->moveShip($direction, 3, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 3 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
				else if($direction == 'down') {
					if(($y + $type) <= 10) {
						if($this->counters[3] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[3]--;
								$this->moveShip($direction, 3, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 3 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
				else if($direction == 'left') {
					if(($x - $type) >= -1) {
						if($this->counters[3] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[3]--;
								$this->moveShip($direction, 3, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 3 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
				else if($direction == 'right') {
					if(($x + $type) <= 10) {
						if($this->counters[3] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") 	$this->counters[3]--;
								$this->moveShip($direction, 3, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 3 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
			case 4:
				if($direction == 'up') {
					if(($y - $type) >= -1) {
						if($this->counters[4] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[4]--;
								$this->moveShip($direction, 4, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 4 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
				else if($direction == 'down') {
					if(($y + $type) <= 10) {
						if($this->counters[4] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[4]--;
								$this->moveShip($direction, 4, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 4 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
				else if($direction == 'left') {
					if(($x - $type) >= -1) {
						if($this->counters[4] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[4]--;
								$this->moveShip($direction, 4, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 4 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
				else if($direction == 'right') {
					if(($x + $type) <= 10) {
						if($this->counters[4] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[4]--;
								$this->moveShip($direction, 4, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 4 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
			case 5:
				if($direction == 'up') {
					if(($y - $type) >= -1) {
						if($this->counters[5] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[5]--;
								$this->moveShip($direction, 5, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 5 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
				else if($direction == 'down') {
					if(($y + $type) <= 10) {
						if($this->counters[5] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[5]--;
								$this->moveShip($direction, 5, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 5 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
				else if($direction == 'left') {
					if(($x - $type) >= -1) {
						if($this->counters[5] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[5]--;
								$this->moveShip($direction, 5, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 5 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
				else if($direction == 'right') {
					if(($x + $type) <= 10) {
						if($this->counters[5] > 0) {
							if($this->checkTable($x, $y, $type, $direction, $player)){
								$this->ships[] = new Ship($type, $direction, $position);
								if ($player == "User") $this->counters[5]--;
								$this->moveShip($direction, 5, $x, $y, $player);
								return 0;
							}
							else {
								return 1;
							}
						}
						else {
// 							$this->message = "Non hai più navi da 5 disponibili!";
							return 2;
						}
					}
					else {
// 						$this->message = "In questa posizione la nave non ci sta!";
						return 3;
					}
					break;
				}
			}
		return $this->message;
	}
}
