<?php
	namespace uniwars\Controllers;
	use Uniwars\Models\PlayerStage;
	use Uniwars\Repositories\LevelRepository;
	use Uniwars\Repositories\PlayerRepository;
	use Uniwars\Repositories\UniversityRepository;
	class StagesController extends GameController {
		public function index() {
			$this->view->playerStages = array_filter($this->currentPlayer->getStages(), function(PlayerStage $st) {
				return $st->getUniversity()->getId() === $this->currentUniversity->getId();
			});
			//$this->view->nextLevels = [];
		}
	}
?>
