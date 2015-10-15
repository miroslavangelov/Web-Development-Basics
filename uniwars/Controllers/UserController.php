<?php
	namespace uniwars\Controllers;
	use uniwars\Repositories\PlayerRepository;
	use uniwars\Models\Player;
	class UserController extends Controller {
		public function login() {
			$this->view->error = false;
			$this->view->user = false;
			if (isset($_POST["login"])) {
				$username = $_POST["username"];
				$password = $_POST["password"];
				$player = PlayerRepository::create()->getOneByDetails($username, $password);
				if (!$player) {
					$this->view->error = "Invalid details";
					return;
				}
				$_SESSION["user_id"] = $player->getId();
				$_SESSION["university_id"] = $player->getUniversities()[0]->getId();;
				$this->view->user = $player->getUsername();
				$this->redirect("game");
			}

		}
		public function register() {
			$this->view->error = false;
			if (isset($_POST["register"])) {
				$username = $_POST["username"];
				$password = $_POST["password"];
				$player = new Player($username, $password);
				if (!$player->save()) {
					$this->view->error = "Duplicate users";
				}
				$this->login();
			}
		}
		
		public function logout() {
			session_destroy();
			die();
		}
	}
?>
