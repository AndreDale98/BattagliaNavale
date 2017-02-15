<?php

require_once 'Classes/Ship.php';

class Table {

	private $table = Array();
	private $ship;
	
	
	public function __construct(){
		
	}
	
	public function setShip($ship) {
		$this->ship = new Ship();
	}
	
	public function getShip() {
		return $this->ship;
	}
	
	public function initializeTable() {
		for ($i=0; $i<10; $i++) {
			for ($ii=0; $ii<10; $ii++) {
				$this->table[$i][$ii] = 0;
			}
		}
		return $this->table;
	}
}
