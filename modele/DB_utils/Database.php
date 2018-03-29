<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace db;
use db\Constantes;

/**
 * Description of Connect
 *
 * @author ismail
 * Adaptation du DP Singleton  
 */

class Database {
	private $_connection;
	private static $_instance; //The single instance

	public static function getInstance() {
		if(!self::$_instance) { 
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() {
		$this->_connection = new \mysqli(Constantes::HOST,
                        Constantes::USERNAME,
                        Constantes::PASSWORD,
                        Constantes::DATABASE);
	
		// Error handling
		if ($this->_connection->connect_error) {
			die("Failed to connect to MySQL: " . $this->_connection->connect_error);
		}
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}
        public function close() {
		return $this->_connection->close();
	}
}
?>
