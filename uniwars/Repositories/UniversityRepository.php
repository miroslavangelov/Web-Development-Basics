<?php
	namespace uniwars\Repositories;
	use uniwars\Db;
	use uniwars\Models\Player;
	use uniwars\Models\University;
	class UniversityRepository {
		private $db;
		private static $inst = null;
		private function __construct(\uniwars\Db $db) {
			$this->db = $db;
		}
		public static function create() {
			if(self::$inst === null) {
				self::$inst = new self(Db::getInstance());
			}
			return self::$inst;
		}

		public function getOne($id) {
			$query = "SELECT id, name, user_id, money, lectures
				FROM universities WHERE id = ?";
			$this->db->query($query, [$id]);
			$result = $this->db->row();
			if (empty($result)) {
				return false;
			}
			$player = PlayerRepository::create()
            ->getOne($result['user_id']);

			$university = new University(
					$result['id'],
					$result['name'],
					$player,
					$result['money'],
					$result['lectures']
			);
			return $university;
		}
		public function getAll() {
			$query = "SELECT id, name, user_id, money, lectures
				FROM universities";
			$this->db->query($query);
			$result = $this->db->fetchAll();
			$collection = [];
			foreach ($result as $row) {
				$player = PlayerRepository::create()
					->getOne($row['user_id']);
				$collection[] =  new University(
					$row['id'],
					$row['name'],
					$player,
					$row['money'],
					$row['lectures']
				);
			}
			return $collection;
		}
		public function save(University $university) {
			$query = "
				INSERT INTO universities
				(name, user_id, money, lectures)
				VALUES (?, ?, ?, ?)
			";
			$params = [
				$university->getName(),
				$university->getPlayer()->getId(),
				$university->getMoney(),
				$university->getLecturues()
			];
			if ($university->getId()) {
			   $query = "UPDATE universities SET
			   name = ?, user_id = ?, money = ?, lectures = ?
			   WHERE id = ?
			   ";
				$params[] = $university->getId();
			}
			$this->db->query($query, $params);
			return $this->db->rows() > 0;
		}
	}
?>
