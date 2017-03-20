<?php

require_once 'Classes/Ship.php';

class Table {

	private $table = array();
	private $table2 = array();

	private $ships = array();

	private $message = "";
	private $counters = array(2 => 3, 3 => 2, 4 => 2, 5 => 1);
	private $tableType;

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

	public function getTable2($x, $y) {
		return $this->table2[$x][$y];
	}

	public function setTable2($x, $y) {
		$this->table2[$x][$y] = 1;
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

	public function getTable2Ships() {
		return $this->table2;
	}

	public function computerTableShips() {

	}

	public function moveShip($tabletype, $direction, $case, $x, $y) {
		if($tabletype = 1) {
			$for ($i=0; $i<$case; $i++) {
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
		} else {
			for ($i=0; $i<$case; $i++) {
				if ($direction == 'up') {
					$this->table2[$x][$y] = "O";
					$y--;
				} else if($direction == 'left') {
					$this->table2[$x][$y] = "O";
					$x--;
				} else if($direction == 'right') {
					$this->table2[$x][$y] = "O";
					$x++;
				} else {
					$this->table2[$x][$y] = "O";
					$y++;
				}
			}
		}
	}

	public function putShip($tableType, $type, $direction, $position) {
		$x = $position[0];
		$y = $position[1];
		$this->message = "";

		switch ($type) {
			case 2:
				if($direction == 'up'){
					if(($y - $type) >= -1) {
						if($this->counters[2] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[2]--;
							$this->moveShip($tableType, $direction, 2, $x, $y);

						}
						else {
							$this->message = "Non hai più navi da 2 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'down'){
					if(($y + $type) <= 10) {
						if($this->counters[2] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[2]--;
							$this->moveShip($tableType, $direction, 2, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 2 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'left') {
					if(($x - $type) >= -1) {
						if($this->counters[2] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[2]--;
							$this->moveShip($tableType, $direction, 2, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 2 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'right') {
					if(($x + $type) <= 10) {
						if($this->counters[2] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[2]--;
							$this->moveShip($tableType, $direction, 2, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 2 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
			case 3:
				if($direction == 'up') {
					if(($y - $type) >= -1) {
						if($this->counters[3] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[3]--;
							$this->moveShip($tableType, $direction, 3, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 3 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'down') {
					if(($y + $type) <= 10) {
						if($this->counters[3] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[3]--;
							$this->moveShip($tableType, $direction, 3, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 3 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'left') {
					if(($x - $type) >= -1) {
						if($this->counters[3] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[3]--;
							$this->moveShip($tableType, $direction, 3, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 3 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'right') {
					if(($x + $type) <= 10) {
						if($this->counters[3] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[3]--;
							$this->moveShip($tableType, $direction, 3, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 3 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
			case 4:
				if($direction == 'up') {
					if(($y - $type) >= -1) {
						if($this->counters[4] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[4]--;
							$this->moveShip($tableType, $direction, 4, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 4 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'down') {
					if(($y + $type) <= 10) {
						if($this->counters[4] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[4]--;
							$this->moveShip($tableType, $direction, 4, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 4 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'left') {
					if(($x - $type) >= -1) {
						if($this->counters[4] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[4]--;
							$this->moveShip($tableType, $direction, 4, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 4 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'right') {
					if(($x + $type) <= 10) {
						if($this->counters[4] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[4]--;
							$this->moveShip($tableType, $direction, 4, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 4 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
			case 5:
				if($direction == 'up') {
					if(($y - $type) >= -1) {
						if($this->counters[5] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[5]--;
							$this->moveShip($tableType, $direction, 5, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 5 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'down') {
					if(($y + $type) <= 10) {
						if($this->counters[5] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[5]--;
							$this->moveShip($tableType, $direction, 5, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 5 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'left') {
					if(($x - $type) >= -1) {
						if($this->counters[5] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[5]--;
							$this->moveShip($tableType, $direction, 5, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 5 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
				else if($direction == 'right') {
					if(($x + $type) <= 10) {
						if($this->counters[5] > 0) {
							$this->ships[] = new Ship($type, $direction, $position);
							$this->counters[5]--;
							$this->moveShip($tableType, $direction, 5, $x, $y);
						}
						else {
							$this->message = "Non hai più navi da 5 disponibili!";
						}
					}
					else {
						$this->message = "In questa posizione la nave non ci sta!";
					}
					break;
				}
			}
		return $this->message;
	}
}
