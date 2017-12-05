<?php
require_once 'Config.php';

class Connection {
	private $conn;

	function __construct() {
		$this->connect();
	}

	public function connect() {

		$this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

		if (mysqli_connect_errno($this->conn)) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
	}

	function getDb() {
		return $this->conn;
	}
}

?>