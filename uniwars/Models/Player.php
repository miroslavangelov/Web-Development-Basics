<?php
	namespace uniwars\Models;
	use uniwars\Repositories\PlayerRepository;
	class Player {
		private $id;
		private $username;
		private $password;
		private $universities;
		private $stages;
		public function __construct($username, $password, $id=null) {
			$this->setUsername($username);
			$this->setPassword($password);
			$this->setId($id);
		}
		public function setUsername($username) {
			$this->username = $username;
		}
		public function getUsername() {
			return $this->username;
		}
		public function setPassword($password) {
			$this->password = md5($password);
		}
		public function getPassword() {
			return $this->password;
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function getId() {
			return $this->id;
		}
		public function setUniversities($universities) {
			$this->universities = $universities;
		}
		public function getUniversities() {
			return $this->universities;
		}
		public function setStages($stages) {
			$this->stages = $stages;
		}
		public function getStages() {
			return $this->stages;
		}
		public function save() {
			return PlayerRepository::create()->save($this);
		}
	}
?>
