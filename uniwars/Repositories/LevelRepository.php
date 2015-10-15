<?php
	namespace uniwars\Repositories;
	use Uniwars\Db;
	use Uniwars\Models\Player;
	use Uniwars\Models\Stage;
	use Uniwars\Models\StageLevel;
	use Uniwars\Models\University;
	class LevelRepository {
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

		public function getOne($levelId, $stageId) {
			$query = "SELECT stage_id, level_id, money_consumed, lectures_consumed, money_income, lectures_income FROM stage_levels WHERE level_id=? AND stage_id=?";
			$this->db->query($query, [$levelId, $stageId]);
			$result = $this->db->row();
			if (empty($result)) {
				return false;
			}
			$this->db->query("SELECT id, name FROM stages WHERE id=?", [$stageId]);
			$stageResult = $this->db->row();
			
			$stage = new Stage($stageResult["id"], $stageResult["name"]);
			$stageLevel = new StageLevel($stage, $result["level_id"], $result["money_consumed"], 
			$result["lectures_consumed"], $result["money_income"], $result["lectures_income"]);
			return $stageLevel;
		}
	}
?>
