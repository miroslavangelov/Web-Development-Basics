<?php
	namespace uniwars\Controllers;
	use uniwars\Repositories\PlayerRepository;
	use uniwars\Repositories\UniversityRepository;
	class GameController extends Controller {
		protected $currentPlayer = null;
		protected $currentUniversity = null;
		protected function onLoad() {
			if (!isset($_SESSION["user_id"])) {
				$this->redirect("user", "login");
			}
			if ($this->currentPlayer === null) {
				$this->currentPlayer = PlayerRepository::create()
				->getOne($_SESSION["user_id"]);
			}
			if ($this->currentUniversity === null) {
				$this->currentUniversity = UniversityRepository::create()
				->getOne($_SESSION["university_id"]);
			}
			$this->view->playerName = $this->currentPlayer->getUsername();
			$this->view->university = $this->currentUniversity;
			$this->view->partial("authHeader");
		}
		public function index() {
			$this->view->universities = $this->currentPlayer->getUniversities();
		}
	}
?>
