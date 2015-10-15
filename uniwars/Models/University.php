<?php
	namespace uniwars\Models;
	use Uniwars\Repositories\UniversityRepository;
	class University {
		private $id;
		private $player;
		private $name;
		private $money;
		private $lectures;
		public function __construct($id, $name, Player $player, $money, $lectures) {
			$this->setId($id);
			$this->setName($name);
			$this->setPlayer($player);
			$this->setMoney($money);
			$this->setLectures($lectures);
		}
	
		public function setName($name) {
			$this->name = $name;
		}
		public function getName() {
			return $this->name;
		}
		public function setId($id) {
			$this->id = $id;
		}
		public function getId() {
			return $this->id;
		}
		public function setPlayer($player) {
			$this->player = $player;
		}
		public function getPlayer() {
			return $this->player;
		}
		public function setMoney($money) {
			$this->money = $money;
		}
		public function getMoney() {
			return $this->money;
		}
		public function setLectures($lectures) {
			$this->lectures = $lectures;
		}
		public function getLectures() {
			return $this->lectures;
		}
	}
?>