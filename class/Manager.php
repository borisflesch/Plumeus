<?php

class Manager {
	protected $db;

	public function __construct(PDO $db) {
		$this->db = $db;
	}
}