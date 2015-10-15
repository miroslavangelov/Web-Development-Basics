<?php
	namespace uniwars\Models;
	
	use Uniwars\Repositories\LevelRepository;
	use Uniwars\Repositories\PlayerRepository;
	use Uniwars\Repositories\StageRepository;
	class PlayerStage {
		private $id;
		private $stage;
		private $level;
		private $player;
		private $university;
		public function __construct(Player $player, Stage $stage, StageLevel $level, University $university) {
			$this->player = $player;
			$this->stage = $stage;
			$this->level = $level;
			$this->university = $university;
		}
		
		/**
		 * @return mixed
		 */
		public function getId()
		{
			return $this->id;
		}
		/**
		 * @return Player
		 */
		public function getPlayer()
		{
			return $this->player;
		}
		/**
		 * @return Stage
		 */
		public function getStage()
		{
			return $this->stage;
		}
		/**
		 * @return StageLevel
		 */
		public function getLevel()
		{
			return $this->level;
		}
		public function setLevel(StageLevel $level)
		{
			$this->level = $level;
		}
		public function getUniversity() {
			return $this->university;
		}
		public function setUniversity(University $university) {
			$this->university = $university;
		}

		public function save()
		{
			return StageRepository::create()->save($this);
		}
	}
?>
