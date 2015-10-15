<?php
	require_once "DbConfig.php";
	
	class Db {
		private $connection;
		private $statement;
		private static $inst = null;
		public function __construct() {
			$dsn = "mysql:dbname=".DbConfig::DBNAME.";host=".DbConfig::HOST;
			$this->connection = new \PDO($dsn, DbConfig::USER, DbConfig::PASSWORD);
		}
		public function setInstance() {
			if (self::$inst === null) {
				self::$inst = new self();
			}
		}
		public function getInstance() {
			if (self::$inst == null) {
            self::setInstance();
			}
			return self::$inst;
		}
		public function query($query, $params=[]) {
			$this->statement = $this->connection->prepare($query);
			$this->statement->execute($params);
		}
		public function fetchAll() {
			return $this->statement->fetchAll(PDO::FETCH_ASSOC);
		}
		public function row() {
			return $this->statement->fetch();
		}
	}

?>