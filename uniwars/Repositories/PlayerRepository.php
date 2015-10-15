<?php
	namespace uniwars\Repositories;
	use uniwars\Db;
	use uniwars\Models\Player;
	use Uniwars\Models\Stage;
	use Uniwars\Models\PlayerStage;
	use Uniwars\Models\StageLevel;
	use uniwars\Models\University;
	class PlayerRepository {
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
		public function getOneByDetails($user, $pass) {
			$query = "SELECT id, username, password FROM players WHERE username=? AND password=?";
			$this->db->query($query, [$user, md5($pass)]);
			$result = $this->db->row();
			if (empty($result)) return false;
			return $this->getOne($result["id"]);
		}
		public function getOne($id) {
			$query = "SELECT id, username, password FROM players WHERE id=?";
			$this->db->query($query, [$id]);
			$result = $this->db->row();
			if (empty($result)) {
				return false;
			}
			$player = new Player($result["username"], $result["password"], $result["id"]);
			$this->db->query("SELECT id, name, user_id, money, lectures FROM universities WHERE user_id = ?", [$id]);
			$universitiesResult = $this->db->fetchAll();
			$universities = [];
			foreach ($universitiesResult as $university) {
				$universities[] = new University($university["id"], $university["name"], $player, 
				$university["money"], $university["lectures"]);
			}
			$this->db->query("SELECT id, player_id, stage_id, level_id, university_id FROM player_stages WHERE player_id = ?", [$id]);
			$playerStagesResult = $this->db->fetchAll();

			$playerStagesCollection = [];
			foreach ($playerStagesResult as $playerStageResult) {
				$this->db->query("SELECT id, name FROM stages WHERE id = ?", [$playerStageResult["stage_id"]]);
				$stageResult = $this->db->row();
				$stage = new Stage($stageResult["id"], $stageResult["name"]);
				
				$stageLevelsCollection = []; //
				$this->db->query("SELECT stage_id, level_id, money_consumed, lectures_consumed, money_income, lectures_income FROM stage_levels WHERE stage_id=? AND level_id=?", [$stage->getId(), $playerStageResult["level_id"]]);
				$stageLevelsResult = $this->db->fetchAll();
				$university = current(array_filter($universities, function(University $u) use ($playerStageResult) {
					return $u->getId() === $playerStageResult["university_id"];
				}));
				
				foreach ($stageLevelsResult as $stageLevelResult) {
					$stageLevel = new StageLevel($stage, $stageLevelResult["level_id"], $stageLevelResult["money_consumed"], $stageLevelResult["lectures_consumed"], $stageLevelResult["money_income"], $stageLevelResult["lectures_income"]);
					$stageLevelsCollection[] = $stageLevel;
					$playerStagesCollection[] = new PlayerStage($player, $stage, $stageLevel, $university);
				}
				
			}
			$player->setUniversities($universities);
			$player->setStages($playerStagesCollection);
			return $player;
		}
		public function getAll() {
			$query = "SELECT id, username, password FROM players";
			$this->db->query($query);
			$result = $this->db->fetchAll();
			$collection = [];
			foreach ($result as $row) {
				$collection[] = new Player($row["username"], $row["password"], $row["id"]);
			}
			return $collection;
		}
		public function save($player) {
			$query = "INSERT INTO players(username, password) VALUES(?, ?)";
			$params = [$player->getUsername(), $player->getPassword()];
			if ($player->getId()) {
				$query = "UPDATE players SET username = ?, password = ? WHERE id = ?";
				$params[] = $player->getId();
			}
			
			$this->db->query($query, $params);
			return $this->db->rows() > 0;
		}
	}
?>
